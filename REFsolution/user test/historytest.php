<?php
require_once '../src/Models/Purchase.php';
require_once '../src/Models/Product.php';
?>
<body>
<h2>Purchase History</h2>

<?php
    //adding product1
    $product1 = new Product();
    $product1->setProductID(201);
    $product1->setProductName("Apple MacBook Air");
    $product1->setProductPrice(1199.99);


    //adding product2
    $product2 = new Product();
    $product2->setProductID(202);
    $product2->setProductName("Pendrive");
    $product2->setProductPrice(15);

    //making purchase1
    $purchase1 = new Purchase();
    $purchase1->setPurchaseID(4001);
    $purchase1->setPurchaseTotal($product1->getProductPrice());//getting price from product
    $purchase1->setPurchaseQuantity(1);
    $purchase1->setPurchaseDate("2024-03-10");
    $purchase1->setAccountID(100);

    //making purchase2
    $purchase2 = new Purchase();
    $purchase2->setPurchaseID(4002);
    $purchase2->setPurchaseTotal($product2->getProductPrice() * 2);//buying 2 products
    $purchase2->setPurchaseQuantity(2);
    $purchase2->setPurchaseDate("2024-03-15");
    $purchase2->setAccountID(100);

    //printing 
    echo "<div class='purchase-history'>";
    echo "<h3>Order 1</h3>";
    echo "<p>Product: ".$product1->getProductName()."</p>";//getting name
    echo "<p>Total: €".$purchase1->getPurchaseTotal()."</p>";
    echo "<p>Date: ".$purchase1->getPurchaseDate()."</p>";

    echo "<h3>Order 2</h3>";
    echo "<p>Product: ".$product2->getProductName()." (x2)</p>";
    echo "<p>Total: €".$purchase2->getPurchaseTotal()."</p>";
    echo "<p>Date: ".$purchase2->getPurchaseDate()."</p>";
    echo "</div>";
?>
</body>

