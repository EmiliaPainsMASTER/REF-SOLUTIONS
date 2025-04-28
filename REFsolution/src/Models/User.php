<?php

class User
{
    //var declare start
    public $userID;
    public $FName;
    public $SName;
    public $Email;
    public $Password;
    public $Age;
    //var declare end

    //getter/setter start

    public function getUserID()
    {
        return $this->userID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getFName()
    {
        return $this->FName;
    }

    public function setFName($FName)
    {
        $this->FName = $FName;
    }

    public function getSName()
    {
        return $this->SName;
    }

    public function setSName($SName)
    {
        $this->SName = $SName;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    
    

    public function getAge()
    {
        return $this->Age;
    }

    
    //getter/setter end

    //functions start
    /**
     * @param $row
     * @return User
     */
    public static function getUserClassObject($row)
    {
        $user = new User();
        $user->setUserID($row['userID']);
        $user->setEmail($row['Email']);
        $user->setFName($row['FName']);
        $user->setSName($row['SName']);
        $user->setPassword($row['Password']);
        $user->setAge($row['Age']);
        return $user;
    }
    
    public function setAge($birthDate) {
        $minAge = 15;
        $birthday = new DateTime($birthDate);
        $today = new DateTime();

        if ($birthday > $today) {
            throw new InvalidArgumentException("Birth date cannot be in the future");
        }

        $age = $today->diff($birthday)->y;
        if ($age < $minAge) {
            throw new InvalidArgumentException("You must be at least $minAge years old");
        }
        $this->Age = $birthDate;
        }
    
    public function setPassword($password) {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException("Password must be at least 8 characters");
        }

        $this->Password = $password;
        
        unset($password);
    }
    
    
    public static function loadFromDB($id, $dbConnection){
        $sql = "SELECT * FROM user WHERE userID = :userID";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':userID',$id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return self::getUserClassObject($row);
        }
        else{
            return null;
        }
    }
    public function insertDB($dbConnection)
    {
        $sql = "INSERT INTO user (FName, SName, Email, Password, Age) VALUES (:fname, :lname, :email, :password, :age)";
        $stmt = $dbConnection->prepare($sql);

        $fname = $this->getFName();
        $lname = $this->getSName();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $age = $this->getAge();

        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':age', $age);

        $stmt->execute();
        $this->setUserID($dbConnection->lastInsertId());
        return $this->getUserID();
    }
    public static function loadAllFromDB($dbConnection){
        $sql = "SELECT * FROM user";
        $stmt = $dbConnection->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = array();
        foreach ($rows as $row) {
            $user = self::getUserClassObject($row);
            $users[] = $user;
        }
        return $users;
    }
    public function updateDB($dbConnection) {
        $sql = "UPDATE user SET FName = :fname, SName = :lname, Email = :email, Password = :password, Age = :age WHERE userID = :userID";
        $stmt = $dbConnection->prepare($sql);

        $id = $this->getUserID();
        $fname = $this->getFName();
        $lname = $this->getSName();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $age = $this->getAge();

        $stmt->bindParam(':userID', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':age', $age);

        return $stmt->execute();
    }

    public static function authentication($email, $password, $dbConnection)
    {
        $sql = "SELECT * FROM user WHERE Email = :email";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if ($row['Password'] === $password) {
                return self::getUserClassObject($row);
            }
        }

        return null;
    }
    public function deleteDB($dbConnection){
        $sql = "DELETE FROM user WHERE userID = :id";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':userID', $this->getUserID());
        return $stmt->execute();
    }
    
    public function getPurchaseHistory($dbConnection) {
    $userEmail = $this->getEmail();
    
    try {
        //order detail
        $sql = "SELECT o.OrderID, o.CustomerName, o.Address, o.Email,
                       oi.ProductID, oi.Quantity, oi.Price,
                       p.ProductName
                FROM orders o
                JOIN order_items oi ON o.OrderID = oi.OrderID
                JOIN products p ON oi.ProductID = p.ProductID
                WHERE o.Email = :email
                ORDER BY o.OrderID DESC";
        
        $stmt = $dbConnection->prepare($sql);
        $stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);
        $stmt->execute();
        
        //items by order id
        $orders = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderID = $row['OrderID'];
            if (!isset($orders[$orderID])) {
                $orders[$orderID] = [
                    'OrderID' => $orderID,
                    'CustomerName' => $row['CustomerName'],
                    'Address' => $row['Address'],
                    'Email' => $row['Email'],
                    'Items' => []
                ];
            }
            $orders[$orderID]['Items'][] = [
                'ProductID' => $row['ProductID'],
                'ProductName' => $row['ProductName'],
                'Quantity' => $row['Quantity'],
                'Price' => $row['Price']
            ];
        }
        
        return array_values($orders);
    } catch (PDOException $e) {
        error_log("Error fetching purchase history: " . $e->getMessage());
        return [];
    }
}   

    public function displayUsers(){
        echo "<br>--------------------------------------------------------------------------";
        echo "<br>User Details";
        echo "<br>User ID:    " . $this->getUserID();
        echo "<br>User First Name:  " . $this->getFName();
        echo "<br>User Last Name:  " . $this->getSName();
        echo "<br>User Email:  " . $this->getEmail();
        echo "<br>User Password:  " . $this->getPassword();
        echo "<br>User Age:  " . $this->getAge();
    }
    //functions end
}
