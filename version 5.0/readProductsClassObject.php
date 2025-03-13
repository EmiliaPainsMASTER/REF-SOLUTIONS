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
        echo "<br>-------Product ID:    " . $this->getProductID() . "---------------------------";
        echo "<br>-------Product Price: " . $this->getproductPrice() . "--------------------";
        echo "<br>-------Product Image: " . $this->getproductImage() . "--------------------";
        echo "<br>-------Product Name:  " . $this->getproductName() . "---------------------";
        echo "<br>---Product Description:  " . $this->getproductDesc() . "------------------";
        echo "<br>--------------------------------------------------------------------------";
    }
}
