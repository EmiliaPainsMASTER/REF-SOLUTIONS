<?php
require_once '../src/Models/Payment.php';
?>
<body>
<h2>Payment Test</h2>

<?php
// 1. Create payment
$payment = new Payment();
$payment->setId(1001);
$payment->setAmount(99.99);

// Show initial values
echo "<div class='payment'>";
echo "<h3>Created Payment</h3>";
echo "<p>ID: ".$payment->getId()."</p>";
echo "<p>Amount: $".$payment->getAmount()."</p>";
echo "</div>";

// 2. Edit payment
$payment->setAmount(89.99); // Discount applied

// Show updated values
echo "<div class='updated-payment'>";
echo "<h3>Updated Payment</h3>";
echo "<p>ID: ".$payment->getId()."</p>";
echo "<p>New Amount: $".$payment->getAmount()."</p>";
echo "</div>";
?>
</body>