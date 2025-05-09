<?php

namespace Core;

use Core\Response;
use Core\Validator;
use models\Membership;
use models\MembershipType;
use models\Pay;
use models\User;
use PDOException;

class Admin {
    private $conn;

    public static function addUser() 
    {
        $url = '/admin/dashboard';

        $inputs = getPost('id', 'name', 'email', 'pass', 'rol');

        $inputs = Validator::inputs($inputs, $url);

        Validator::rol($inputs['rol'], ["admin", "user"], $url);

        Validator::email($inputs['email'], $url);
            
        if (User::findUserById($inputs['id'])) Response::redirect($url, 'error', 'Ya existe un usuario con este ID');

        if (User::findUserByEmail($inputs['email'])) Response::redirect($url, 'error', 'Ya existe un usuario con este email');

        $inputs['pass'] = password_hash($inputs['pass'], PASSWORD_DEFAULT);
        $user = new User($inputs['id'], $inputs['name'], $inputs['email'], $inputs['pass'], $inputs['rol'], null);


        try {
            $user->saveUser();
            Response::redirect($url, 'success', 'Usuario creado exitosamente');
        } catch (\PDOException $e) {
            Response::redirect($url, 'error', 'Error al crear el usuario');
        }    
    }

    public static function addMembershipType()
    {
        $url = '/admin/dashboard';

        $inputs = getPost('typeId', 'name', 'duration', 'value');
        $inputs = Validator::inputs($inputs, $url);

        $mem = MembershipType::findById($inputs['typeId']);

        if ($mem) Response::redirect($url, 'error', 'Ya existe una membresia con ese Id');

        $mem = new MembershipType($inputs['typeId'], $inputs['name'], $inputs['duration'], $inputs['value']);

        try {
            $mem->saveMembershipType();
            Response::redirect($url, 'success', 'Membresia creada exitosamente');
        } catch (PDOException $e) {
            Response::redirect($url, 'error', 'Error al crear membresia');
        }
    }

    public static function addPay()
    {
        $url = '/admin/pays';

        $inputs = getPost('userId', 'typeId');
        $inputs = Validator::inputs($inputs, $url);


            if(! User::findUserById($inputs['userId'])) Response::redirect($url, 'error', 'Usuario no encontrado');

            if(!  MembershipType::findById($inputs['typeId'])) Response::redirect($url, 'error', 'Membresia no encontrada');

            $membership = Membership::findByUserId($inputs['userId']);

            if($membership && $membership['status'] != 'vencida') Response::redirect($url, 'error', 'Ya el usuario tiene una membresia');
            
            $pay = new Pay($inputs['userId'], $inputs['typeId']);
            
            if($membership['status'] == 'vencida') Membership::deleteByUserId($inputs['userId']);

            // generar el pago

            try {
                $pay->savePay();
                Response::redirect($url, 'success', 'Pago registrado exitosamente');
            } catch(PDOException $e) {
                Response::redirect($url, 'success', 'Error al registrar pago');
            }
        
    }

    public static function takeAsist($memId) 
    {
        $url = '/admin/pays';
        $mem = Membership::findByMemId($memId);
        
        if(! $mem || $mem['status'] == 'vencida') Response::redirect($url, 'error', 'Accion invalida');

        try {
            Membership::takeAsist($mem);
            Response::redirect($url, 'success', 'Asistencia registrada');
        } catch(PDOException $e) {
            Response::redirect($url, 'error', $e->getMessage());
        }   

    }
}