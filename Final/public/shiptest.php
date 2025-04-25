<?php
require_once '../src/Models/Shipping.php';
?>
<body>
<h2>Shipping Information Test</h2>

<?php
// 1. Create shipping info
$shipping = new Shipping();
$shipping->setOrderId("ORD-500");
$shipping->setAddress("123 Main St");
$shipping->setStatus("Processing");

// Show initial values
echo "<div class='shipping'>";
echo "<h3>Original Shipping</h3>";
echo "<p>Order: ".$shipping->getOrderId()."</p>";
echo "<p>Address: ".$shipping->getAddress()."</p>";
echo "<p>Status: ".$shipping->getStatus()."</p>";
echo "</div>";

// 2. Update shipping
$shipping->setAddress("123 Main St, Apt 4B"); // Added apartment
$shipping->setStatus("Shipped"); // Updated status
$shipping->setTracking("UPS-".rand(1000000,9999999)); // Added tracking

// Show updated values
echo "<div class='updated-shipping'>";
echo "<h3>Updated Shipping</h3>";
echo "<p>Order: ".$shipping->getOrderId()."</p>";
echo "<p>New Address: ".$shipping->getAddress()."</p>";
echo "<p>Status: ".$shipping->getStatus()."</p>";
echo "<p>Tracking: ".$shipping->getTracking()."</p>";
echo "</div>";
?>
</body>