<?php 
require_once '../src/Models/Product.php';

class ProductsClassObjectTest
{
    public function testProductName()
    {
        $product = new Product();
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