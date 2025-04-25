<?php
require_once '../src/Models/Purchase.php';
require_once '../src/Models/Product.php';
?>
<body>
<h2>Purchase History Simulation</h2>

<?php
// Simulate 2 products
$product1 = new Product();
$product1->setProductID(201);
$product1->setProductName("Apple MacBook Air");
$product1->setProductPrice(1199.99);
$product1->setProductImage("/img/macbook.jpg");

$product2 = new Product();
$product2->setProductID(202);
$product2->setProductName("Wireless Mouse");
$product2->setProductPrice(49.99);
$product2->setProductImage("/img/mouse.jpg");

// Create 2 purchases
$purchase1 = new Purchase();
$purchase1->setPurchaseID(4001);
$purchase1->setPurchaseTotal($product1->getProductPrice());
$purchase1->setPurchaseQuantity(1);
$purchase1->setPurchaseDate("2024-03-10");
$purchase1->setAccountID(100);

$purchase2 = new Purchase();
$purchase2->setPurchaseID(4002);
$purchase2->setPurchaseTotal($product2->getProductPrice() * 2);
$purchase2->setPurchaseQuantity(2);
$purchase2->setPurchaseDate("2024-03-15");
$purchase2->setAccountID(100);

// Display purchase history
echo "<div class='purchase-history'>";
echo "<h3>Order 1</h3>";
echo "<p>Product: ".$product1->getProductName()."</p>";
echo "<p>Total: €".number_format($purchase1->getPurchaseTotal(), 2)."</p>";
echo "<p>Date: ".$purchase1->getPurchaseDate()."</p>";

echo "<h3>Order 2</h3>";
echo "<p>Product: ".$product2->getProductName()." (x2)</p>";
echo "<p>Total: €".number_format($purchase2->getPurchaseTotal(), 2)."</p>";
echo "<p>Date: ".$purchase2->getPurchaseDate()."</p>";
echo "</div>";
?>
</body>

