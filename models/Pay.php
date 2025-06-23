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
        $sql = "INSERT INTO pay (user_id, type_id) VALUES (?,?)";
        return self::getConnection()->query($sql, [$this->userId, $this->typeId]);
    }


    public static function getPays()
    {
        $sql = 'SELECT p.pay_id, p.user_id, p.type_id, p.pay_date, p.value, u.name AS user_name, m.name AS mem_name 
                FROM pay p 
                JOIN user u ON p.user_id = u.user_id 
                JOIN membership_type m ON p.type_id = m.type_id ORDER BY p.pay_date ASC';
        
        return self::getConnection()->query($sql)->fetchAll();
    }

    public static function getPaysByUserId($userId)
    {
        $sql = 'SELECT p.pay_id, mt.name AS mem_name, p.value, p.pay_date  
        FROM pay p
        JOIN membership_type mt ON p.type_id = mt.type_id 
        WHERE p.user_id = ? ORDER BY pay_Date DESC'; 
        return self::getConnection()->query($sql, [$userId])->fetchAll();
    }

    public static function getMonths($pays) {
    $months = [];
    foreach($pays as $pay) {
        $date = strtotime($pay['pay_date']);
        $month = date('F-y', $date);

        if (!in_array($month, $months)) {
            $months[] = $month;
        }
    }
    return $months;
    }

    public static function getPaysByMonth($month) {
        $sql = "SELECT * FROM pay WHERE DATE_FORMAT(pay_date, '%M-%y') = ?";
        return self::getConnection()->query($sql, [$month])->fetchAll();
    }

    public static function getTotalByMonths($pays)
    {
        $result = [];

        foreach ($pays as $pay) {
            $date = date('F', strtotime($pay['pay_date']));
            $value = $pay['value'];

            if(! isset($result[$date])) $result[$date] = 0;

            $result[$date] += $value;
        }

        return $result;
    }

    public static function getTotal($pays) {
        $total = 0;
        foreach($pays as $pay) {
            $total += $pay['value'];
        }
        return $total;
    }
}

