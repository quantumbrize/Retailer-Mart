<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CommonModel;
use App\Models\UsersModel;
use App\Models\UserImageModel;
use App\Models\AddressModel;
use App\Models\MessageModel;
use App\Models\AccessModel;
use App\Models\StaffAccessModel;
use App\Models\StaffModel;
use App\Models\VendorModel;
use App\Models\BestSellingVendorModel;
use App\Models\VendorAuthorizationModel;
use App\Models\SociallinkModel;
use App\Models\NoticebarModel;
use App\Models\NewsletterModel;
use App\Models\VendorWalletModel;
use App\Models\VendorWalletHistoryModel;
use App\Models\VendorWithdrawalHistoryModel;
use App\Models\WishlistsModel;
use App\Models\VendorBankModel;
use App\Models\UserCartModel;
class User_Controller extends Api_Controller
{
    public function __construct()
    {
        // Load session library
        $this->session = \Config\Services::session();
    }

    private function update_user($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Faild!',
            'data' => null
        ];

        if (empty($data['name'])) {
            $resp['message'] = 'Please Enter Name';
        } else if (empty($data['number'])) {
            $resp['message'] = 'Please Enter Number';
        } else if (empty($data['email'])) {
            $resp['message'] = 'Please Enter Email';
        } else {

            $user_data = [
                'user_name' => $data['name'],
                'number' => $data['number'],
                'email' => $data['email'],
            ];
            $UserModel = new UsersModel();
            $UserModel->transStart();
            try {
                $UserModel
                    ->where('uid', $data['user_id'])
                    ->set($user_data)
                    ->update();
                $UserModel->transCommit();
            } catch (\Exception $e) {
                $UserModel->transRollback();
                throw $e;
            }

            $update_address_data = [
                'city' => $data['city'],
                'country' => $data['country'],
                'zipcode' => $data['zip'],
                'district' => $data['district'],
                'state' => $data['state'],
                'locality' => $data['locality'],
                'is_primary' => 'primary',
            ];

            $add_address_data = [
                'uid' => $this->generate_uid(UID_ADDRESS),
                'user_id' => $data['user_id'],
                'city' => $data['city'],
                'country' => $data['country'],
                'zipcode' => $data['zip'],
                'district' => $data['district'],
                'state' => $data['state'],
                'locality' => $data['locality'],
                'is_primary' => 'primary',
            ];

            $UserAddressModel = new AddressModel();
            $AddressData = $UserAddressModel
                ->where('user_id', $data['user_id'])
                ->where('is_primary', 'primary')
                ->get()
                ->getResultArray();
            $UserAddressData = !empty($AddressData[0]) ? $AddressData[0] : null;
            $UserAddressModel->transStart();
            try {
                if (!empty($UserAddressData)) {
                    $UserAddressModel
                        ->where('user_id', $data['user_id'])
                        ->where('is_primary', 'primary')
                        ->set($update_address_data)
                        ->update();
                } else {
                    $UserAddressModel->insert($add_address_data);
                }
                $UserAddressModel->transCommit();
            } catch (\Exception $e) {
                $UserAddressModel->transRollback();
                throw $e;
            }

            $uploadedFiles = $this->request->getFiles();
            // $this->prd($uploadedFiles);
            if (!empty($uploadedFiles['images'])) {
                $UserImagesModel = new UserImageModel();
                $UsersData = $UserImagesModel
                    ->where('user_id', $data['user_id'])
                    ->get()
                    ->getResultArray();
                $UserImageData = !empty($UsersData[0]) ? $UsersData[0] : null;
                foreach ($uploadedFiles['images'] as $file) {
                    $file_src = $this->single_upload($file, PATH_USER_IMG);
                    $UserImagesModel->transStart();
                    try {
                        if (!empty($UserImageData)) {
                            $user_image_data = [
                                'img' => $file_src,
                            ];
                            $UserImagesModel
                                ->where('user_id', $data['user_id'])
                                ->set($user_image_data)
                                ->update();
                        } else {
                            $user_image_data = [
                                'uid' => $this->generate_uid(UID_USER_IMG),
                                'user_id' => $data['user_id'],
                                'img' => $file_src,
                            ];
                            $UserImagesModel->insert($user_image_data);
                        }
                        $UserImagesModel->transCommit();
                    } catch (\Exception $e) {
                        $UserImagesModel->transRollback();
                        throw $e;
                    }

                }
            }
            $resp['status'] = true;
            $resp['message'] = 'Update Successful';
            $resp['data'] = ['user_id' => $data['user_id']];
        }
        return $resp;
    }

    private function change_password($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Password Changed Faild!',
            'data' => null
        ];

        if (empty($data['old_password'])) {
            $resp['message'] = 'Please Enter Old Password';
        } else if (empty($data['new_password'])) {
            $resp['message'] = 'Please Enter New Password';
        } else if (empty($data['confirm_password'])) {
            $resp['message'] = 'Please Enter Confirm Password';
        } else {

            $UserModel = new UsersModel();
            $UsersData = $UserModel
                ->where('uid', $data['user_id'])
                ->where('password', md5($data['old_password']))
                ->where('type', 'user')
                ->get()
                ->getResultArray();
            $UsersData = !empty($UsersData[0]) ? $UsersData[0] : null;
            if (!empty($UsersData)) {
                $UserModel->transStart();
                try {
                    $UserModel
                        ->where('uid', $data['user_id'])
                        ->set(['password' => md5($data['new_password'])])
                        ->update();
                    $UserModel->transCommit();
                } catch (\Exception $e) {
                    $UserModel->transRollback();
                    throw $e;
                }
                $resp['status'] = true;
                $resp['message'] = 'Password Changed Successfully';
                $resp['data'] = "";
            } else {
                $resp['message'] = 'Old password did not match!';
            }
        }
        return $resp;
    }

    private function message($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Faild!',
            'data' => null
        ];

        if (empty($data['name'])) {
            $resp['message'] = 'Please Enter Name';
        } else if (empty($data['email'])) {
            $resp['message'] = 'Please Enter Email';
        } else if (empty($data['phone'])) {
            $resp['message'] = 'Please Enter Phone No.';
        } else if (empty($data['subject'])) {
            $resp['message'] = 'Please Enter Subject';
        } else if (empty($data['message'])) {
            $resp['message'] = 'Please Enter Message';
        } else {
            $insert_message = [
                'uid' => $this->generate_uid(UID_MESSAGE),
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'subject' => $data['subject'],
                'message' => $data['message'],
            ];
            $MessageModel = new MessageModel();
            $MessageModel->transStart();
            try {
                $messageData = $MessageModel->insert($insert_message);
                $MessageModel->transCommit();
            } catch (\Exception $e) {
                $MessageModel->transRollback();
                throw $e;
            }

            if ($messageData) {
                $resp['status'] = true;
                $resp['message'] = 'Message Submit Successful';
                $resp['data'] = "";
            }

        }
        return $resp;
    }

    private function get_user()
    {
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "user_data" => ""
        ];
        $user_id = $this->request->getGet('user_id');

        // $this->prd($user_id);

        if (!empty($user_id)) {

            $UsersModel = new UsersModel();
            $UsersData = $UsersModel
                ->where('uid', $user_id)
                ->get()
                ->getResultArray();
            $UsersData = !empty($UsersData[0]) ? $UsersData[0] : null;

            if ($UsersData['type'] == 'user') {

                $UserAddressModel = new AddressModel();
                $AddressData = $UserAddressModel
                    ->where('user_id', $user_id)
                    ->get()
                    ->getResultArray();
                $AddressData = !empty($AddressData[0]) ? $AddressData[0] : null;

                $AllAddressData = $UserAddressModel
                    ->where('user_id', $user_id)
                    ->get()
                    ->getResultArray();
                $AllAddressData = !empty($AllAddressData) ? $AllAddressData : null;

                $UserImageModel = new UserImageModel();
                $ImageData = $UserImageModel
                    ->where('user_id', $user_id)
                    ->get()
                    ->getResultArray();
                $ImageData = !empty($ImageData[0]) ? $ImageData[0] : null;

                $WishlistsModel = new WishlistsModel();

                $Wishlists = $WishlistsModel->where('user_id', $user_id)
                    ->get()
                    ->getResultArray();
                $Wishlists = !empty($Wishlists) ? $Wishlists : null;

                $UserCartModel = new UserCartModel();
                $cart = $UserCartModel->where('user_id', $user_id)
                    ->get()
                    ->getResultArray();

                $resp = [
                    "status" => true,
                    "message" => "Data fetched",
                    "user_id" => $user_id,
                    "user_data" => $UsersData,
                    "address" => $AddressData,
                    "user_img" => $ImageData,
                    "all_address" => $AllAddressData,
                    "wishlists" => $Wishlists,
                    "cart" => $cart
                ];

            } else if ($UsersData['type'] == 'seller') {
                $resp = [
                    "status" => true,
                    "message" => "Data fetched",
                    "user_id" => $user_id,
                    "user_data" => $UsersData,
                ];
            }

        }
        return $resp;
    }

    private function get_admin($data)
    {
        // echo $user_id;
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "user_data" => ""
        ];
        if (!empty($data['user_id'])) {
            $UsersModel = new UsersModel();
            $UsersData = $UsersModel
                ->where('uid', $data['user_id'])
                ->get()
                ->getResultArray();
            $UsersData = !empty($UsersData[0]) ? $UsersData[0] : null;
            $UsersImageData = '';
            if ($UsersData && $UsersData['type'] == 'staff') {
                $UserImageModel = new UserImageModel();
                $UsersImageData = $UserImageModel
                    ->where('user_id', $data['user_id'])
                    ->get()
                    ->getResultArray();
                $UsersImageData = !empty($UsersImageData[0]) ? $UsersImageData[0] : null;
            }
            $resp = [
                "status" => true,
                "message" => "Data fetched",
                "user_data" => $UsersData,
                "user_image" => $UsersImageData,
            ];
        } else {
            $resp = [
                "user_data" => $data['user_id'],
            ];
        }
        return $resp;
    }

    private function update_admin($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Faild!',
            'data' => null
        ];

        if (empty($data['nameInput'])) {
            $resp['message'] = 'Please Enter Name';
        } else if (empty($data['emailInput'])) {
            $resp['message'] = 'Please Enter Number';
        } else if (empty($data['phonenumberInput'])) {
            $resp['message'] = 'Please Enter Email';
        } else if (empty($data['user_id'])) {
            $resp['message'] = 'User Not Found';
        } else {

            $user_data = [
                'user_name' => $data['nameInput'],
                'email' => $data['emailInput'],
                'number' => $data['phonenumberInput'],
            ];
            $UserModel = new UsersModel();
            $UserModel->transStart();
            try {
                $UserModel
                    ->where('uid', $data['user_id'])
                    ->set($user_data)
                    ->update();
                $UserModel->transCommit();
            } catch (\Exception $e) {
                $UserModel->transRollback();
                throw $e;
            }
            $resp['status'] = true;
            $resp['message'] = 'Update Successful';
            $resp['data'] = ['user_id' => $data['user_id']];
        }
        return $resp;
    }

    private function change_admin_password($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Password Changed Faild!',
            'data' => null
        ];

        if (empty($data['old_password'])) {
            $resp['message'] = 'Please Enter Old Password';
        } else if (empty($data['new_password'])) {
            $resp['message'] = 'Please Enter New Password';
        } else if (empty($data['confirm_password'])) {
            $resp['message'] = 'Please Enter Confirm Password';
        } else {
            $UserModel = new UsersModel();
            $UsersData = $UserModel
                ->where('uid', $data['user_id'])
                ->where('password', md5($data['old_password']))
                ->where('type', 'admin')
                ->orWhere('type', 'staff')
                ->get()
                ->getResultArray();
            $UsersData = !empty($UsersData[0]) ? $UsersData[0] : null;
            if (!empty($UsersData) || $UsersData != null) {
                $UserModel->transStart();
                try {
                    $UserModel
                        ->where('uid', $data['user_id'])
                        ->set(['password' => md5($data['new_password'])])
                        ->update();
                    $updated = $UserModel->transCommit();
                    if ($updated) {
                        $resp['status'] = true;
                        $resp['message'] = 'Password Changed Successfully';
                        $resp['data'] = "";
                    }
                } catch (\Exception $e) {
                    $UserModel->transRollback();
                    throw $e;
                }

            } else {
                $resp['message'] = 'Old password did not match!';
            }
        }
        return $resp;
    }

    private function customer($user_id)
    {
        // echo $user_id;
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "user_data" => ""
        ];
        if (!empty($user_id)) {
            $UsersModel = new UsersModel();
            $UsersData = $UsersModel
                ->where('uid', $user_id)
                ->get()
                ->getResultArray();
            $UsersData = !empty($UsersData[0]) ? $UsersData[0] : null;

            $UserAddressModel = new AddressModel();
            $AddressData = $UserAddressModel
                ->where('user_id', $user_id)
                ->get()
                ->getResultArray();
            $AddressData = !empty($AddressData[0]) ? $AddressData[0] : null;

            $AllAddressData = $UserAddressModel
                ->where('user_id', $user_id)
                ->get()
                ->getResultArray();
            $AllAddressData = !empty($AllAddressData) ? $AllAddressData : null;

            $UserImageModel = new UserImageModel();
            $ImageData = $UserImageModel
                ->where('user_id', $user_id)
                ->get()
                ->getResultArray();
            $ImageData = !empty($ImageData[0]) ? $ImageData[0] : null;
            $resp = [
                "status" => true,
                "message" => "Data fetched",
                "user_id" => $user_id,
                "user_data" => $UsersData,
                "address" => $AddressData,
                "user_img" => $ImageData,
                "all_address" => $AllAddressData,
            ];
        } else {
            $UsersModel = new UsersModel();
            $users = $UsersModel->where('type', 'user')->findAll();
            if (count($users) > 0) {
                $UserImageModel = new UserImageModel();
                foreach ($users as $index => $user) {
                    $img = $UserImageModel->where('user_id', $user['uid'])->first();
                    $users[$index]['user_img'] = $img;
                }

            }
            $resp = [
                "status" => true,
                "message" => "Data fetched",
                "user_data" => $users,
            ];
        }
        return $resp;
    }

    private function delete_customer($data)
    {
        // echo $user_id;
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "user_data" => ""
        ];
        if ($data) {
            $UserModel = new UsersModel();
            $UserModel->transStart();
            try {
                $UserModel
                    ->where('uid', $data['user_id'])
                    ->set(['status' => 'deleted'])
                    ->update();
                $UserModel->transCommit();
            } catch (\Exception $e) {
                $UserModel->transRollback();
                throw $e;
            }
            $resp = [
                "status" => true,
                "message" => "Data Deleted",
                "user_data" => ""
            ];
        }
        return $resp;
    }

    private function total_customer()
    {
        $resp = [
            'status' => false,
            'message' => 'no customer found',
            'data' => 0
        ];
        try {
            $UsersModel = new UsersModel();
            $totalUsers = $UsersModel->where('type', 'user')->countAllResults();
            if (!empty($totalUsers)) {
                $resp = [
                    'status' => true,
                    'message' => 'Total customers found',
                    'data' => $totalUsers
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function staff_access($data)
    {
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "data" => []
        ];


        try {
            $AccessModel = new AccessModel();
            if (empty($data['staff_id'])) {
                $allAccess = $AccessModel->findAll();
                if ($allAccess) {
                    $resp['status'] = true;
                    $resp['message'] = "All access data retrieved";
                    $resp['data'] = $allAccess;
                } else {
                    // If no access data found at all
                    $resp['message'] = "No access data found";
                }
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;
    }
    private function access_add($data)
    {
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "data" => []
        ];
        try {
            $AccessModel = new AccessModel();
            // Generating a UID for the access
            $uid = $this->generate_uid(UID_ACCESS);
            // Access data from the parameter $data
            $accessData = [
                "uid" => $uid,
                "name" => $data['name'],
                "status" => "active"
            ];

            // Insert data into the database
            $isAdded = $AccessModel->insert($accessData);

            // Check if data is successfully inserted
            if ($isAdded) {
                $resp['status'] = true;
                $resp['message'] = "Data inserted successfully";
                $resp['data'] = ['access_id' => $uid];
            } else {
                $resp['message'] = "Failed to insert data";
            }
        } catch (\Exception $e) {
            // Catching any exceptions and setting error message
            $resp['message'] = $e->getMessage();
        }
        return $resp;
    }
    private function staff_add($data)
    {
        $response = [
            "status" => false,
            "message" => "Staff Not Added",
            "data" => []
        ];

        try {
            if (
                empty($data['staffName']) ||
                empty($data['staffEmail']) ||
                empty($data['staffNumber']) ||
                empty($data['staffPassword']) ||
                empty($data['staffRole'])
            ) {
                $response['message'] = "Please Add All Staff Details";

            } else {
                $UsersModel = new UsersModel();
                $isExists = $UsersModel->where(['email' => $data['staffEmail'], 'type' => 'staff'])->findAll();
                //$this->prd($isEmailExists);

                if (empty($isExists)) {
                    // Instantiate necessary models
                    $UsersModel = new UsersModel();
                    $StaffModel = new StaffModel();

                    // Prepare user data
                    $userData = [
                        "uid" => $this->generate_uid(UID_USER),
                        "user_name" => $data['staffName'],
                        "email" => $data['staffEmail'],
                        "number" => $data['staffNumber'],
                        "password" => md5($data['staffPassword']),
                        "status" => "active",
                        "type" => "staff"
                    ];

                    // Insert user data
                    $isUsersAdded = $UsersModel->insert($userData);

                    // If user added successfully, proceed to add staff
                    if ($isUsersAdded) {
                        $staffData = [
                            "uid" => $this->generate_uid(UID_STAFF),
                            "user_id" => $userData['uid'],
                            "role" => $data['staffRole'],
                            "status" => "active"
                        ];

                        // Insert staff data
                        $isStaffAdded = $StaffModel->insert($staffData);

                        // If staff added successfully and access rights are provided, insert staff access
                        if ($isStaffAdded && !empty($data['selectedAccess'])) {
                            foreach ($data['selectedAccess'] as $index => $item) {
                                $StaffAccessModel = new StaffAccessModel();
                                $accessData = [
                                    "uid" => $this->generate_uid(UID_STAFF_ACCESS),
                                    "staff_id" => $staffData['uid'],
                                    "access_id" => $item
                                ];
                                $StaffAccessModel->insert($accessData);
                            }
                            // Update response upon successful addition
                            $response = [
                                "status" => true,
                                "message" => "Staff Added Successfully",
                                "data" => ['staff_id' => $staffData['uid']]
                            ];
                        }

                    }
                } else {
                    $response['message'] = 'Try Diffrent Email';
                }

            }
        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    private function staff($data)
    {

        $response = [
            "status" => false,
            "message" => "Staff Not Found",
            "data" => []
        ];

        try {
            $CommonModel = new CommonModel();
            if (!isset($data['s_id'])) {
                $sql = "SELECT 
                        staff.uid AS staff_id,
                        staff.role AS staff_role,
                        users.user_name AS staff_name,
                        users.uid AS user_id,
                        users.email AS staff_email,
                        users.number AS staff_number
                    FROM
                        staff
                    JOIN 
                        users ON staff.user_id = users.uid;";
                $staff = $CommonModel->customQuery($sql);
                $staff = json_decode(json_encode($staff), true);
            } else {
                $s_id = $data['s_id'];
                $sql = "SELECT 
                            staff.uid AS staff_id,
                            staff.role AS staff_role,
                            users.user_name AS staff_name,
                            users.uid AS user_id,
                            users.email AS staff_email,
                            users.number AS staff_number
                        FROM
                            staff
                        JOIN 
                            users ON staff.user_id = users.uid 
                        WHERE
                            staff.uid = '{$s_id}';";
                $staff = $CommonModel->customQuery($sql);
                $staff = json_decode(json_encode($staff), true);
                $staff = !empty($staff) ? $staff[0] : null;

                $sql_access = "SELECT 
                            access.uid AS access_id
                        FROM
                            access
                        JOIN
                            staff_access ON staff_access.access_id = access.uid
                        WHERE 
                            staff_access.staff_id = '{$s_id}';";
                $access = $CommonModel->customQuery($sql_access);
                $access = json_decode(json_encode($access), true);
                $access = !empty($access) ? $access : null;

                $accArr = [];
                if (!empty($access)) {
                    foreach ($access as $index => $item) {
                        $accArr[$index] = $item['access_id'];
                    }
                }

                $staff['access'] = $accArr;
            }


            $response = [
                "status" => !empty($staff),
                "message" => !empty($staff) ? "Staff Found" : "Staff Not Found",
                "data" => !empty($staff) ? $staff : []
            ];


        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $response['message'] = $e->getMessage();
        }



        return $response;
    }


    private function access_update($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
        ];

        try {
            $StaffAccessModel = new StaffAccessModel();

            $conditions = ['staff_id' => $data['staff_id'], 'access_id' => $data['access_id']];

            if ($StaffAccessModel->where($conditions)->countAllResults()) {
                // If a record exists with the provided staff_id and access_id, delete it
                $isUpdated = $StaffAccessModel->where($conditions)->delete();
            } else {
                // If no record exists, insert a new one
                $accessData = [
                    "uid" => $this->generate_uid(UID_STAFF_ACCESS),
                    "staff_id" => $data['staff_id'],
                    "access_id" => $data['access_id']
                ];
                $isUpdated = $StaffAccessModel->insert($accessData);
            }

            // Update response based on success or failure
            if ($isUpdated) {
                $resp['status'] = true;
                $resp['message'] = "Access updated successfully.";
            } else {
                $resp['message'] = "Failed to update access.";
            }
        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }


    private function staff_update($data)
    {

        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
            "data" => []
        ];

        try {

            if (
                empty($data['staffName']) ||
                empty($data['staffEmail']) ||
                empty($data['staffNumber']) ||
                empty($data['staffRole'])
            ) {
                $resp['message'] = "Please Add All Staff Details";
            } else {
                $staff_id = $data['staffId'];
                $sql = "SELECT
                            users.uid AS user_id
                        FROM 
                            users
                        JOIN
                            staff ON users.uid = staff.user_id
                        WHERE
                            staff.uid = '{$staff_id}';";
                $CommonModel = new CommonModel();
                $user_id = $CommonModel->customQuery($sql);
                $user_id = json_decode(json_encode($user_id), true);
                $user_id = !empty($user_id) ? $user_id[0]['user_id'] : null;

                $updateStaffData = [
                    "role" => $data['staffRole'],
                ];
                $updateUserData = [
                    "user_name" => $data['staffName'],
                    "number" => $data['staffNumber'],
                    "email" => $data['staffEmail']
                ];

                $UsersModel = new UsersModel();
                $StaffModel = new StaffModel();

                // Update user details
                $isUserUpdated = $UsersModel->where(['uid' => $user_id])->set($updateUserData)->update();
                // Update staff details
                $isStaffUpdated = $StaffModel->where(['user_id' => $user_id])->set($updateStaffData)->update();

                if ($isUserUpdated && $isStaffUpdated) {
                    $resp = [
                        "status" => true,
                        "message" => "Updated",
                        "data" => ['user_id' => $user_id]
                    ];
                } else {
                    $resp["message"] = "Failed to update.";
                }
            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;

    }

    private function seller_list($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
            "data" => []
        ];

        // $this->prd($data['user_id']);
        try {

            $sql = "SELECT
                        vendor.uid AS vendor_id,
                        vendor.user_img,
                        vendor.signature_img,
                        vendor.pan_img,
                        vendor.aadhar_img,
                        vendor.gst,
                        vendor.tread_licence,
                        vendor.gst_no,
                        vendor.trade_no,
                        vendor.pan_no,
                        vendor.aadhar_no,
                        users.uid AS user_id,
                        users.user_name,
                        users.number,
                        users.email,
                        users.status,
                        vendor_wallet.balance
                    FROM
                        vendor
                    JOIN 
                        users ON vendor.user_id = users.uid
                    JOIN 
                        vendor_wallet ON vendor.user_id = vendor_wallet.user_id
                    WHERE
                        (users.type = 'admin' OR users.type = 'seller')";

            if (!empty($data['user_id'])) {
                $user_id = $data['user_id'];
                $sql .= " AND
                            users.uid = '{$user_id}';";
            }
            $CommonModel = new CommonModel();

            $vendors = $CommonModel->customQuery($sql);
            $vendors = json_decode(json_encode($vendors), true);

            $VendorBankModel = new VendorBankModel();
            if (count($vendors) > 0) {

                foreach ($vendors as $key => $vendor) {
                    // $this->prd($vendor['user_id']);
                    $vendors[$key]['bank'] = $VendorBankModel->where('user_id', $vendor['user_id'])->first();
                }

                $resp['status'] = true;
                $resp['message'] = "All vendors data retrieved";
                $resp['data'] = $vendors;
            } else {
                // If no access data found at all
                $resp['message'] = "No vendors data found";
            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;

    }

    private function all_best_seller_list($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
            "data" => []
        ];

        try {
            $BestSellingVendorModel = new BestSellingVendorModel();
            $CommonModel = new CommonModel();
            $vendors = $BestSellingVendorModel->findAll();
            foreach ($vendors as $index => $vendor) {
                $vendor_id = $vendor['vendor_id'];
                $sql = "SELECT
                        vendor.uid AS vendor_id,
                        vendor.user_img,
                        vendor.signature_img,
                        vendor.pan_img,
                        vendor.aadhar_img,
                        vendor.gst,
                        vendor.tread_licence,
                        users.uid AS user_id,
                        users.uid AS user_id,
                        users.user_name,
                        users.number,
                        users.email,
                        users.status
                    FROM
                        vendor
                    JOIN users ON vendor.user_id = users.uid
                    WHERE
                        vendor.uid = '{$vendor_id}'";

                $a_vendor = $CommonModel->customQuery($sql);
                if (!empty($a_vendor)) {
                    $vendors[$index] = [
                        'vendor_id' => $a_vendor[0]->vendor_id,
                        'vendor_details' => [
                            'user_id' => $a_vendor[0]->user_id,
                            'user_name' => $a_vendor[0]->user_name,
                            'number' => $a_vendor[0]->number,
                            'email' => $a_vendor[0]->email,
                            'status' => $a_vendor[0]->status,
                            'user_img' => $a_vendor[0]->user_img,
                            'signature_img' => $a_vendor[0]->signature_img,
                            'pan_img' => $a_vendor[0]->pan_img,
                            'aadhar_img' => $a_vendor[0]->aadhar_img,
                            'gst' => $a_vendor[0]->gst,
                            'tread_licence' => $a_vendor[0]->tread_licence,
                        ],
                    ];
                }
                // $vendors[$index] = json_decode(json_encode($a_vendor), true);
            }
            if (!empty($vendors)) {
                $resp['status'] = true;
                $resp['message'] = "All vendors data retrieved";
                $resp['data'] = $vendors;
            } else {
                // If no access data found at all
                $resp['message'] = "No vendors data found";
            }


        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;

    }

    private function add_new_seller($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
            "data" => []
        ];

        // $this->prd($data);  

        try {
            $uploadedFiles = $this->request->getFiles();
            if (empty($data['user_name'])) {
                $resp['message'] = 'Please add user name';
            } else if (empty($data['number'])) {
                $resp['message'] = 'Please add number';
            } else if (empty($data['email'])) {
                $resp['message'] = 'Please add email';
            } else if (empty($data['password'])) {
                $resp['message'] = 'Please add password';
            } 
            // else if (empty($uploadedFiles['user_img'])) {
            //     $resp['message'] = 'Please add user image';
            // } else if (empty($uploadedFiles['signature'])) {
            //     $resp['message'] = 'Please add signature';
            // } 
            else if (empty($uploadedFiles['pan_img'])) {
                $resp['message'] = 'Please add pan card image';
            } else if (empty($uploadedFiles['aadhar_img'])) {
                $resp['message'] = 'Please add aadhar card image';
            } else if (empty($uploadedFiles['gst'])) {
                $resp['message'] = 'Please add Gst';
            } 
            // else if (empty($uploadedFiles['tread_licence'])) {
            //     $resp['message'] = 'Please add Tread Licence';
            // } 
            else {

                $user_data = [
                    "uid" => $this->generate_uid(UID_USER),
                    "user_name" => $data['user_name'],
                    "email" => $data['email'],
                    "number" => $data['number'],
                    "password" => md5($data['password']),
                    "type" => 'seller',
                    "status" => 'pending'
                ];
                $vendor_data = [
                    "uid" => $this->generate_uid(UID_VENDOR),
                    "user_id" => $user_data['uid'],
                    "status" => 'active',
                    "gst_no" => $data['gst'],
                    "trade_no" => $data['trade'],
                    "pan_no" => $data['pan'],
                    "aadhar_no" => $data['aadhar']
                ];
                $wallet_data = [
                    "uid" => $this->generate_uid('VW'),
                    "user_id" => $user_data['uid'],
                    "balance" => 0
                ];

                $bank_data = [
                    'uid' => $this->generate_uid('VB'),
                    "user_id" => $user_data['uid'],
                    'user_name' => '',
                    'ifsc' => '',
                    'account_number' => ''
                ];

                if(!empty($uploadedFiles['user_img'])){
                    foreach ($uploadedFiles['user_img'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_IMG);
                        $vendor_data['user_img'] = $file_src;
                    }
                }

                if(!empty($uploadedFiles['signature'])){
                    foreach ($uploadedFiles['signature'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $vendor_data['signature_img'] = $file_src;
                    }
                }
                foreach ($uploadedFiles['pan_img'] as $file) {
                    $file_src = $this->single_upload($file, PATH_USER_DOC);
                    $vendor_data['pan_img'] = $file_src;
                }
                foreach ($uploadedFiles['aadhar_img'] as $file) {
                    $file_src = $this->single_upload($file, PATH_USER_DOC);
                    $vendor_data['aadhar_img'] = $file_src;
                }
                foreach ($uploadedFiles['gst'] as $file) {
                    $file_src = $this->single_upload($file, PATH_USER_DOC);
                    $vendor_data['gst'] = $file_src;
                }
                if(!empty($uploadedFiles['tread_licence'])){
                    foreach ($uploadedFiles['tread_licence'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $vendor_data['tread_licence'] = $file_src;
                    }
                }
                $VendorWalletModel = new VendorWalletModel();
                $UsersModel = new UsersModel();
                $VendorModel = new VendorModel();
                $VendorBankModel = new VendorBankModel();

                $UsersModel->insert($user_data);
                $VendorModel->insert($vendor_data);
                $VendorWalletModel->insert($wallet_data);
                $VendorBankModel->insert($bank_data);

                $resp['status'] = true;
                $resp['message'] = 'Vendor added successfully Please wait for admin approval.';
                $resp['data'] = ['vendor_id' => $vendor_data['uid']];
            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }

    private function seller($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
            "data" => []
        ];

        // $this->prd($data['user_id']);

        try {

            $sql = "SELECT
                        vendor.uid AS vendor_id,
                        vendor.user_img,
                        vendor.signature_img,
                        vendor.pan_img,
                        vendor.aadhar_img,
                        vendor.gst,
                        vendor.tread_licence,
                        users.uid AS user_id,
                        users.user_name,
                        users.number,
                        users.email
                    FROM
                        vendor
                    JOIN users ON vendor.user_id = users.uid
                    WHERE
                    users.uid = '{$data['user_id']}'";

            $CommonModel = new CommonModel();
            $vendors = $CommonModel->customQuery($sql);

            $vendors = json_decode(json_encode($vendors), true);
            if (!empty($vendors)) {
                $resp['status'] = true;
                $resp['message'] = "All vendors data retrieved";
                $resp['data'] = $vendors[0];
            } else {
                // If no access data found at all
                $resp['message'] = "No vendors data found";
            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;

    }

    private function update_seller($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update.",
            "data" => []
        ];

        try {
            if (empty($data['user_name'])) {
                $resp['message'] = 'Please add user name';
            } else if (empty($data['number'])) {
                $resp['message'] = 'Please add number';
            } else if (empty($data['email'])) {
                $resp['message'] = 'Please add email';
            } else {

                $updateUserData = [
                    "user_name" => $data['user_name'],
                    "email" => $data['email'],
                    "number" => $data['number'],
                ];

                $updateVendorDoc = [];
                $uploadedFiles = $this->request->getFiles();
                if (isset($uploadedFiles['user_img'])) {
                    foreach ($uploadedFiles['user_img'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_IMG);
                        $updateVendorDoc['user_img'] = $file_src;
                    }
                }
                if (isset($uploadedFiles['signature'])) {
                    foreach ($uploadedFiles['signature'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $updateVendorDoc['signature_img'] = $file_src;
                    }
                }
                if (isset($uploadedFiles['pan_img'])) {
                    foreach ($uploadedFiles['pan_img'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $updateVendorDoc['pan_img'] = $file_src;
                    }
                }
                if (isset($uploadedFiles['aadhar_img'])) {
                    foreach ($uploadedFiles['aadhar_img'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $updateVendorDoc['aadhar_img'] = $file_src;
                    }
                }
                if (isset($uploadedFiles['gst'])) {
                    foreach ($uploadedFiles['gst'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $updateVendorDoc['gst'] = $file_src;
                    }
                }
                if (isset($uploadedFiles['tread_licence'])) {
                    foreach ($uploadedFiles['tread_licence'] as $file) {
                        $file_src = $this->single_upload($file, PATH_USER_DOC);
                        $updateVendorDoc['tread_licence'] = $file_src;
                    }
                }
                $UsersModel = new UsersModel();
                $VendorModel = new VendorModel();

                // Update user details
                $isUserUpdated = $UsersModel->where(['uid' => $data['user_id']])->set($updateUserData)->update();
                if ($isUserUpdated) {
                    $isVendorUpdated = $VendorModel->where(['user_id' => $data['user_id']])->set($updateVendorDoc)->update();
                    if ($isVendorUpdated) {
                        $resp['status'] = true;
                        $resp['message'] = 'Seller update successfully';
                        $resp['data'] = "";
                    }
                }
                // Insert user data
                // $UsersModel->insert($user_data);


            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }

    private function seller_delete($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to Delete Seller.",
            "data" => []
        ];

        // $this->prd($data['user_id']);

        try {

            $UsersModel = new UsersModel();
            $VendorModel = new VendorModel();
            $BestSellingVendorModel = new BestSellingVendorModel();
            $deleteUser = $UsersModel->where('uid', $data['user_id'])->delete();
            if ($deleteUser) {
                $vendor_id = $VendorModel->where('user_id', $data['user_id'])->first();
                $deleteVendor = $VendorModel->where('user_id', $data['user_id'])->delete();
                $BestSellingVendorModel->where('vendor_id', $vendor_id['uid'])->delete();
            }
            if ($deleteVendor) {
                $resp['status'] = true;
                $resp['message'] = "Seller Deleteted Successful";
                $resp['data'] = "";
            } else {
                // If no access data found at all
                $resp['message'] = "No Seller found";
            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;

    }

    private function message_all()
    {
        $resp = [
            'status' => false,
            'message' => 'No messages found',
            'data' => []
        ];
        try {
            $MessageModel = new MessageModel();
            $messages = $MessageModel->findAll();
            if (count($messages) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'Messages found',
                    'data' => $messages
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function update_user_status($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update.",
            "data" => []
        ];

        try {
            if (empty($data['user_status'])) {
                $resp['message'] = 'User status not found';
            } else if (empty($data['user_id'])) {
                $resp['message'] = 'User not found';
            } else {

                $updateUserData = [
                    "status" => $data['user_status'],
                ];
                // $this->pr($data['user_id']);
                // $this->prd($data['user_status']);
                $UsersModel = new UsersModel();

                $isUserUpdated = $UsersModel->where(['uid' => $data['user_id']])->set($updateUserData)->update();
                if ($isUserUpdated) {
                    $resp['status'] = true;
                    $resp['message'] = 'Status update successfully';
                    $resp['data'] = "";

                }

            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }

    private function add_best_seller($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to Add Best Seller!.",
            "data" => []
        ];
        try {
            if (empty($data['vendors_id'])) {
                $resp['message'] = 'Please Add Vendor';
            } else {

                $updateUserData = [];
                $vendors = explode(',', $data['vendors_id']);
                foreach ($vendors as $vendor_id) {
                    $updateUserData[] = [
                        'uid' => $this->generate_uid('BSTSLR'),
                        'vendor_id' => $vendor_id
                    ];
                }
                $BestSellingVendorModel = new BestSellingVendorModel();
                $addSeller = $BestSellingVendorModel->insertBatch($updateUserData);
                if ($addSeller) {
                    $resp['status'] = true;
                    $resp['message'] = 'Best Seller Added Successfully';
                    $resp['data'] = "";

                }

            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }

    private function delete_best_seller($data)
    {
        $resp = [
            'status' => false,
            'message' => 'No Seller found',
            'data' => []
        ];
        if (empty($data['vendor_id'])) {
            $resp['message'] = 'Vendor not found!';
        } else {
            try {
                $BestSellingVendorModel = new BestSellingVendorModel();
                $delete_data = $BestSellingVendorModel->where('vendor_id', $data['vendor_id'])->delete();
                if ($delete_data) {
                    $resp = [
                        'status' => true,
                        'message' => 'Seller Deleted successfully',
                        'data' => ''
                    ];
                }
            } catch (\Exception $e) {
                $resp['message'] = $e;
            }
        }

        return $resp;
    }

    private function vendor_authorization($data)
    {
        $resp = [
            "status" => false,
            "message" => "Failed to update access.",
            "data" => []
        ];
        // $this->prd($data['user_id']);
        try {
            $uploadedFiles = $this->request->getFiles();
            if (empty($data['user_id'])) {
                $resp['message'] = 'User not found';
            } else if (empty($uploadedFiles['authImage'])) {
                $resp['message'] = 'Please add Image';
            } else if (empty($data['authDescription'])) {
                $resp['message'] = 'Please add Letter';
            } else {

                $authorization_data = [
                    "uid" => $this->generate_uid('VENAUTH'),
                    "user_id" => $data['user_id'],
                    // "authorization_img" => $data['authImage'],
                    "authorization_letter" => $data['authDescription'],

                ];

                foreach ($uploadedFiles['authImage'] as $file) {
                    $file_src = $this->single_upload($file, PATH_USER_DOC);
                    $authorization_data['authorization_img'] = $file_src;
                }

                // $UsersModel = new UsersModel();
                $VendorAuthorizationModel = new VendorAuthorizationModel();

                // Insert user data
                // $UsersModel->insert($user_data);
                // Insert vendor data
                $insert_data = $VendorAuthorizationModel->insert($authorization_data);
                if ($insert_data) {
                    $resp['status'] = true;
                    $resp['message'] = 'Vendor Authorization added succesfully.';
                    $resp['data'] = [];
                }

            }

        } catch (\Exception $e) {
            // Catch any exceptions and set error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }

    private function get_user_id_by_seller_id($seller_id)
    {
        $VendorModel = new VendorModel();
        $user = $VendorModel->where('uid', $seller_id)->first();
        return $user['user_id'];
    }

    private function update_social($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Failed!',
            'data' => null
        ];
        $uid = $data['uid'];

        if (empty($data['facebook'])) {
            $resp['message'] = 'Please Enter Facebook Link';
        } else if (empty($data['twitter'])) {
            $resp['message'] = 'Please Enter Twitter Link';
        } else if (empty($data['instagram'])) {
            $resp['message'] = 'Please Enter Instagram Link';
        } else if (empty($data['youtube'])) {
            $resp['message'] = 'Please Enter Youtube Link';
        } else {

            $link_data = [
                // "uid" => $this->generate_uid('SOCLIN'),
                'facebook' => $data['facebook'],
                'twitter' => $data['twitter'],
                'instagram' => $data['instagram'],
                'youtube' => $data['youtube']
            ];
            $SociallinkModel = new SociallinkModel();
            $SociallinkModel->transStart();
            try {
                $SociallinkModel->where('uid', $uid)->set($link_data)->update();
                $SociallinkModel->transCommit();
            } catch (\Exception $e) {
                $SociallinkModel->transRollback();
                throw $e;
            }
            $resp['status'] = true;
            $resp['message'] = 'Insertion Successful';
            $resp['data'] = [];
        }
        return $resp;
    }
    private function get_social()
    {
        // echo $user_id;
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "user_data" => ""
        ];
        $SociallinkModel = new SociallinkModel();
        $SocialData = $SociallinkModel
            ->first();

        $resp = [
            "status" => true,
            "message" => "Data fetched",
            "user_data" => $SocialData
        ];
        return $resp;
    }
    private function get_notice()
    {
        // echo $user_id;
        $resp = [
            "status" => false,
            "message" => "Data Not Found",
            "user_data" => ""
        ];
        $NoticebarModel = new NoticebarModel();
        $Noticedata = $NoticebarModel
            ->first();

        $resp = [
            "status" => true,
            "message" => "Data fetched",
            "user_data" => $Noticedata
        ];
        return $resp;
    }

    private function update_notice($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Failed!',
            'data' => null
        ];
        $uid = $data['uid'];

        if (empty($data['notice'])) {
            $resp['message'] = 'Please Enter Notice';
        } else {

            $notice_data = [
                "uid" => $this->generate_uid('NOTLIN'),
                'notice' => $data['notice']
            ];
            $NoticebarModel = new NoticebarModel();
            $NoticebarModel->transStart();
            try {
                // $NoticebarModel->insert($link_data);
                $NoticebarModel->where('uid', $uid)->set($notice_data)->update();
                $NoticebarModel->transCommit();
            } catch (\Exception $e) {
                $NoticebarModel->transRollback();
                throw $e;
            }
            $resp['status'] = true;
            $resp['message'] = 'Insertion Successful';
            $resp['data'] = [];
        }
        return $resp;
    }
    private function newsletter_email($data)
    {

        $resp = [
            'status' => false,
            'message' => 'Failed!',
            'data' => null
        ];
        // $uid=$data['uid'];

        if (empty($data['email'])) {
            $resp['message'] = 'Please Enter Email';
        } else {

            $email_data = [
                "uid" => $this->generate_uid('NEWLET'),
                'email' => $data['email']
            ];
            $NewsletterModel = new NewsletterModel();
            $NewsletterModel->transStart();
            try {
                // $NoticebarModel->insert($link_data);
                $NewsletterModel->insert($email_data);
                $NewsletterModel->transCommit();
            } catch (\Exception $e) {
                $NewsletterModel->transRollback();
                throw $e;
            }
            $resp['status'] = true;
            $resp['message'] = 'Insertion Successful';
            $resp['data'] = [];
        }
        return $resp;
    }

    private function newsletter_all()
    {
        $resp = [
            'status' => false,
            'message' => 'No newsletter found',
            'data' => []
        ];
        try {
            $NewsletterModel = new NewsletterModel();
            $newsletter = $NewsletterModel->findAll();
            if (count($newsletter) > 0) {
                $resp = [
                    'status' => true,
                    'message' => 'newsletter found',
                    'data' => $newsletter
                ];
            }
        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    public function vendor_wallet_history($data)
    {
        $resp = [
            'status' => false,
            'message' => 'History Not found',
            'data' => []
        ];
        try {
            $userId = $data['u'];
            $VendorWalletHistoryModel = new VendorWalletHistoryModel();
            $history = $VendorWalletHistoryModel->where('user_id', $userId)->findAll();


            $resp = [
                'status' => !empty($history),
                'message' => !empty($history) ? 'History found' : 'History Not found',
                'data' => $history
            ];

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }


    public function vendor_withdrawal_history($data)
    {
        $resp = [
            'status' => false,
            'message' => 'History Not found',
            'data' => []
        ];
        try {
            $VendorWithdrawalHistoryModel = new VendorWithdrawalHistoryModel();
            $VendorWalletModel = new VendorWalletModel;
            $UsersModel = new UsersModel();
            $VendorBankModel = new VendorBankModel();
            $history = null;
            if ($data['s']) {
                $status = $data['s'];
                $history = $VendorWithdrawalHistoryModel->where('status', $status)->findAll();

                if (!empty($history)) {
                    foreach ($history as &$record) {
                        // Initialize default values
                        $record['current_balance'] = 0; // Default to 0 if no wallet record found
                        $record['user_details'] = null; // Add user details if needed

                        // Fetch wallet balance
                        $wallet = $VendorWalletModel->where('user_id', $record['user_id'])->first('balance');
                        if ($wallet) {
                            $record['current_balance'] = $wallet['balance'];
                        }

                        // Fetch user details
                        $user = $UsersModel->where('uid', $record['user_id'])->first();
                        if ($user) {
                            $record['user_details'] = $user; // Add user details if required
                            $userBank = $VendorBankModel->where('user_id', $record['user_id'])->first();
                            if ($userBank) {
                                $record['user_details']['bank'] = $userBank;
                            }
                        }


                    }
                }


            } else {
                $userId = $data['u'];
                $history = $VendorWithdrawalHistoryModel->where('user_id', $userId)->findAll();
            }


            $resp = [
                'status' => !empty($history),
                'message' => !empty($history) ? 'History found' : 'History Not found',
                'data' => $history
            ];

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }


    public function vendor_wallet($data)
    {

        $resp = [
            'status' => false,
            'message' => 'wallet Not found',
            'data' => []
        ];
        try {
            $userId = $data['u'];
            $VendorWalletModel = new VendorWalletModel();
            $wallet = $VendorWalletModel->where('user_id', $userId)->first();


            $resp = [
                'status' => !empty($wallet),
                'message' => !empty($wallet) ? 'wallet found' : 'wallet Not found',
                'data' => $wallet
            ];

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;

    }

    private function vendor_withdrawal_request($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Request Not Added',
            'data' => []
        ];
        try {
            $userId = $data['user_id'];
            $amount = $data['amount'];

            $req_data = [
                'uid' => $this->generate_uid('VWR'),
                'user_id' => $userId,
                'amount' => $amount
            ];
            $VendorWithdrawalHistoryModel = new VendorWithdrawalHistoryModel();
            $isAdded = $VendorWithdrawalHistoryModel->insert($req_data);

            $resp = [
                'status' => $isAdded,
                'message' => $isAdded ? 'Request Added' : 'Request Not Submitted',
            ];

        } catch (\Exception $e) {
            $resp['message'] = $e;
        }
        return $resp;
    }

    private function vendor_withdrawal_history_delete($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Request not deleted',
            'data' => []
        ];
        try {
            $uid = $data['r'];

            if (empty($uid)) {
                throw new \Exception("Invalid request ID provided");
            }

            $VendorWithdrawalHistoryModel = new VendorWithdrawalHistoryModel();
            $isDeleted = $VendorWithdrawalHistoryModel->where('uid', $uid)->delete();

            if ($isDeleted) {
                $resp['status'] = true;
                $resp['message'] = 'Request deleted successfully';
            } else {
                $resp['message'] = 'Request not found or could not be deleted';
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;
    }


    private function seller_bank($data)
    {
        $resp = [
            'status' => false,
            'message' => 'bannk not found',
            'data' => []
        ];
        try {
            $uid = $data['u'];

            if (empty($uid)) {
                throw new \Exception("Invalid request ID provided");
            }

            $VendorBankModel = new VendorBankModel();
            $bank = $VendorBankModel->where('user_id', $uid)->first();

            if ($bank) {
                $resp['status'] = true;
                $resp['message'] = 'bannk found successfully';
                $resp['data'] = $bank;
            } else {
                $resp['message'] = 'bannk not found';
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }
        return $resp;
    }

    private function seller_bank_update($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Failed to update or insert bank details',
            'data' => []
        ];

        try {
            $VendorBankModel = new VendorBankModel();
            $UsersModel = new UsersModel();
            $uploadedFiles = $this->request->getFiles();

            // Prepare the data for bank details
            $updateData = [
                'user_id' => $data['user_id'],
                'user_name' => $data['user_name'],
                'ifsc' => $data['ifsc'],
                'account_number' => $data['account_number']
            ];

            // Handle file upload
            if (!empty($uploadedFiles['acc_check']) && $uploadedFiles['acc_check']->isValid()) {
                $file_src = $this->single_upload($uploadedFiles['acc_check'], PATH_USER_DOC);
                $updateData['bank_img'] = $file_src;
            } else {
                throw new \Exception("Invalid or no file uploaded for 'acc_check'.");
            }

            // Check if the bank record exists for the given user ID
            $existingBank = $VendorBankModel->where('user_id', $data['user_id'])->first();

            if ($existingBank) {
                // Update the existing record
                $VendorBankModel->where('user_id', $data['user_id'])->update(null, $updateData);
            } else {
                $updateData['uid'] = $this->generate_uid('VB');
                // Insert a new record
                $VendorBankModel->insert($updateData);
            }

            // Update user data to mark as authenticated
            $userUpdateData = ['is_auth' => 'true'];
            $UsersModel->where('uid', $data['user_id'])->update(null, $userUpdateData);

            // Check if the operation affected rows in either table
            if ($VendorBankModel->db->affectedRows() > 0) {
                $resp['status'] = true;
                $resp['message'] = 'Bank details processed successfully';
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }


        return $resp;
    }


    private function seller_withdrawal_send($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Failed to process payout',
            'data' => []
        ];

        try {
            $VendorBankModel = new VendorBankModel();
            $VendorWalletModel = new VendorWalletModel();
            $VendorWalletHistoryModel = new VendorWalletHistoryModel();
            $VendorWithdrawalHistoryModel = new VendorWithdrawalHistoryModel();

            // Fetch user ID from withdrawal history
            $userIdRecord = $VendorWithdrawalHistoryModel->where('uid', $data['request_id'])->first('user_id');
            $userId = $userIdRecord ? $userIdRecord['user_id'] : null;

            if (!$userId) {
                throw new \Exception("User ID not found for the given request ID.");
            }

            // Fetch bank details
            $bankDetails = $VendorBankModel->where('user_id', $userId)->first();
            if (!$bankDetails) {
                throw new \Exception("Bank details not found for the user.");
            }

            // Fetch wallet details
            $walletDetails = $VendorWalletModel->where('user_id', $userId)->first();
            if (!$walletDetails) {
                throw new \Exception("Wallet details not found for the user.");
            }

            // Ensure sufficient balance in wallet
            $amountToWithdraw = $data['amount'];
            if ($walletDetails['balance'] < $amountToWithdraw) {
                throw new \Exception("Insufficient wallet balance.");
            }


            // Update wallet balance
            $newBalance = $walletDetails['balance'] - $amountToWithdraw;
            $VendorWalletModel->update($walletDetails['id'], ['balance' => $newBalance]);

            // Log wallet transaction history
            $VendorWalletHistoryModel->insert([
                'uid' => $this->generate_uid('VWH'),
                'user_id' => $userId,
                'debited' => $amountToWithdraw,
                'credited' => 0,
                'closing_balance' => $newBalance
            ]);

            $VendorWithdrawalHistoryModel->where('uid', $data['request_id'])->update(null, [
                'status' => 'completed',
                'amount' => $amountToWithdraw
            ]);

            // Success response
            $resp['status'] = true;
            $resp['message'] = 'Payout processed successfully';
            // $resp['data'] = $payoutResult['data'];

        } catch (\Exception $e) {
            // Catch any exceptions and return the error message
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }

    /**
     * Create Razorpay Payout
     */
    private function createRazorpayPayout($bank, $amount)
    {
        // Define Razorpay credentials and endpoint
        $keyId = RAZORPAY_KEY_LIVE_ID;
        $keySecret = RAZORPAY_KEY_LIVE_SECRET;
        $url = "https://api.razorpay.com/v2/payouts";

        // Prepare payout data
        $data = [
            "fund_account" => [
                "account_type" => $bank['account_number'],
                "bank_account" => [
                    "name" => $bank['user_name'],
                    "ifsc" => $bank['ifsc'],
                    "account_number" => $bank['account_number']
                ]
            ],
            "amount" => intval($amount * 100), // Convert to paise
            "currency" => "INR",
            "mode" => "IMPS",  // Choose IMPS, NEFT, or RTGS
            "purpose" => "payout",
            "queue_if_low_balance" => true,
            "reference_id" => "TXN" . uniqid(),
            "narration" => "Vendor Payout"
        ];

        // Initialize cURL session to make API request
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Set headers and authentication
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
            curl_setopt($ch, CURLOPT_USERPWD, "$keyId:$keySecret");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable cURL debugging

            $response = curl_exec($ch);
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            $this->prd($response);

            if ($httpStatus === 200 || $httpStatus === 201) {
                $responseData = json_decode($response, true);
                return [
                    "status" => true,
                    "message" => "Payout created successfully",
                    "data" => $responseData
                ];
            } else {
                // Log the raw response for debugging
                // $errorResponse = json_decode($response, true);
                return [
                    "status" => false,
                    "message" => '',
                    "data" => $response
                ];
            }
        } catch (\Exception $e) {
            // Log exception error for debugging
            return [
                "status" => false,
                "message" => "Curl error: " . $e->getMessage()
            ];
        }
    }

    private function update_business_address($data)
    {
        $resp = [
            'status' => false,
            'message' => 'Failed to update business details',
            'data' => []
        ];

        try {
            $user_id = $this->is_logedin();
            $commonModel = new CommonModel();
            $AddressModel = new AddressModel();
            $is_address = $AddressModel
                ->where('user_id', $user_id)
                ->where('type', 'business')
                ->first();

            if (empty($is_address)) {
                $Address_data = [
                    'uid' => $this->generate_uid('ADDR'),
                    'user_id' => $user_id,
                    'type' => 'business',
                    'business_address' => $data['address'],
                    'business_phone' => $data['number'],
                    'business_name' => $data['name'],
                    'business_good_name' => $data['goodsname'],
                    'zipcode' => $data['zip'],
                    'locality' => $data['landmark'],
                    'business_email' => $data['email'],
                    'gst' => $data['gst'],
                ];

                // Return the raw insert query
                $query = $AddressModel->builder()->set($Address_data)->getCompiledInsert();
                $commonModel->customQuery($query);
                $resp['status'] = true;
                $resp['message'] = 'Generated Insert Query';
                // $resp['data'] = $query;
            } else {
                $updateData = [
                    'business_address' => $data['address'],
                    'business_phone' => $data['number'],
                    'business_name' => $data['name'],
                    'business_good_name' => $data['goodsname'],
                    'zipcode' => $data['zip'],
                    'locality' => $data['landmark'],
                    'business_email' => $data['email'],
                    'gst' => $data['gst'],
                ];

                // Return the raw update query
                $query = $AddressModel->builder()
                    ->set($updateData)
                    ->where('user_id', $user_id)
                    ->where('type', 'business')
                    ->getCompiledUpdate();
                $commonModel->customQuery($query);
                $resp['status'] = true;
                $resp['message'] = 'Generated Update Query';
                // $resp['data'] = $query;
            }
        } catch (\Exception $e) {
            $resp['message'] = $e->getMessage();
        }

        return $resp;
    }


    private function delete_staff($data)
    {
        $resp = [
            'status' => false,
            'message' => 'No Staff found',
            'data' => []
        ];
        // $this->prd($data);
        if (empty($data['staff_id'])) {
            $resp['message'] = 'Vendor not found!';
        } else {
            try {
                $UsersModel = new UsersModel();
                $StaffModel = new StaffModel();
                // $delete_data = $StaffModel->where('uid', $data['staff_id'])->delete();
                $CommonModel = new CommonModel();
                $sql = "
                    DELETE staff, users
                    FROM staff
                    INNER JOIN users ON staff.user_id = users.uid
                    WHERE staff.uid = '{$data['staff_id']}'
                ";
                $delete_data = $CommonModel->customQuery($sql);
                if ($delete_data) {
                    $resp = [
                        'status' => true,
                        'message' => 'Staff Deleted successfully',
                        'data' => ''
                    ];
                }
            } catch (\Exception $e) {
                $resp['message'] = $e;
            }
        }

        return $resp;
    }



    public function POST_update_business()
    {
        $data = $this->request->getPost();
        $resp = $this->update_business_address($data);
        return $this->response->setJSON($resp);
    }


    public function POST_seller_withdrawal_send()
    {
        $data = $this->request->getPost();
        $resp = $this->seller_withdrawal_send($data);
        return $this->response->setJSON($resp);

    }


    public function POST_seller_bank_update()
    {
        $data = $this->request->getPost();
        $resp = $this->seller_bank_update($data);
        return $this->response->setJSON($resp);
    }

    public function GET_delete_staff()
    {
        $data = $this->request->getGet();
        $resp = $this->delete_staff($data);
        return $this->response->setJSON($resp);
    }

    public function GET_seller_bank()
    {
        $data = $this->request->getGet();
        $resp = $this->seller_bank($data);
        return $this->response->setJSON($resp);
    }

    public function GET_vendor_withdrawal_history_delete()
    {
        $data = $this->request->getGet();
        $resp = $this->vendor_withdrawal_history_delete($data);
        return $this->response->setJSON($resp);
    }

    public function POST_vendor_withdrawal_request()
    {
        $data = $this->request->getPost();
        $resp = $this->vendor_withdrawal_request($data);
        return $this->response->setJSON($resp);
    }


    public function GET_vendor_wallet_history()
    {
        $data = $this->request->getGet();
        $resp = $this->vendor_wallet_history($data);
        return $this->response->setJSON($resp);
    }

    public function GET_vendor_wallet()
    {
        $data = $this->request->getGet();
        $resp = $this->vendor_wallet($data);
        return $this->response->setJSON($resp);
    }

    public function GET_vendor_withdrawal_history()
    {
        $data = $this->request->getGet();
        $resp = $this->vendor_withdrawal_history($data);
        return $this->response->setJSON($resp);
    }


    public function POST_add_new_seller()
    {
        $data = $this->request->getPost();
        $resp = $this->add_new_seller($data);
        return $this->response->setJSON($resp);
    }

    public function POST_vendor_authorization()
    {
        $data = $this->request->getPost();
        $resp = $this->vendor_authorization($data);
        return $this->response->setJSON($resp);
    }

    public function GET_all_best_seller_list()
    {
        $data = $this->request->getGet();
        $resp = $this->all_best_seller_list($data);
        return $this->response->setJSON($resp);
    }

    public function GET_delete_best_seller()
    {
        $data = $this->request->getGet();
        $resp = $this->delete_best_seller($data);
        return $this->response->setJSON($resp);
    }


    public function POST_add_best_seller()
    {
        $data = $this->request->getPost();
        $resp = $this->add_best_seller($data);
        return $this->response->setJSON($resp);
    }

    public function POST_update_user_status()
    {
        $data = $this->request->getPost();
        $resp = $this->update_user_status($data);
        return $this->response->setJSON($resp);
    }


    public function GET_seller_list()
    {
        $data = $this->request->getGet();
        $resp = $this->seller_list($data);
        return $this->response->setJSON($resp);
    }

    public function GET_a_seller()
    {
        $data = $this->request->getGet();
        $resp = $this->seller($data);
        return $this->response->setJSON($resp);
    }

    public function POST_staff_update()
    {
        $data = $this->request->getPost();
        $resp = $this->staff_update($data);
        return $this->response->setJSON($resp);
    }

    public function GET_access_update()
    {
        $data = $this->request->getGet();
        $resp = $this->access_update($data);
        return $this->response->setJSON($resp);
    }


    public function GET_staff()
    {
        $data = $this->request->getGet();
        $resp = $this->staff($data);
        return $this->response->setJSON($resp);

    }

    public function POST_staff_add()
    {
        $data = $this->request->getPost();
        $resp = $this->staff_add($data);
        return $this->response->setJSON($resp);

    }
    public function GET_access_add()
    {

        $data = $this->request->getGet();
        $resp = $this->access_add($data);
        return $this->response->setJSON($resp);

    }

    public function GET_staff_access()
    {
        $data = $this->request->getGet();
        $resp = $this->staff_access($data);
        return $this->response->setJSON($resp);

    }

    public function POST_update_user()
    {
        $data = $this->request->getPost();
        $resp = $this->update_user($data);
        return $this->response->setJSON($resp);

    }

    public function POST_update_seller()
    {
        $data = $this->request->getPost();
        $resp = $this->update_seller($data);
        return $this->response->setJSON($resp);

    }

    public function GET_message_all()
    {
        $data = $this->request->getGet();
        $resp = $this->message_all($data);
        return $this->response->setJSON($resp);

    }

    public function POST_change_password()
    {
        $data = $this->request->getPost();
        $resp = $this->change_password($data);
        return $this->response->setJSON($resp);

    }

    public function POST_message()
    {
        $data = $this->request->getPost();
        $resp = $this->message($data);
        return $this->response->setJSON($resp);

    }

    public function GET_get_user()
    {

        $resp = $this->get_user();
        return $this->response->setJSON($resp);

    }

    public function GET_customer()
    {
        $data = $this->request->getGet();
        $resp = $this->customer($data);
        return $this->response->setJSON($resp);

    }

    public function GET_delete_customer()
    {
        $data = $this->request->getGet();
        $resp = $this->delete_customer($data);
        return $this->response->setJSON($resp);

    }

    public function GET_total_customer()
    {
        $resp = $this->total_customer();
        return $this->response->setJSON($resp);
    }

    public function GET_seller_delete()
    {
        $data = $this->request->getGet();
        $resp = $this->seller_delete($data);
        return $this->response->setJSON($resp);
    }

    public function GET_get_admin()
    {
        $data = $this->request->getGet();
        $resp = $this->get_admin($data);
        return $this->response->setJSON($resp);

    }

    public function POST_update_admin()
    {
        $data = $this->request->getPost();
        $resp = $this->update_admin($data);
        return $this->response->setJSON($resp);

    }

    public function POST_change_admin_password()
    {
        $data = $this->request->getPost();
        $resp = $this->change_admin_password($data);
        return $this->response->setJSON($resp);

    }
    public function POST_insert_sociallink()
    {
        $data = $this->request->getPost();
        $resp = $this->update_social($data);
        return $this->response->setJSON($resp);

    }
    public function GET_sociallink()
    {
        $resp = $this->get_social();
        return $this->response->setJSON($resp);

    }

    public function GET_noticebar()
    {
        $resp = $this->get_notice();
        return $this->response->setJSON($resp);
    }
    public function POST_insert_noticelink()
    {
        $data = $this->request->getPost();
        $resp = $this->update_notice($data);
        return $this->response->setJSON($resp);

    }

    public function POST_insert_newsletteremail()
    {
        $data = $this->request->getPost();
        $resp = $this->newsletter_email($data);
        return $this->response->setJSON($resp);

    }
    public function GET_newsletter_all()
    {
        $data = $this->request->getGet();
        $resp = $this->newsletter_all($data);
        return $this->response->setJSON($resp);

    }



}
