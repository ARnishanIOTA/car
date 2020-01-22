<?php

//validating date
function validateDate($date){
    if(strtotime(date('Y-n-j')) <= strtotime($date)){
        return true;
    }
    return false;
}

//validating form
function validateForm($data){
//    extract($data);

    $date = $data->appointmentYear.'-'.$data->appointmentMonth.'-'.$data->appointmentDay;
    $message['err'] = array();
    $err = array();
    if (empty($data->name)){
        $err['name'] = 'Name can not be empty';
    }
    if (empty($data->address)){
        $err['address'] = 'Address can not be empty';
    }
    if (empty($data->phone)){
        $err['phone'] = 'Phone no can not be empty';
    }
    if (empty($data->engineNo)){
        $err['engineNo'] = 'Engine no can not be empty';
    }
    if (empty($data->licenseNo)){
        $err['licenseNo'] = 'License no can not be empty';
    }
    if (!validateDate($date)){
        $err['date'] = 'Date is invalid';
    }
    if (empty($data->mechanic)){
        $err['mechanic'] = 'You have to select a mechanic';
    }else{
        if (!isMechanicAvailable($data->mechanic, $date)){
            $err['mechanic'] = $data->mechanic.' is not available on that day';
        }
    }
    $message['err'] = $err;
    return $message;
}

function isMechanicAvailable($mechanic, $date){
    $appointmentModel = new Appointment();
    $appointmentCount = $appointmentModel->getMechanicAppointmentsCount($mechanic, $date);
    if ($appointmentCount>=4){
        return false;
    }
    return true;
}