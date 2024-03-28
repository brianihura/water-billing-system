<?php
if(isset($_POST['submit'])){

  date_default_timezone_set('Africa/Nairobi');

  # access token
  $consumerKey = 'SROFWMjZbRcAAunAGBqG4oVa7VNRdHF9uwaTLuud6BIUa0GN'; //Fill with your app Consumer Key
  $consumerSecret = 'ZAtxlbxeD7PSDeNWMk5ev3PpqdR9dLF3veRVEgDrfTs1AsxOJLXeAGkXvT1M0ACT'; // Fill with your app Secret

  # define the variables
  # provide the following details, this part is found on your test credentials on the developer account
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  
  /*
    This are your info, for
    $PartyA should be the ACTUAL client's phone number or your phone number, format 2547********
    $AccountReference, it may be an invoice number, account number, etc., on production systems, but for testing just put anything
    TransactionDesc can be anything, probably a better description of the transaction
    $Amount, this is the total invoiced amount. Any amount here will be 
    actually deducted from a client's side/your test phone number once the PIN has been entered to authorize the transaction. 
    For developer/test accounts, this money will be reversed automatically by midnight.
  */
  
  $PartyA = $_POST['phone']; // This is your phone number
  $AccountReference = 'Mowasco water providers';
  $TransactionDesc = 'Test Payment';
  $Amount = $_POST['amount'];
 
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

  # M-PESA endpoint urls
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
  $CallBackURL = 'https://930d-197-136-183-22.ngrok-free.app//daraja-tutorial/callback_url2.php';  

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;  
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  curl_close($curl);

  // Print the response
  echo $curl_response;

  // Decode the response to JSON format
  $response = json_decode($curl_response);

  // Check if the response indicates success (you might need to adjust this based on the actual response structure)
  if ($response && isset($response->ResponseCode) && $response->ResponseCode == "0") {
    echo "<script>window.location.href = 'success_page.php';</script>"; // Redirect to success page
  } else {
    echo "<script>window.location.href = 'error_page.php';</script>"; // Redirect to error page
  }
};
?>
