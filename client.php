<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="client.css">
    <title>water billing</title>
</head>
<body>
    <header>
        <!-- logo -->
        <div class="imgDiv">
            <img src="images/logo.jpg" alt="logo not seen lol!" >
        </div>
        <!-- links -->
        <div class="navLinks">
            <nav>
                <ul>
                    <li><a href="home.html">Home</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="mainView">
        <div class="balance">
            <div class="amount">
                <h1>Water Consumed</h1>
                <i><?php echo isset($_SESSION["readings_value"]) ? $_SESSION["readings_value"] . " litres" : "0 litres"; ?></i>
            </div>
            <div class="bill">
                <h1>Your Bill</h1>
                <p>0 ksh</p>
                <i>120 per litre</i>
            </div>
        </div>
        <div class="moreInfo">
            <!-- shall have some things here -->
            <div></div>
            <div class="btns">
                <button><a href="invoice.php">Generate Invoice</a></button>
                <button><a href="payment.html">Make Payment</a></button>
                <button><a href="report.html">Generate Report</a></button>
            </div>
        </div>
    </div>
</body>
</html>
