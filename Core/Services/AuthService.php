<?php

namespace Core\Services;

use Core\Validator;
use Core\Response;
use models\User;
use PDOException;

require base_path('helper/mailer.php');


class AuthService {
    
    public static function logIn() 
    {
        $url = '/login';
        
        $inputs = getPost('_method', 'email', 'pass', 'remember');

        $inputs = Validator::inputs($inputs, $url);
        Validator::email($inputs['email'], $url);

        $user = User::findUserByEmail($inputs['email']);

        if($user) {
            if(password_verify($inputs['pass'], $user->__get("password"))) {
                session_start();
                $_SESSION["user"] = $inputs['email'];
                $_SESSION["rol"] = $user->__get("rol");
                $_SESSION["userId"] = $user->__get("userId");
            
                if($inputs['remember']) 
                    self::rememberSession($user);
                else
                    setcookie("token", "", time() - 3600, "/", false, true);
            
                Response::redirectToDashboard();

            } else Response::redirect($url, 'danger', 'Contraseña incorrecta');
            
        } else Response::redirect($url, 'danger', 'Usuario no encontrado');   
        
    }

    public static function signUp() 
    {
        $url = '/signup';
        
        $inputs = getPost('id', 'name', 'email', 'pass');
    
        $inputs = Validator::inputs($inputs, $url);

        Validator::email($inputs['email'], $url);

        if(User::findUserById($inputs['id'])) Response::redirect($url, 'danger', 'Ya existe una cuenta con este id');
        
        if(User::findUserByEmail($inputs['email'])) Response::redirect($url, 'danger', 'Ya existe una cuenta con este email');
        
        $hashPass = password_hash($inputs['pass'], PASSWORD_DEFAULT);
        $user = new User($inputs['id'], $inputs['name'], $inputs['email'], $hashPass, "user", null);

        try {
            $user->saveUser();
            Response::redirect('/login', 'success', 'Cuenta creada exitosamente');
        } catch(PDOException $e) {
            Response::redirect($url, 'danger', 'Error al crear cuenta');
        }    
    }

    public static function recoverPass() 
    {
        $url = '/recover';
        
        $email = $_POST['email'] ?? null;

        if(! $email) Response::redirect($url, 'danger', 'El campo es requerido');

        Validator::email($email, $url);

        $user = User::findUserByEmail($email);

        if($user) {
            $tempPass = self::generatePass(10);
            $tempPassHash = password_hash($tempPass, PASSWORD_DEFAULT);
            User::editProp($user, "password", $tempPassHash);
            try {
                \Mailer::sendMail($email, $user->__get("name"), "Contraseña provicional", "Contraseña: $tempPass");
                Response::redirect('/login', 'success', 'Contraseña provicional enviada');
            }catch(\Exception $e) {
                Response::redirect($url, 'danger', 'Error al enviar contraseña provicional');
            }
        }
        else {
            Response::redirect($url, 'danger', 'Usuario no encontrado');
        }
    }


    public static function changuePassword($userId) 
    {
        $url = '/changepass';
        $inputs = getPost('currentPass', 'newPass', 'passConfirmation');
        $inputs = Validator::inputs($inputs, $url);

        if($inputs['newPass'] !== $inputs['passConfirmation']) {
            Response::redirect($url, 'danger', 'Las contraseñas no coinciden');
        }

        $user = User::findUserById($userId);
        
        if(! $user) {
            Response::redirect($url, 'danger', 'Usuario no encontrado');
        }

        if(! password_verify($inputs['currentPass'], $user->__get("password"))) {
            Response::redirect($url, 'danger', 'Contraseña actual incorrecta');
        }

        $newPassHash = password_hash($inputs['newPass'], PASSWORD_DEFAULT);

        try {
            User::editProp($user, "password", $newPassHash);
            Response::redirect('/user/dashboard', 'success', 'Contraseña cambiada exitosamente');
        } catch(PDOException $e) {
            Response::redirect($url, 'danger', 'Error al cambiar contraseña');
        }
    }   

    private static function rememberSession($user) 
    {
        $token = bin2hex(random_bytes(8));
        $hashToken = hash("md5", $token,);
        setcookie("token", $token, time() + (86400 * 7), "/", false, true);
        User::editProp($user, "token", $hashToken);
    }

    public static function chekKeepSession() 
    {
        if(isset($_COOKIE['token'])) {
            $user = User::findByToken(hash("md5", $_COOKIE['token']));
            
            if(! $user) {
                abort(403);
            }

            $_SESSION['temp_user'] = $user;
            Response::redirect('/keepSession');
        }
        return false;
    }

    public static function recoverSession()
    {
        $url = '/keepSession';
        $inputs = getPost('email', 'rol', 'userId');

        Validator::inputs($inputs, $url);
        Validator::email($inputs['email'], $url);

        start_session($inputs['email'], $inputs['rol'], $inputs['userId']);
        Response::redirectToDashboard();
    }

    public static function logOut() 
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        $params = session_get_cookie_params();
        setcookie("token", "", time() - 3600, "/", false, true);
        setcookie('PHPSESSID', '', time()-3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        Response::redirect('/login');
    }


    public static function generatePass($length) {
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
            return substr(str_shuffle(str_repeat($caracteres, ceil($length / strlen($caracteres)))), 0, $length);
    }

}

