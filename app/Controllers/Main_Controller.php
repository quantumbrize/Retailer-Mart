<?php

namespace App\Controllers;

class Main_Controller extends BaseController
{
	public function __construct()
	{
		// Load session library
		$this->session = \Config\Services::session();
	}


	public function send_mail($data)
	{
		$emailService = \Config\Services::email();
		$emailService->setFrom($data['setFrom_mail'], $data['setFrom_name']);
		$emailService->setTo($data['setTo_mail']);
		$emailService->setSubject($data['setTo_subject']);
		$emailService->setMessage($data['message']);

		if ($emailService->send()) {
			return true;
		} else {
			// Print detailed error information
			$data = $emailService->printDebugger(['headers']);
			print_r($data);
		}
	}

	public function load_page($page, $data): void
	{
		$this->load_headers($data['data_header']);
		echo view($page, $data['data_page']);
		$this->load_footers($data['data_footer']);
	}
	private function load_headers($data): void
	{
		echo view('/' . $data['site'] . '/inc/header_link.php', $data);
		echo view('/' . $data['site'] . '/inc/header.php', $data);
		echo view('/' . $data['site'] . '/inc/sidebar.php', $data);
	}

	private function load_footers($data): void
	{
		echo view('/' . $data['site'] . '/inc/footer.php');
		echo view('/' . $data['site'] . '/inc/footer_link.php', $data);
	}

	public function index(): void
	{
		echo ENVIRONMENT;
	}
	public function prd($data): void
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		die();
	}
	public function pr($data): void
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	private function uid()
	{
		return strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
	}

	public function generate_uid($purpose)
	{
		return $purpose . $this->uid() . date('Ymd');
	}

	public function generate_otp()
	{
		return rand(1000, 9999);
	}

	public function is_logedin()
	{
		// $userID = $this->request->getCookie(SES_USER_USER_ID);
		$userID = $this->session->get(SES_USER_USER_ID);
		return $userID;
	}

	public function is_seller_logedin()
	{
		$sellerID = $this->session->get(SES_SELLER_ID);
		return $sellerID;
	}

	function calculateDiscount($basePrice, $discountPercentage)
	{
		// Ensure the base price and discount percentage are numeric
		if (!is_numeric($basePrice) || !is_numeric($discountPercentage)) {
			return "Invalid input. Please provide numeric values.";
		}

		// Calculate the discount amount
		$discountAmount = $basePrice * ($discountPercentage / 100);

		// Return the discount amount
		return $discountAmount;
	}



	public function single_upload($file, $path)
	{
		if ($file->isValid() && !$file->hasMoved()) {
			try {
				$newName = $file->getRandomName();
				$file->move($path, $newName);
				// Log successful upload
				$this->log('File uploaded successfully: ' . $newName);
				return $newName;
			} catch (\Exception $e) {
				// Log upload error
				$this->log('Error uploading file: ' . $e->getMessage());
				return $e->getMessage();
			}
		} else {
			// Log invalid file or already moved file
			$this->log('Invalid file or file already moved');
			return null;
		}
	}
	private function log($message)
	{
		// You can implement your logging mechanism here, such as writing to a file or database
		error_log($message);
	}

	public function generateRandomSKU($length = 10)
	{
		return substr(bin2hex(random_bytes($length)), 0, $length);
	}



	public function authenticateShiprocket($email, $password)
	{
		$url = "https://apiv2.shiprocket.in/v1/external/auth/login";

		$data = [
			"email" => $email,
			"password" => $password
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Content-Type: application/json"
		]);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$response = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($response, true);
		return $result['token'] ?? null;
	}


	function createCustomOrder($token, $orderData)
	{
		$url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Content-Type: application/json",
			"Authorization: Bearer $token"
		]);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}

	function cancelShiprocketOrder($token, $orderIds)
	{
		$url = "https://apiv2.shiprocket.in/v1/external/orders/cancel";

		$data = [
			"ids" => $orderIds
		];

		$headers = [
			"Content-Type: application/json",
			"Authorization: Bearer $token"
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}

	function createReturnOrder($token, $orderId, $returnDetails)
	{
		$url = "https://apiv2.shiprocket.in/v1/external/orders/create/return";

		// Prepare the return order data
		$data = $returnDetails;

		// Headers for authorization and content type
		$headers = [
			"Content-Type: application/json",
			"Authorization: Bearer $token"
		];

		// Initialize cURL
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		// Execute and close cURL
		$response = curl_exec($ch);
		curl_close($ch);

		// Return response as an associative array
		return json_decode($response, true);
	}

	function getOrderDetails($token, $orderId) {
		// Construct the API URL with the given order ID
		$url = "https://apiv2.shiprocket.in/v1/external/orders/show/" . $orderId;
	
		// Headers for authorization and content type
		$headers = [
			"Content-Type: application/json",
			"Authorization: Bearer $token"
		];
	
		// Initialize cURL
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Get the response as a string
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers
	
		// Execute the cURL request
		$response = curl_exec($ch);
	
		// Handle errors
		if ($response === false) {
			$error = curl_error($ch);
			curl_close($ch);
			return ["error" => "Curl error: $error"];
		}
	
		curl_close($ch);
	
		// Return the response as an associative array
		return json_decode($response, true);
	}

	
	function getReturns($token) {
		// Construct the API URL
		$url = "https://apiv2.shiprocket.in/v1/external/orders/processing/return";
	
		// Headers for authorization and content type
		$headers = [
			"Content-Type: application/json",
			"Authorization: Bearer $token" // Include the Bearer token for authentication
		];
	
		// Initialize cURL
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Get the response as a string
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set headers
	
		// Execute the cURL request
		$response = curl_exec($ch);
	
		// Handle errors
		if ($response === false) {
			$error = curl_error($ch);
			curl_close($ch);
			return ["error" => "Curl error: $error"];
		}
	
		curl_close($ch);
	
		// Return the response as an associative array
		return json_decode($response, true);
	}


	public function logoutShiprocket($token)
	{
		$url = "https://apiv2.shiprocket.in/v1/external/auth/logout";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Content-Type: application/json",
			"Authorization: Bearer $token"
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($response, true);

		if (isset($result['status_code']) && $result['status_code'] == 200) {
			return [
				'status' => true,
				'message' => 'Successfully logged out from Shiprocket'
			];
		} else {
			return [
				'status' => false,
				'message' => 'Failed to log out from Shiprocket',
				'error' => $result['message'] ?? 'Unknown error'
			];
		}
	}


	function assignAwb($token, $orderId, $courierId = null)
	{
		$url = "https://apiv2.shiprocket.in/v1/external/courier/assign/awb";

		// Prepare the payload
		$data = [
			"order_id" => $orderId,
		];

		// Include courier_id only if it's provided
		if ($courierId) {
			$data["courier_id"] = $courierId;
		}

		// Initialize cURL session
		$ch = curl_init($url);

		// Set the options
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Content-Type: application/json",
			"Authorization: Bearer $token"
		]);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		// Execute the request and capture response
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// Handle potential errors
		if (curl_errno($ch)) {
			echo 'Curl error: ' . curl_error($ch);
		}

		// Close the cURL session
		curl_close($ch);

		

		return $response;
	}





}
