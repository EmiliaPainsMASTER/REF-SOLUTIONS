<?php

class PurchaseClassObject
{
    // var declaration start
    public $purchaseID;
    public $purchaseTotal;
    public $purchaseDate;
    public $purchaseQuantity;
    //var declaration end
    //getter/setter start
    /**
     * @param $row
     * @return PurchaseClassObject
     */
    public static function getPurchaseClassObject($row)
    {
        $purchase = new PurchaseClassObject();
        $purchase->setPurchaseID($row['PurchaseID']);
        $purchase->setPurchaseTotal($row['Total']);
        $purchase->setPurchaseDate($row['Date']);
        $purchase->setPurchaseQuantity($row['Quantity']);
        return $purchase;
    }

    public function getPurchaseID()
    {
        return $this->purchaseID;
    }
    public function setPurchaseID($purchaseID)
    {
        $this->purchaseID = $purchaseID;
    }
    public function getPurchaseTotal()
    {
        return $this->purchaseTotal;
    }
    public function setPurchaseTotal($purchaseTotal)
    {
        $this->purchaseTotal = $purchaseTotal;
    }
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }
    public function getPurchaseQuantity()
    {
        return $this->purchaseQuantity;
    }
    public function setPurchaseQuantity($purchaseQuantity)
    {
        $this->purchaseQuantity = $purchaseQuantity;
    }
    //getter/setter end

    //function start
    public static function loadFromDB($id, $dbConnection){
        $sql = "SELECT * FROM purchase WHERE PurchaseID = :PurchaseID";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':PurchaseID', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::getPurchaseClassObject($row);
        }
        else{
            return null;
        }
    }
    //TODO figure out a fix for line 74?
    public function insertDB($dbConnection){
        $sql = "INSERT INTO purchase (Total, Date, Quantity) VALUES (:total, :date, :quantity)";
        $stmt = $dbConnection->prepare($sql);
        $total = $this->getPurchaseTotal();
        $date = $this->getPurchaseDate();
        $quantity = $this->getPurchaseQuantity();

        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':quantity', $quantity);

        $stmt->execute();
        $this->setPurchaseID($dbConnection->lastInsertId());
        return $this->getPurchaseID();
    }
    public static function loadAllFromDB($dbConnection){
        $sql = "SELECT * FROM purchase";
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $purchases = array();
        foreach ($rows as $row) {
            $purchase = self::getPurchaseClassObject($row);
            $purchases[] = $purchase;
        }
        return $purchases;
    }
    public function updateDB($dbConnection) {
        $sql = "UPDATE purchase SET Total = :total, Date = :date, Quantity = :quantity WHERE PurchaseID = :id";
        $stmt = $dbConnection->prepare($sql);
        //Store getter values into variables
        $id = $this->getPurchaseID();
        $total = $this->getPurchaseTotal();
        $date = $this->getPurchaseDate();
        $quantity = $this->getPurchaseQuantity();
        //Bind variables to the attributes
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':quantity', $quantity);
        //EXECUTE!
        return $stmt->execute();
    }

    public function deleteDB($dbConnection){
        $sql = "DELETE FROM purchase WHERE PurchaseID = :id";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':id', $this->getPurchaseID());
        return $stmt->execute();
    }
    public function displayPurchases(){
        echo "<br>--------------------------------------------------------------------------";
        echo "<br>Purchase Details";
        echo "<br>Purchase ID:    " . $this->getPurchaseID();
        echo "<br>Purchase Total: " . $this->getPurchaseTotal();
        echo "<br>Purchase Date: " . $this->getPurchaseDate();
        echo "<br>Purchase Quantity: " . $this->getPurchaseQuantity();
    }
    //function end
}
