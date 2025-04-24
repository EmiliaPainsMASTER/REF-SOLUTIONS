<?php
require_once '../src/Models/Product.php';
?>
<body>
<h2>Order Processing Test</h2>

<?php
// Mock order data
$order = [
    'order_id' => 'ORD-1001',
    'customer' => 'Sam Wilson',
    'products' => [
        ['id' => 101, 'name' => 'Laptop', 'qty' => 1, 'price' => 999.99],
        ['id' => 205, 'name' => 'Mouse', 'qty' => 2, 'price' => 19.99]
    ],
    'total' => 1039.97
];

echo "<div class='original-order'>";
echo "<h3>Original Order</h3>";
echo "<p>Customer: ".$order['customer']."</p>";
foreach ($order['products'] as $item) {
    echo "<li>".$item['name']." (Qty: ".$item['qty'].")</li>";
}
echo "<p>Total: $".number_format($order['total'],2)."</p>";
echo "</div>";

// Update order
$order['order_id'] = 'ORD-1001-R1'; // Revised order
$order['products'][1]['qty'] = 3; // Added another mouse
$order['total'] = 1059.96; // New total

echo "<div class='updated-order'>";
echo "<h3>Updated Order</h3>";
echo "<p>New Items:</p>";
foreach ($order['products'] as $item) {
    echo "<li>".$item['name']." (Qty: ".$item['qty'].")</li>";
}
echo "<p>New Total: $".number_format($order['total'],2)."</p>";
echo "</div>";
?>
</body>