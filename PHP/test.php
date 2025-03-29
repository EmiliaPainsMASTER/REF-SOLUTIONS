<?php
require_once 'DBtoObjects/ProductsClassObject.php';

class ProductsClassObjectTest
{
    public function testProductName()
    {
        $product = new ProductsClassObject();
        $product->setProductName('Test Product');
        
        if ($product->getProductName() === 'Test Product') {
            echo "Test Passed";
        } else {
            echo "Test Failed";
        }
    }
}

$test = new ProductsClassObjectTest();
$test->testProductName();