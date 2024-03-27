<?php

// Parse the incoming request body as JSON
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Extract relevant data from the request
$transaction_type = $data['TransactionType'];
$trans_id = $data['TransID'];
$trans_amount = $data['TransAmount'];
$shortcode = $data['BusinessShortCode'];
$bill_ref_number = $data['BillRefNumber'];
$msisdn = $data['MSISDN'];

// Perform your validation logic here
// For demonstration purposes, we'll just log the validation data and approve the transaction

// Log the validation data
$log_message = "Validation received for Transaction ID: $trans_id, Amount: $trans_amount";
file_put_contents('validation_log.txt', $log_message . PHP_EOL, FILE_APPEND);

// Send a success response
header('Content-Type: application/json');
echo json_encode(['ResultCode' => '0', 'ResultDesc' => 'Accepted']);

?>
