<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="payment.css">
  <title>Payment Options</title>
  <script src="https://js.stripe.com/v3/"></script>
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
                    <li><a href="client.php">Back</a></li>
                    <li><a href="invoice.php">Invoice</a></li>
                </ul>
            </nav>
        </div>
    </header>
  <?php
  // Check if amount is greater than 0
  $amount = isset($_SESSION["amount"]) ? $_SESSION["amount"] : 0;
  if ($amount > 0) {
      // If amount is greater than 0, display the form with inputs enabled
  ?>
  <h1>Please Enter Full Amount: <strong><?php echo $amount; ?> Ksh</strong></h1>
  <form action="/daraja-tutorial/stk_initiate.php" method="POST">
    <div class="label">
    <label for="inputAddress" class="form-label">Amount</label></br>
    <input class="form-control" name="amount" placeholder="Enter amount">
   

    <label for="inputAddress2" class="form-label">Phone Number</label>a
    <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
    </div>
    <button type="submit" class="btn btn-success" name="submit" value="submit">Pay Now</button>
  </form>
  <?php
  } else {
      // If amount is 0, display the form with inputs disabled
  ?>
  <div class="change">
  <h1>Please Enter Full Amount: <strong>0 Ksh</strong></h1>
  <form action="/daraja-tutorial/stk_initiate.php" method="POST">
    <label for="inputAddress" class="form-label">Amount</label>
    <input class="form-control" name="amount" placeholder="No balance" disabled>

    <label for="inputAddress2" class="form-label">Phone Number</label>
    <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" disabled>

    <button type="submit" class="btn btn-success" name="submit" value="submit" disabled>Pay Now</button>
  </div>
  </form>
  <?php
  }
  ?>
</body>
</html>
