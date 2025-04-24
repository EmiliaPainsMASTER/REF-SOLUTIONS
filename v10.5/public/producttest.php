<?php
require_once '../src/Models/Product.php';
?>
<body>
<h2>Product Creation & Modification Test</h2>

<?php
//new product
$product = new Product();
$product->setProductID(101);
$product->setProductName("Lenovo ThinkPad");
$product->setProductPrice(1299.99);
$product->setProductImage("/img/lenovo.jpg");
$product->setProductDesc("Business laptop with 16GB RAM");

// Display
echo "<div class='initial-values'>";
echo "<h3>Original Product</h3>";
echo "<p><strong>ID:</strong> ".$product->getProductID()."</p>";
echo "<p><strong>Name:</strong> ".$product->getProductName()."</p>";
echo "<p><strong>Price:</strong> $".number_format($product->getProductPrice(),2)."</p>";
echo "</div>";

//editing
$product->setProductName("Lenovo ThinkPad X1 Carbon");
$product->setProductPrice(1499.99);
$product->setProductDesc("Upgraded model with 32GB RAM");

// Display
echo "<div class='modified-values'>";
echo "<h3>Updated Product</h3>";
echo "<p><strong>New Name:</strong> ".$product->getProductName()."</p>";
echo "<p><strong>New Price:</strong> $".number_format($product->getProductPrice(),2)."</p>";
echo "<p><strong>Description:</strong> ".$product->getProductDesc()."</p>";
echo "</div>";
?>
</body>