<?php
// Ensure that the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $postData = file_get_contents('php://input');

    // Decode the JSON data
    $jsonData = json_decode($postData, true);

    // Check if the data contains the stkCallback key
    if (isset($jsonData['Body']['stkCallback'])) {
        // Extract relevant information from the callback
        $callbackData = $jsonData['Body']['stkCallback'];

        // Example: Log the callback data to a file
        file_put_contents('callback_log.txt', print_r($callbackData, true), FILE_APPEND);

        // Example: Process the callback data
        $resultCode = $callbackData['ResultCode'];
        $checkoutRequestId = $callbackData['CheckoutRequestID'];
        $resultDesc = $callbackData['ResultDesc'];
        $amountPaid = $callbackData['CallbackMetadata']['Item'][0]['Value'];

        // Example: Update payment status in your database based on the callback
        if ($resultCode == 0 && $resultDesc == "Success") {
            // Payment successful
            // Update payment status to 'success'
        } else {
            // Payment failed or rejected
            // Update payment status to 'failed'
        }

        // Respond with an HTTP 200 status to acknowledge receipt of the callback
        http_response_code(200);
        echo 'Callback received successfully.';
    } else {
        // Respond with an HTTP 400 status if the callback data is invalid
        http_response_code(400);
        echo 'Invalid callback data.';
    }
} else {
    // Respond with an HTTP 405 status if the request method is not POST
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>

