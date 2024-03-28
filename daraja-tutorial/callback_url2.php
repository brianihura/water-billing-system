<?php
 		header("Content-Type: application/json");

     $response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
 
     
     $mpesaResponse = file_get_contents('php://input');
 
    
     $logFile = "M_PESAConfirmationResponse.txt";
 
    
     $log = fopen($logFile, "a");
 
     fwrite($log, $mpesaResponse);
     fclose($log);
 
     echo $response;
