<?php
require_once '../src/Models/Purchase.php';
?>
<body>
<h2>Purchase Class Test</h2>

<?php
// Create test purchase
$purchase = new Purchase();
$purchase->setPurchaseID(1001);
$purchase->setPurchaseTotal(199.98);
$purchase->setPurchaseDate("2023-05-15");
$purchase->setPurchaseQuantity(2);
$purchase->setAccountID(50);

echo "<div class='purchase-test'>";
echo "<h3>New Purchase</h3>";
echo "<p>Date: ".$purchase->getPurchaseDate()."</p>";
echo "<p>Total: €".number_format($purchase->getPurchaseTotal(), 2)."</p>";
echo "</div>";

// Update purchase information
$purchase->setPurchaseTotal(249.97); // After adding another item
$purchase->setPurchaseQuantity(3);
$purchase->setPurchaseDate("2023-05-16"); // Updated date

echo "<div class='updated-purchase'>";
echo "<h3>Updated Purchase</h3>";
echo "<p>New Total: €".number_format($purchase->getPurchaseTotal(), 2)."</p>";
echo "<p>Items: ".$purchase->getPurchaseQuantity()."</p>";
echo "<p>Updated Date: ".$purchase->getPurchaseDate()."</p>";
echo "</div>";
?>
</body>