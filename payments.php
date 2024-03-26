<!-- <?php
require_once('vendor/autoload.php'); // Include Stripe library

// Set your Stripe API key
\Stripe\Stripe::setApiKey("your_stripe_secret_key");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve payment details from the form
    $amount = $_POST['amount'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvc = $_POST['cvc'];

    // Create a customer (replace this with your actual user authentication logic)
    $customer = \Stripe\Customer::create([
        'email' => 'user@example.com',
        'source' => $cardNumber,
    ]);

    // Charge the customer
    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100, // Amount in cents
        'currency' => 'usd',
        'customer' => $customer->id,
        'description' => 'Water bill payment',
    ]);

    // Handle the payment success (you may want to update the database here)
    if ($charge->status == 'succeeded') {
        echo "Payment successful. Thank you!";
    } else {
        echo "Payment failed. Please try again.";
    }
}
?> -->
