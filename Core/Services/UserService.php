<?php

namespace Core\Services;

use Core\Validator;
use Core\Response;
use models\User;
use models\MembershipType;
use models\Membership;
use models\Pay;

class UserService
{
    public static function addPay()
    {
        $url = '/dashboard';

        $inputs = getPost('userId', 'typeId');

        Validator::user($inputs['userId'], $url);

        if (! isset($inputs['typeId'])) Response::redirect($url, 'danger', 'Debe seleccionar un tipo de membresia');


        if (! User::findUserById($inputs['userId'])) Response::redirect($url, 'danger', 'Usuario no encontrado');

        if (! MembershipType::findById($inputs['typeId'])) Response::redirect($url, 'danger', 'Membresia no encontrada');

        $membership = Membership::findByUserId($inputs['userId']);

        if ($membership && $membership['status'] != 'vencida') Response::redirect($url, 'danger', 'Ya el usuario tiene una membresia');

        $pay = new Pay($inputs['userId'], $inputs['typeId']);

        if ($membership['status'] == 'vencida') Membership::deleteByUserId($inputs['userId']);

        // generar el pago

        try {
            $pay->savePay();
            Response::redirect($url, 'success', 'Pago registrado exitosamente');
        } catch (\PDOException $e) {
            Response::redirect($url, 'success', 'Error al registrar pago');
        }
    }
}