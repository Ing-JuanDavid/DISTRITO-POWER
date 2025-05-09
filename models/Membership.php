<?php

namespace models;

use Core\App;
use PDOException;

class Membership {
    private $userId;
    private $typeId;
    private $daysRe;
    private static $conn;

    public function __construct($userId, $typeId, $daysRe)
    {
        $this->userId = $userId;
        $this->typeId = $typeId;
        $this->daysRe = $daysRe;
    }

    public function __set($prop, $value) {
        if(property_exists($this, $prop)) {
            $this->$prop = $value; 
        }
    }

    public function __get($prop)
    {
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

    public static function findByUserId($userId)
    {
        $sql = 'SELECT * FROM membership WHERE userId = ?';
        return self::getConnection()->query($sql, [$userId])->fetch();
    }

    public static function findByMemId($memId)
    {
        $sql = 'SELECT * FROM membership WHERE memId = ?';
        return self::getConnection()->query($sql, [$memId])->fetch();
    }

    public static function deleteByUserId($userId)
    {
        $sql = 'DELETE FROM membership WHERE userId = ?';
        return self::getConnection()->query($sql, [$userId]);
    }

    public static function takeAsist($mem)
    {
        $conn = self::getConnection();

        $sql = 'SELECT count(*) AS count FROM asist WHERE userId = ? AND asistDate = CURRENT_DATE';
        $stmt = $conn->query($sql, [$mem['userId']])->fetch();

        if($stmt['count']>=2) 
            throw new PDOException('No se puede tomar mas de dos veces la asistencia');
        
        $sql = 'INSERT INTO asist (userId, asistDate) VALUES (?, CURRENT_DATE)';
        $conn->query($sql, [$mem['userId']]);
    }
}