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


    public static function getPays()
    {
        $sql = 'SELECT p.payId, p.userId, p.typeId, p.payDate, p.value, u.name AS userName, m.name AS memName 
                FROM pay p 
                JOIN user u ON p.userId = u.userId 
                JOIN membershipType m ON p.typeId = m.typeId';
        
        return self::getConnection()->query($sql)->fetchAll();
    }

    public static function getPaysByUserId($userId)
    {
        $sql = 'SELECT p.payId AS pay_id, mt.name AS mem_name, p.value, p.payDate AS pay_date  
        FROM pay p
        JOIN membershipType mt ON p.typeId = mt.typeId 
        WHERE p.userId = ? ORDER BY pay_Date DESC'; 
        return self::getConnection()->query($sql, [$userId])->fetchAll();
    }

    public static function getMonths($pays) {
    $months = [];
    foreach($pays as $pay) {
        $date = strtotime($pay['payDate']);
        $month = date('F y', $date);

        if (!in_array($month, $months)) {
            $months[] = $month;
        }
    }
    return $months;
    }

    public static function getPaysByMonth($month) {
        $sql = "SELECT * FROM pay WHERE DATE_FORMAT(payDate, '%M %y') = ?";
        return self::getConnection()->query($sql, [$month])->fetchAll();
    }

    public static function getTotal($pays) {
        $total = 0;
        foreach($pays as $pay) {
            $total += $pay['value'];
        }
        return $total;
    }
}

