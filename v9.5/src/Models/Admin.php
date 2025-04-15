<?php

class Admin
{
    //var declare start
    public $adminID;
    public $adminName;
    public $adminEmail;
    public $adminPassword;
    //var declare end

    //getter/setter start
    /**
     * @param $row
     * @return Admin
     */
    public static function getAdminClassObject($row) {
        $admin = new Admin();
        $admin->setAdminID($row['adminID']);
        $admin->setAdminName($row['name']);
        $admin->setAdminEmail($row['email']);
        $admin->setAdminPassword($row['password']);
        return $admin;
    }
    public function getAdminID()
    {
        return $this->adminID;
    }

    public function setAdminID($adminID)
    {
        $this->adminID = $adminID;
    }

    public function getAdminName()
    {
        return $this->adminName;
    }

    public function setAdminName($adminName)
    {
        $this->adminName = $adminName;
    }

    public function getAdminEmail()
    {
        return $this->adminEmail;
    }

    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function getAdminPassword()
    {
        return $this->adminPassword;
    }

    public function setAdminPassword($adminPassword)
    {
        $this->adminPassword = $adminPassword;
    }
    //getter/setter end

    //function start
    public static function loadFromDB($id, $dbConnection){
        $sql = "SELECT * FROM admin WHERE adminID = :AdminID";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam('AdminID',$id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::getAdminClassObject($row);
        }
        else{
            return null;
        }
    }
    public function insertDB($dbConnection){
        $sql = "INSERT INTO admin (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $dbConnection->prepare($sql);
        $adminName = $this->getAdminName();
        $adminEmail = $this->getAdminEmail();
        $adminPassword = $this->getAdminPassword();

        $stmt->bindParam(':name', $adminName);
        $stmt->bindParam(':email', $adminEmail);
        $stmt->bindParam(':password', $adminPassword);

        $stmt->execute();
        $this->setAdminID($dbConnection->lastInsertId());
        return $this->getAdminID();
    }
    public static function loadAllFromDB($dbConnection){
        $sql = "SELECT * FROM admin";
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $admins = array();
        foreach ($rows as $row) {
            $admin = self::getAdminClassObject($row);
            $admins[] = $admin;
        }
        return $admins;
    }
    public function updateDB($dbConnection) {
        $sql = "UPDATE admin SET name = :name, email = :email, password = :password WHERE adminID = :id";
        $stmt = $dbConnection->prepare($sql);

        $id = $this->getAdminID();
        $name = $this->getAdminName();
        $email = $this->getAdminEmail();
        $password = $this->getAdminPassword();
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function deleteDB($dbConnection){
        $sql = "DELETE FROM admin WHERE adminID = :id";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':id', $this->getAdminID());
        return $stmt->execute();
    }
    public function displayAdmin(){
        echo "<br>--------------------------------------------------------------------------";
        echo "<br>Admin Details";
        echo "<br>Admin ID:    " . $this->getAdminID();
        echo "<br>Admin Name:  " . $this->getAdminName();
        echo "<br>Admin Email:  " . $this->getAdminEmail();
        echo "<br>Admin Password:  " . $this->getAdminPassword();
    }
    //function end

}
