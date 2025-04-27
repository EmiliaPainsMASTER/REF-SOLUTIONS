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
    $product->setProductDesc("laptop with 16GB RAM");

    //printing
    echo "<h3>Product Info</h3>";
    echo "<p><strong>Name:</strong> ".$product->getProductName()."</p>";
    echo "<p><strong>Price:</strong> €".$product->getProductPrice()."</p>";    
    echo "<p><strong>Description:</strong> ".$product->getProductDesc()."</p>";

    //editing
    $product->setProductName("Lenovo ThinkPad X1 Carbon");
    $product->setProductPrice(1499.99);
    $product->setProductDesc("laptop with 32GB RAM");

    //printing
    echo "<br><h3>Updated Product</h3>";
    echo "<p><strong>New Name:</strong> ".$product->getProductName()."</p>";
    echo "<p><strong>New Price:</strong> €".$product->getProductPrice()."</p>";
    echo "<p><strong>Description:</strong> ".$product->getProductDesc()."</p>";
?>
</body>