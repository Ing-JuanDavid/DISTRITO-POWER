<?php
namespace Core;

class Response {

    public static function redirectToDashboard() 
    {
        session_start();
        
        switch ($_SESSION["rol"]) {
            case 'admin':
                Response::redirect('/admin/dashboard');
            case 'user':
                Response::redirect('/user/dashboard');
            default:
                Response::redirect('/logout');
        }
    }

    public static function redirect($url, $type = null, $body = null) 
    {
        if($type && $body) self::createAlert($type, $body);

        header("Location: $url");
        die();
    }


    public static function createAlert($type, $body)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['alert'] = [
            'type' => $type,
            'body' => $body
        ];
    }

    public static function getAlert()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $alert = $_SESSION['alert'] ?? null;
        
        if($alert) {
            unset($_SESSION['alert']);
            return $alert;
        }

        return $alert;
    }
}