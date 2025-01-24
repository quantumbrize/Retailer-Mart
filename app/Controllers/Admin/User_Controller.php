<?php
namespace App\Controllers\Admin;
use App\Controllers\Admin\Admin_Controller;

class User_Controller extends Admin_Controller
{

    public function index(): void
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['customer_css.php'],
                'title' => 'Customer',
                'header' => [],
                'sidebar' => ['customer' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['customer_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/customers', $data);
    }



    public function load_customer()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['customer_css.php'],
                'title' => 'Customer',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['customer_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/customers', $data);
    }

    public function load_vendor()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['vendor_css.php'],
                'title' => 'Vendor',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['vendor_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/vendors', $data);
    }

    public function load_vendor_wallet()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['vendor_wallet_css.php'],
                'title' => 'Vendor Wallet',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['vendor_wallet_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];
        $this->isAuth('/admin/vendor_wallet', $data);
    }

    public function load_vendor_wallet_history()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['vendor_wallet_history_css.php'],
                'title' => 'Vendor Wallet history',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['vendor_wallet_history_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];
        $this->isAuth('/admin/vendor_wallet_history', $data);
    }

    public function load_vendor_withdrawal_history()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['vendor_withdrawal_history_css.php'],
                'title' => 'Vendor Wallet history',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['vendor_withdrawal_history_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];
        $this->isAuth('/admin/vendor_withdrawal_history', $data);
    }

    public function load_vendor_withdrawal_requests()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['vendor_withdrawal_requests_css.php'],
                'title' => 'Vendor Withdrawal Requests',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['vendor_withdrawal_requests_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];
        $this->isAuth('/admin/vendor_withdrawal_requests', $data);


    }

    public function load_best_selling_vendor()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['best_selling_vendor_css.php'],
                'title' => 'Best Selling',
                'header' => [],
                'sidebar' => ['best_selling_vendor' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['best_selling_vendor_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/best_selling_vendor', $data);
    }

    public function load_all_best_selling_vendor()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['all_best_selling_vendor_css.php'],
                'title' => 'Best Selling',
                'header' => [],
                'sidebar' => ['best_selling_vendor' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['all_best_selling_vendor_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/all_best_selling_vendor', $data);
    }


    public function load_staff()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['staff_css.php'],
                'title' => 'Staff',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['staff_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/staff', $data);
    }

    public function load_staff_add()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['staff_add_css.php'],
                'title' => 'New Staff',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['staff_add_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/staff_add', $data);
    }

    function load_staff_update()
    {

        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['staff_single_css.php'],
                'title' => 'Staff',
                'header' => [],
                'sidebar' => ['users' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['staff_single_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/staff_single', $data);

    }

    public function load_admon_profile()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['admin_profile_css.php'],
                'title' => 'Admin Profile',
                'header' => [],
                'sidebar' => ['admin_profile' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['admin_profile_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/admin_profile', $data);
    }

    public function load_messages()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['messages_css.php'],
                'title' => 'Messages',
                'header' => [],
                'sidebar' => ['messages' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['messages_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/messages', $data);
    }

    public function load_add_expart_review()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['expart_review_add_css.php'],
                'title' => 'Expart Review',
                'header' => [],
                'sidebar' => ['expart_review' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['expart_review_add_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/expart_review_add', $data);
    }

    public function load_expart_review()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['exparts_reviews_css.php'],
                'title' => 'Expart Review',
                'header' => [],
                'sidebar' => ['expart_review' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['exparts_reviews_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/exparts_reviews', $data);
    }

    public function load_review()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['reviews_css.php'],
                'title' => 'Expart Review',
                'header' => [],
                'sidebar' => ['expart_review' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['reviews_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/reviews', $data);
    }

    public function load_newsletter()
    {
        $data = PAGE_DATA_ADMIN;
        $data = [
            'data_page' => [],
            'data_header' => [
                'header_link' => ['newsletter_css.php'],
                'title' => 'Newsletter',
                'header' => [],
                'sidebar' => ['newsletter' => true],
                'site' => 'admin'
            ],
            'data_footer' => [
                'footer_link' => ['newsletter_js.php'],
                'footer' => [],
                'site' => 'admin'
            ]
        ];

        $this->isAuth('/admin/newsletter', $data);
    }



}

?>