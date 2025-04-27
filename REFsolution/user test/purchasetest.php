<?php
require_once '../src/Models/Purchase.php';
?>
<body>
<h2>Purchase Class Test</h2>

<?php
    //creating purchase
    $purchase = new Purchase();
    $purchase->setPurchaseID(1001);
    $purchase->setPurchaseTotal(199.98);
    $purchase->setPurchaseDate("2023-05-15");
    $purchase->setPurchaseQuantity(2);
    $purchase->setAccountID(50);

    //printing
    echo "<h3>Purchase</h3>";    
    echo "<p>Items: ".$purchase->getPurchaseQuantity()."</p>";
    echo "<p>Date: ".$purchase->getPurchaseDate()."</p>";
    echo "<p>Total: €".$purchase->getPurchaseTotal()."</p>";

    //editing purchase
    $purchase->setPurchaseTotal(249.97);
    $purchase->setPurchaseQuantity(3);
    $purchase->setPurchaseDate("2023-05-16");
    
    //printing
    echo "<h3>Updated Purchase</h3>";
    echo "<p>Items: ".$purchase->getPurchaseQuantity()."</p>";
    echo "<p>Date: ".$purchase->getPurchaseDate()."</p>";
    echo "<p>Total: €".$purchase->getPurchaseTotal()."</p>";
?>
</body>