<?php
class Purchase
{
    private $purchaseID;
    private $purchaseTotal;
    private $purchaseDate;
    private $purchaseQuantity;
    private $accountID;
    private $products;

    public static function getPurchaseClassObject($row, $dbConnection)
    {
        $purchase = new Purchase();
        $purchase->setPurchaseID($row['PurchaseID']);
        $purchase->setPurchaseTotal($row['Total']);
        $purchase->setPurchaseDate($row['Date']);
        $purchase->setPurchaseQuantity($row['Quantity']);
        $purchase->setAccountID($row['AccountID']);

        //$dbConnection to load products
        $purchase->setProducts(self::loadProductsForPurchase($purchase->getPurchaseID(), $dbConnection));

        return $purchase;
    }


    // Getters and Setters
    public function getPurchaseID() {
        return $this->purchaseID;
    }
    
    public function setPurchaseID($purchaseID) {
        $this->purchaseID = $purchaseID;
    }
    
    public function getPurchaseTotal() {
        return $this->purchaseTotal;
    }
    
    public function setPurchaseTotal($purchaseTotal) {
        $this->purchaseTotal = $purchaseTotal;
    }
    
    public function getPurchaseDate() {
        return $this->purchaseDate;
    }
    
    public function setPurchaseDate($purchaseDate) {
        $this->purchaseDate = $purchaseDate;
    }
    
    public function getPurchaseQuantity() {
        return $this->purchaseQuantity;
    }
    
    public function setPurchaseQuantity($purchaseQuantity) {
        $this->purchaseQuantity = $purchaseQuantity;
    }
    
    public function getAccountID() {
        return $this->accountID;
    }
    
    public function setAccountID($accountID) {
        $this->accountID = $accountID;
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts($products) {
        $this->products = $products;
    }

    public function insertDB($dbConnection) {
        $sql = "INSERT INTO purchases (Date, AccountID, Total, Quantity) 
                VALUES (:date, :accountID, :total, :quantity)";

        try {
            $stmt = $dbConnection->prepare($sql);
            $stmt->bindParam(':total', $this->purchaseTotal);
            $stmt->bindParam(':date', $this->purchaseDate);
            $stmt->bindParam(':quantity', $this->purchaseQuantity);
            $stmt->bindParam(':accountID', $this->accountID);
            $stmt->execute();

            // Getting last PurchaseID
            $this->purchaseID = $dbConnection->lastInsertId();

            foreach ($this->products as $product) {
                $sql = "INSERT INTO purchase_products (PurchaseID, ProductID, Quantity, Price) 
                        VALUES (:purchaseID, :productID, :quantity, :price)";
                $stmt = $dbConnection->prepare($sql);
                $stmt->bindParam(':purchaseID', $this->purchaseID);
                $stmt->bindParam(':productID', $product['productID']);
                $stmt->bindParam(':quantity', $product['quantity']);
                $stmt->bindParam(':price', $product['price']);
                $stmt->execute();
            }

            return $this->purchaseID;

        } catch (PDOException $e) {
            throw new Exception("Insert failed: " . $e->getMessage());
        }
    }

    public static function loadFromDB($id, $dbConnection) {
        $sql = "SELECT * FROM purchases WHERE PurchaseID = :purchaseId";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':purchaseId', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::getPurchaseClassObject($row) : null;
    }

    public static function loadAllFromDBForUser($dbConnection, $userId) {
        $sql = "SELECT * FROM purchases WHERE AccountID = :userId ORDER BY Date DESC";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $purchases = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //connection to getPurchaseClassObject
            $purchases[] = self::getPurchaseClassObject($row, $dbConnection);
        }
        return $purchases;
    }

    public static function loadProductsForPurchase($purchaseID, $dbConnection) {
        $sql = "SELECT * FROM purchase_products WHERE PurchaseID = :purchaseID";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':purchaseID', $purchaseID);
        $stmt->execute();

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }
        return $products;
    }


    public function displayPurchases() {
        echo "<div class='purchase'>";
        echo "<h3>Purchase #" . $this->getPurchaseID() . "</h3>";
        echo "<p>Date: " . $this->getPurchaseDate() . "</p>";
        echo "<p>Total: $" . number_format($this->getPurchaseTotal(), 2) . "</p>";
        echo "<p>Items: " . $this->getPurchaseQuantity() . "</p>";

        echo "<ul>";
        foreach ($this->getProducts() as $product) {
            echo "<li>Product ID: " . $product['ProductID'] . " | Quantity: " . $product['Quantity'] . " | Price: $" . $product['Price'] . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}
