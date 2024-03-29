<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="invoice.css">
  <title>Water Billing System</title>
</head>
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
                    <li><a href="payment.php">Make payment</a></li>
                </ul>
            </nav>
        </div>
    </header>
<body>

  <div class="change">
  <h1>Water Billing System</h1>

  <label for="quantity">Quantity of water used (liters):</label>
  <input type="number" id="quantity" value='<?php echo isset($_SESSION["readings_value"]) ? $_SESSION["readings_value"] : "" ?>' disabled required>


  <button onclick="generateInvoice()">Generate Invoice</button>

  <table id="invoiceTable" style="display:none;">
    <thead>
      <tr>
        <th>Quantity (liters)</th>
        <th>Price per Liter (KSH)</th>
        <th>Total (KSH)</th>
      </tr>
    </thead>
    <tbody id="invoiceBody"></tbody>
  </table>

  <script>
    function generateInvoice() {
      var quantity = document.getElementById('quantity').value;

      if (isNaN(quantity) || quantity <= 0) {
        alert('Please enter a valid quantity.');
        return;
      }

      // Price per liter
      var pricePerLiter = 10;

      // Generate the water bill
      var table = document.getElementById('invoiceTable');
      var body = document.getElementById('invoiceBody');

      // Clear previous rows
      while (body.firstChild) {
        body.removeChild(body.firstChild);
      }

      var row = body.insertRow();
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);

      cell1.innerHTML = 'Water Usage';
      cell2.innerHTML = quantity;
      cell3.innerHTML = pricePerLiter;
      cell4.innerHTML = (quantity * pricePerLiter);

      // Calculate total
      var totalRow = body.insertRow();
      totalRow.insertCell(0).innerHTML = '<strong>Total</strong>';
      totalRow.insertCell(1).innerHTML = '';
      totalRow.insertCell(2).innerHTML = '';
      totalRow.insertCell(3).innerHTML = 'KSH ' + (quantity * pricePerLiter).toFixed(2);

      document.getElementById('invoiceTable').style.display = 'table';
    }
  </script>
  </div>
</body>
</html>
