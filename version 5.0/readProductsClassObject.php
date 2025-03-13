<?php

class readProductsClassObject
{
    public $productID;
    public $productPrice;
    public $productImage;
    public $productName;
    public $productDesc;
    public function getProductID(){
        return $this->productID;
    }
    public function setProductID($productID){
        $this->productID = $productID;
    }
    public function getProductPrice(){
        return $this->productPrice;
    }
    public function setProductPrice($productPrice){
        $this->productPrice = $productPrice;
    }
    public function getProductImage(){
        return $this->productImage;
    }
    public function setProductImage($productImage){
        $this->productImage = $productImage;
    }
    public function getProductName(){
        return $this->productName;
    }
    public function setProductName($productName){
        $this->productName = $productName;
    }
    public function getProductDesc(){
        return $this->productDesc;
    }
    public function setProductDesc($productDesc){
        $this->productDesc = $productDesc;
    }

    public function displayProducts(){
        echo "<br>--------------------------------------------------------------------------";
        echo "<br>-----------Product Details------------------------------------------------";
        echo "<br>-------Product Name:  " . $this->getproductName() . "---------------------";
        echo "<br>-------Product Price: " . $this->getproductPrice() . "--------------------";
        echo "<br>-------Product Image: " . $this->getproductImage() . "--------------------";
        echo "<br>---Product Description:  " . $this->getproductDesc() . "------------------";
        echo "<br>--------------------------------------------------------------------------";
    }
}
$productA  = new readProductsClassObject();
$productB  = new readProductsClassObject();
$productC  = new readProductsClassObject();
$productD  = new readProductsClassObject();
$productE  = new readProductsClassObject();

$productA->setProductID('1');
$productB->setProductID('2');
$productC->setProductID('3');
$productD->setProductID('4');
$productE->setProductID('5');

$productA->setProductPrice('500');
$productB->setProductPrice('1000');
$productC->setProductPrice('1500');
$productD->setProductPrice('2000');
$productE->setProductPrice('2500');

$productA->setProductImage('');
$productA->setProductName('Computer A');
$productA->setProductDesc('This is a Computer A');

$productA -> displayProducts();
