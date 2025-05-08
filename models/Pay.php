<?php

namespace models;

use Core\App;

class Pay {

    private static $conn;

    public function __construct(private $userId, private $typeId)
    {
        $this->userId = $userId;
        $this->typeId = $typeId;
    }

    public function __set($prop, $value) {
        if(property_exists($this, $prop)) {
            $this->$prop = $value; 
        }
    }

    public function __get($prop) {
        if(property_exists($this, $prop)) {
            return $this->$prop; 
        }
        return null;
    }

    private static function getConnection()
    {
        if(! self::$conn) {
            self::$conn = App::dataBase();
        }
        return self::$conn;
    }

    // check if the user have a membership
    public function savePay() {
        $sql = "INSERT INTO pay (userId, typeId) VALUES (?,?)";
        return self::getConnection()->query($sql, [$this->userId, $this->typeId]);
    }

    public static function getMembers()
    {
        $sql = 'SELECT u.name AS user_name, mt.name AS membership_type
        FROM user u
        JOIN membership m ON u.userId = m.userId
        JOIN membershipType mt ON m.typeId = mt.typeId';

        return $members = self::getConnection()->query($sql)->fetchAll();
    }
}

