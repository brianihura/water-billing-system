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
<form action="/daraja-tutorial/stk_initiate.php" method="POST">
<label for="inputAddress" class="form-label">Amount</label>
<input type="text" class="form-control" name="amount" placeholder="Enter Amount">

<label for="inputAddress2" class="form-label" >Phone Number</label>
<input type="text" class="form-control" name="phone"  placeholder="Enter Phone Number">



<button type="submit" class="btn btn-success" name="submit" value="submit">Pay Now</button>
</form>
</body>
</html>
