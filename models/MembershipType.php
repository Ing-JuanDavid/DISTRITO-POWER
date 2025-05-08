<?php

namespace models;

use Core\App;

class MembershipType {

    private static $conn;

    public function __construct(private $typeId, private $name, private $duration, private $value)
    {
        $this->typeId = $typeId;
        $this->name = $name;
        $this->duration = $duration;
        $this->value = $value;
    }

    public function __set($prop, $value)
    {
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

    public function saveMembershipType() {
        $sql = "INSERT INTO membershipType (typeId, name, duration, value) VALUES (?,?,?,?)";
        return self::getConnection()->query($sql, [$this->typeId, $this->name, $this->duration, $this->value]);
    }

    public static function getMems() {
        $sql = "SELECT * FROM membershipType";
        return self::getConnection()->query($sql)->fetchAll();
    }

    public static function findById($id) {
        $sql = "SELECT * FROM membershipType WHERE typeId = ?";
        $result = self::getConnection()->query($sql, [$id])->fetch();

        if($result) {
            return new MembershipType($result['typeId'], $result['name'], $result['duration'], $result['value']);
        }
        return $result;
    }
}



