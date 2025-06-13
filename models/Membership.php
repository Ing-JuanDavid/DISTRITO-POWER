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

    public static function findByEmail($email)
    {
        $sql = 'SELECT m.memId AS mem_id, u.name AS user_name, mt.name AS membership_type, m.startDate AS start_date, m.daysRe AS days_res, m.status
                FROM user u
                JOIN membership m ON u.userId = m.userId
                JOIN membershipType mt ON m.typeId = mt.typeId
                JOIN pay p ON u.userId = p.userId where u.email = ?';

        return self::getConnection()->query($sql, [$email])->fetch();
    }

    public static function findByMemId($memId)
    {
        $sql = 'SELECT * FROM membership WHERE memId = ?';
        return self::getConnection()->query($sql, [$memId])->fetch();
    }

    public static function getMembers()
    {
        $sql = 'SELECT m.memId AS mem_id, u.name AS user_name, mt.name AS membership_type, m.startDate AS start_date, m.daysRe AS days_res, m.status
        FROM user u
        JOIN membership m ON u.userId = m.userId
        JOIN membershipType mt ON m.typeId = mt.typeId';

        return self::getConnection()->query($sql)->fetchAll();
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

    public static function getAsistsByUSerId($userId)
    {
        $sql = 'SELECT * FROM asist WHERE userId = ? ORDER BY asistDate DESC';
        return self::getConnection()->query($sql, [$userId])->fetchAll();
    }

    public static function getAsistToday()
    {
        $sql = 'SELECT * FROM asist WHERE asistDate = CURRENT_DATE()';
        return self::getConnection()->query($sql)->fetchAll();
    }
}