<?php

namespace Core\Services;

use Core\Response;
use Core\Validator;
use Helper\ReportPdf;
use models\Membership;
use models\MembershipType;
use models\Pay;
use models\User;
use PDOException;

class AdminService {

    public static function addUser() 
    {
        $url = '/admin/dashboard';

        $inputs = getPost('id', 'name', 'email', 'pass', 'rol');

        $inputs = Validator::inputs($inputs, $url);

        Validator::rol($inputs['rol'], ["admin", "user"], $url);

        Validator::email($inputs['email'], $url);
            
        if (User::findUserById($inputs['id'])) Response::redirect($url, 'danger', 'Ya existe un usuario con este ID');

        if (User::findUserByEmail($inputs['email'])) Response::redirect($url, 'danger', 'Ya existe un usuario con este email');

        $inputs['pass'] = password_hash($inputs['pass'], PASSWORD_DEFAULT);
        $user = new User($inputs['id'], $inputs['name'], $inputs['email'], $inputs['pass'], $inputs['rol'], null);


        try {
            $user->saveUser();
            Response::redirect($url, 'success', 'Usuario creado exitosamente');
        } catch (\PDOException $e) {
            Response::redirect($url, 'danger', 'Error al crear el usuario');
        }    
    }

    public static function editUser()
    {
        $url = '/admin/dashboard';

        $inputs = getPost('userId', 'name', 'email', 'rol');
        $inputs = Validator::inputs($inputs, $url);

        Validator::email($inputs['email'], $url);

        $user = User::findUserById($inputs['userId']);
        
        if(! $user) Response::redirect($url, 'danger', 'El usuario con ID: ' . $inputs['userId'] . ' no existe');

        try { 
                User::editUser($inputs['name'], $inputs['email'], $inputs['rol'], $inputs['userId']);    
                Response::redirect($url, 'success', 'Usuario actualizado');
        } catch(PDOException $e) {
            Response::redirect($url, 'danger', 'Error al editar usuario');
        }
        
    }

    public static function destroyUser()
    {
        $url = '/admin/dashboard';
        $id = $_GET['id'] ?? null;
        
        if(! User::findUserById($id)) Response::redirect($url, 'danger', 'No existe el usuario a eliminar');

        
        if(User::deleteById($id)) Response::redirect($url, 'success', 'Usuario eliminado');
    }

    public static function addMembershipType()
    {
        $url = '/admin/dashboard';

        $inputs = getPost('typeId', 'name', 'duration', 'value');
        $inputs = Validator::inputs($inputs, $url);

        $mem = MembershipType::findById($inputs['typeId']);

        if ($mem) Response::redirect($url, 'danger', 'Ya existe una membresia con ese Id');

        $mem = new MembershipType($inputs['typeId'], $inputs['name'], $inputs['duration'], $inputs['value']);

        try {
            $mem->saveMembershipType();
            Response::redirect($url, 'success', 'Membresia creada exitosamente');
        } catch (PDOException $e) {
            Response::redirect($url, 'danger', 'Error al crear membresia');
        }
    }

    public static function editMembershipType()
    {
        $url = '/admin/dashboard';

        $inputs = getPost('typeId', 'name', 'duration', 'value');

        $inputs = Validator::inputs($inputs, $url);

        $mem = MembershipType::findById($inputs['typeId']);
        
        if(! $mem) Response::redirect($url, 'danger', 'La membresia con ID: ' . $inputs['typeId'] . ' no existe');

        try { 
                MembershipType::editMem($inputs['name'], $inputs['duration'], $inputs['value'], $inputs['typeId']);    
                Response::redirect($url, 'success', 'Membresia actualizada');
        } catch(PDOException $e) {
            Response::redirect($url, 'danger', 'Error al editar membresia');
        }
        
    }

    public static function destroyMemBershipType()
    {
        $url = '/admin/dashboard';
        $id = $_GET['id'] ?? null;
        
        if(! MembershipType::findById($id)) Response::redirect($url, 'danger', 'No existe la membresia a eliminar');

        if(MembershipType::deleteById($id)) Response::redirect($url, 'success', 'Membresia eliminada');
    }

    public static function addPay()
    {
        $url = '/admin/dashboard';

        $inputs = getPost('userId', 'typeId');

        $inputs= Validator::inputs($inputs, $url);        
        

            if(! User::findUserById($inputs['userId'])) Response::redirect($url, 'danger', 'Usuario no encontrado');

            if(!  MembershipType::findById($inputs['typeId'])) Response::redirect($url, 'danger', 'Membresia no encontrada');

            $membership = Membership::findByUserId($inputs['userId']);

            if($membership && $membership['status'] != 'vencida') Response::redirect($url, 'danger', 'Ya el usuario tiene una membresia');
            
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
        $url = '/admin/dashboard';
        $mem = Membership::findByMemId($memId);
        
        if(! $mem || $mem['status'] == 'vencida') Response::redirect($url, 'danger', 'Accion invalida');

        try {
            Membership::takeAsist($mem);
            Response::redirect($url, 'success', 'Asistencia registrada');
        } catch(PDOException $e) {
            Response::redirect($url, 'danger', $e->getMessage());
        }   

    }

    public static function makeReport()
    {
        $url = '/admin/dashboard';

        $inputs = getPost('date');
        // $inputs = Validator::inputs($inputs, $url);
        
    
        $header = ['ID', 'Usuario', 'Membresia', 'Monto', 'Fecha'];

        $pays = Pay::getPaysByMonth($inputs['date']);
        $total = Pay::getTotal($pays);

        $data = $data = array_map('array_values', $pays);

        $pdf = new ReportPdf();
        $pdf->addHeader('Reporte de Pagos'); // Opcional
        $pdf->addGeneratedDate();
        $pdf->addPaymentTable($header, $data, $total);
        $pdf->output();
    }
}