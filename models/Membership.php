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
        $sql = 'SELECT * FROM membership WHERE user_id = ?';
        return self::getConnection()->query($sql, [$userId])->fetch();
    }

    public static function findByEmail($email)
    {
        $sql = 'SELECT m.mem_id AS mem_id, u.name AS user_name, mt.name AS membership_type, m.start_date AS start_date, m.days_re AS days_res, m.status
                FROM user u
                JOIN membership m ON u.user_id = m.user_id
                JOIN membership_type mt ON m.type_id = mt.type_id
                JOIN pay p ON u.user_id = p.user_id where u.email = ?';

        return self::getConnection()->query($sql, [$email])->fetch();
    }

    public static function findByMemId($memId)
    {
        $sql = 'SELECT * FROM membership WHERE mem_id = ?';
        return self::getConnection()->query($sql, [$memId])->fetch();
    }

    public static function getMembers()
    {
        $sql = 'SELECT m.mem_id AS mem_id, u.name AS user_name, mt.name AS membership_type, m.start_date AS start_date, m.days_re AS days_res, m.status
        FROM user u
        JOIN membership m ON u.user_id = m.user_id
        JOIN membership_type mt ON m.type_id = mt.type_id';

        return self::getConnection()->query($sql)->fetchAll();
    }

    public static function totalForeachMonth($months, $dates)
    {
        $result = [];
        foreach($months as $month)
        {
            if(in_array($month, $dates)) {
                $cont = 0;
                foreach($dates as $date)
                {
                    if($date == $month) $cont++;
                }
                $result[$month] = $cont;
            }
            else {
                $result[$month] = 0;
            }
        }
        return $result;
    }

    public static function deleteByUserId($userId)
    {
        $sql = 'DELETE FROM membership WHERE user_id = ?';
        return self::getConnection()->query($sql, [$userId]);
    }

    public static function takeAsist($mem)
    {
        $conn = self::getConnection();

        $sql = 'SELECT count(*) AS count FROM asist WHERE user_id = ? AND asist_date = CURRENT_DATE';
        $stmt = $conn->query($sql, [$mem['user_id']])->fetch();

        if($stmt['count']>=2) 
            throw new PDOException('No se puede tomar mas de dos veces la asistencia');
        
        $sql = 'INSERT INTO asist (user_id, asist_date) VALUES (?, CURRENT_DATE)';
        $conn->query($sql, [$mem['user_id']]);
    }

    public static function getAsistsByUSerId($userId)
    {
        $sql = 'SELECT * FROM asist WHERE user_id = ? ORDER BY asist_date DESC';
        return self::getConnection()->query($sql, [$userId])->fetchAll();
    }

    public static function getAsistToday()
    {
        $sql = 'SELECT * FROM asist WHERE asist_date = CURRENT_DATE()';
        return self::getConnection()->query($sql)->fetchAll();
    }
}