<?php

class SeasonalSale
{
    /*TODO Hello future me, should SeasonalSaleEasterProducts be an enumeration? so instead of two
        variables for the seasonalSale types we use a enumeration named seasonalSaleType or something
        until i figure that out I won't be continuing with the seasonalSaleClassObj because that could
        bad?

    */

    //var declare start
    public $seasonalSaleID;
    public $seasonalSaleEasterProducts;
    public $seasonalSaleStPatricksDayProducts;
    //var declare end
    //getter/setter start
    /**
     * @param $row
     * @return SeasonalSale
     */
    public static function getSeasonalSale($row)
    {
        $seasonalSale = new SeasonalSale();
        $seasonalSale->setSeasonalSaleID($row['seasonalSaleID']);
        $seasonalSale->setSeasonalSaleEasterProducts($row['seasonalSaleEasterProducts']);
        $seasonalSale->setSeasonalSaleStPatricksDayProducts($row['seasonalSaleStPatricksDayProducts']);
        return $seasonalSale;
    }

    public function getSeasonalSaleID()
    {
        return $this->seasonalSaleID;
    }

    public function setSeasonalSaleID($seasonalSaleID)
    {
        $this->seasonalSaleID = $seasonalSaleID;
    }

    public function getSeasonalSaleEasterProducts()
    {
        return $this->seasonalSaleEasterProducts;
    }

    public function setSeasonalSaleEasterProducts($seasonalSaleEasterProducts)
    {
        $this->seasonalSaleEasterProducts = $seasonalSaleEasterProducts;
    }

    public function getSeasonalSaleStPatricksDayProducts()
    {
        return $this->seasonalSaleStPatricksDayProducts;
    }

    public function setSeasonalSaleStPatricksDayProducts($seasonalSaleStPatricksDayProducts)
    {
        $this->seasonalSaleStPatricksDayProducts = $seasonalSaleStPatricksDayProducts;
    }
    //getter/setter end

    //function start
    public static function loadFromDB($id, $dbConnection){
        $sql = "SELECT * FROM seasonal_sale WHERE seasonalSaleID = :seasonalSaleID";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':seasonalSaleID',$id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::getSeasonalSale($row);
        }
        else{
            return null;
        }
    }
    public function insertDB($dbConnection){
        $sql = "INSERT INTO seasonal_sale (seasonalSaleEasterProducts, seasonalSaleStPatricksDayProducts) VALUES (:seasonalSaleEasterProducts, :seasonalSaleStPatricksDayProducts)";
        $stmt = $dbConnection->prepare($sql);
        $EasterProducts = $this->getSeasonalSaleEasterProducts();
        $StPatricksDayProducts = $this->getSeasonalSaleStPatricksDayProducts();
        $stmt->bindParam(':seasonalSaleEasterProducts', $EasterProducts);
        $stmt->bindParam(':seasonalSaleStPatricksDayProducts', $StPatricksDayProducts);
        $stmt->execute();
        $this->setSeasonalSaleID($dbConnection->lastInsertId());
        return $this->getSeasonalSaleID();
    }
    public static function loadAllFromDB($dbConnection){
        $sql = "SELECT * FROM seasonal_sale";
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $seasonalSales = array();
        foreach ($rows as $row) {
            $seasonalSale = self::getSeasonalSale($row);
            $seasonalSales[] = $seasonalSale;
        }
        return $seasonalSales;
    }
    public function updateDB($dbConnection) {
        $sql = "UPDATE seasonal_sale SET seasonalSaleEasterProducts = :easterProducts, seasonalSaleStPatricksDayProducts = :stPatricksProducts WHERE seasonalSaleID = :id";
        $stmt = $dbConnection->prepare($sql);
        $id = $this->getSeasonalSaleID();
        $seasonalSaleEasterProducts = $this->getSeasonalSaleEasterProducts();
        $seasonalSaleStPatricksDayProducts = $this->getSeasonalSaleStPatricksDayProducts();
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':seasonalSaleEasterProducts', $seasonalSaleEasterProducts);
        $stmt->bindParam(':seasonalSaleStPatricksDayProducts', $seasonalSaleStPatricksDayProducts);
        return $stmt->execute();
    }

    public function deleteDB($dbConnection){
        $sql = "DELETE FROM seasonal_sale WHERE seasonalSaleID = :id";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':id', $this->getSeasonalSaleID());
        return $stmt->execute();
    }
    public function displaySeasonalSales(){
        echo "<br>--------------------------------------------------------------------------";
        echo "<br>Seasonal Sale Details";
        echo "<br>Seasonal Sale ID:    " . $this->getSeasonalSaleID();
        echo "<br>Seasonal Sale Easter Products: " . $this->getSeasonalSaleEasterProducts();
        echo "<br>Seasonal Sale St Patricks Day Products: " . $this->getSeasonalSaleStPatricksDayProducts();
    }
    //function end

}
