<?php

namespace models;

use Core\App;

class User {

    private static $conn;

    public function __construct(private $userId, private $name, private $email, private $password, private $rol, private $token){
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
        $this->token = $token;
    }

    public function __get($prop) {
        if(property_exists($this, $prop)) {
            return $this->$prop;
        }
        return null;
    }

    public function __set($prop, $value) {
        if(property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }

    private static function getConnection() {
        if (!self::$conn) {
            self::$conn = App::dataBase();
        }
        return self::$conn;
    }

    public function saveUser() {
            $sql = "INSERT INTO user (userId, name, email, password, rol) VALUES (?,?,?,?,?)";
            self::getConnection()->query($sql, [$this->userId, $this->name, $this->email, $this->password, $this->rol]);
    }

    public static function editProp($user, $prop, $value) {
        if(property_exists($user, $prop)) {
            $sql = "UPDATE user SET $prop = ? WHERE userId = ?";
            return self::getConnection()->query($sql, [$value, $user->__get('userId')]);
        }
    }

    public static function editUser(...$props)
    {
        $sql = "UPDATE user set name = ?, email = ?, rol = ? WHERE userId = ?";
        self::getConnection()->query($sql, $props);
    }

    public static function deleteById($id) {
            $sql = "DELETE FROM user WHERE userId = ?";
            return self::getConnection()->query($sql, [$id]);
    }

    public static function findUserById($id) {
        $sql = "SELECT * FROM user WHERE userId = ?";
        $result =self::getConnection()->query($sql, [$id])->fetch();

        if($result) 
            return new User($id, $result["name"], $result["email"], $result["password"], $result["rol"], $result["token"]);
        
        return $result;
    }

    public static function findUserByEmail($email) {
        $sql = "SELECT * FROM user WHERE email = ?";
        $result = self::getConnection()->query($sql, [$email])->fetch();

        if($result) 
            return new User($result["userId"], $result["name"], $email, $result["password"], $result["rol"], $result["token"]);
        
        return $result;
    }

    public static function findByToken($token) {
        $sql = "SELECT * FROM user WHERE token = ?";
        $result = self::getConnection()->query($sql, [$token])->fetch();

        if($result) 
            return new User($result["userId"], $result["name"], $result["email"], $result["password"], $result["rol"], $token);
        
        return null;
    }

    public static function getUsers() {
        $sql = "SELECT * FROM user";
        return self::getConnection()->query($sql)->fetchAll();
    }
}