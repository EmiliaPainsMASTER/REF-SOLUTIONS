<?php

class ProductsClassObject
{
    public $productID;
    public $productPrice;
    public $productImage;
    public $productName;
    public $productDesc;

    /**
     * @param $row
     * @return ProductsClassObject
     */
    public static function getProductsClassObject($row)
    {
        $product = new ProductsClassObject();
        $product->setProductID($row['ProductID']);
        $product->setProductPrice($row['Price']);
        $product->setProductImage($row['Image']);
        $product->setProductName($row['ProductName']);
        $product->setProductDesc($row['ProductDesc']);
        return $product;
    }

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
    public static function loadFromDB($id, $dbConnection){
        $sql = "SELECT * FROM products WHERE ProductID = :ProductID";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':ProductID', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::getProductsClassObject($row);
        }
        else{
            return null;
        }
    }
    public function insertDB($dbConnection){
        $sql = "INSERT INTO products (Price, Image, ProductName, ProductDesc) VALUES (:price, :image, :name, :desc)";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':price', $this->getProductPrice());
        $stmt->bindParam(':image', $this->getProductImage());
        $stmt->bindParam(':name', $this->getProductName());
        $stmt->bindParam(':desc', $this->getProductDesc());
        $stmt->execute();
        $this->setProductID($dbConnection->lastInsertId());
        return $this->getProductID();
    }
    public static function loadAllFromDB($dbConnection){
        $sql = "SELECT * FROM products";
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $products = array();
        foreach ($rows as $row) {
            $product = self::getProductsClassObject($row);
            $products[] = $product;
            return $products;
        }
        return null;
    }
    public function updateDB($dbConnection) {
        $sql = "UPDATE products SET Price = :price, Image = :image, ProductName = :name, ProductDesc = :desc WHERE ProductID = :id";
        $stmt = $dbConnection->prepare($sql);

        //Store getter results into variables
        $id = $this->getProductID();
        $name = $this->getProductName();
        $price = $this->getProductPrice();
        $desc = $this->getProductDesc();
        $image = $this->getProductImage();

        //Bind variables to the attributes
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':image', $image);

        // Execute the statement
        return $stmt->execute();
    }

    public function deleteDB($dbConnection){
        $sql = "DELETE FROM products WHERE ProductID = :id";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':id', $this->getProductID());
        $stmt->execute();
    }
    public function displayProducts(){
        echo "<br>--------------------------------------------------------------------------";
        echo "<br>Product Details";
        echo "<br>Product ID:    " . $this->getProductID();
        echo "<br>Product Price: " . $this->getproductPrice();
        echo "<br><br><img src=\"" . $this->getProductImage() . "\" alt=\"Product Image\">";
        echo "<br><br>Product Name:  " . $this->getproductName();
        echo "<br>Product Description:  " . $this->getproductDesc();
    }

}
