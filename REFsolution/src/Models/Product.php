<?php
class Product
{
    public $productID;
    public $productPrice;
    public $productImage;
    public $productName;
    public $productDesc;

    public static function getProductsClassObject($row)
    {
        $product = new Product();
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
    
    public function getProductImage(){
        return $this->productImage;
    }
    public function setProductImage($productImage){
        $this->productImage = $productImage;
    }
    public function getProductName(){
        return $this->productName;
    }
    
    public function getProductDesc(){
        return $this->productDesc;
    }
    public function setProductDesc($productDesc){
        $this->productDesc = $productDesc;
    }
    
    public function setProductPrice($price) {
        if (!is_numeric($price)) {
            throw new InvalidArgumentException("Price must be a number");
        }
        if ($price <= 0) {
            throw new InvalidArgumentException("Price must be greater than zero");
        }
        if ($price > 10000) {
            throw new InvalidArgumentException("Price cannot exceed €10,000");
        }
        $this->productPrice = round($price, 2); //2 decimal places
        }
    
    public function setProductName($name) {
    $name = trim($name);
    
    //check if empty
    if (empty($name)) {
        throw new InvalidArgumentException("Please enter a product name");
    }
    
    //minimum length
    if (strlen($name) < 2) {
        throw new InvalidArgumentException("Name too short (min 2 chars)");
    }
    
    $this->productName = $name;
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
        }
        return $products;
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
    public function displayProducts() {
        echo "<div class='productdisplay'>";
        echo "<img src=\"../public/assets" . $this->getProductImage() . "\" alt=\"Product Image\">";
        echo "<h3>" . $this->getProductName() . "</h3>";
        echo "<p>" . $this->getProductDesc() . "</p>";
        echo "<p><strong>Price:</strong> €" . $this->getProductPrice() . "</p>";
        echo "<form method='post' action='../public/cart.php'>";
        echo "<input type='hidden' name='product_id' value='" . $this->getProductID() . "'>";
        echo "<input type='hidden' name='action' value='add'>";
        echo "<button type='submit'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";
    }

}
