<?php


class AppointmentsController extends Controller{
    public function __construct(){
        $this->appointmentModel = $this->model('Appointment');
    }

    public function create(){
//        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//            headers
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

            $data = json_decode(file_get_contents("php://input"));
//            var_dump($data);
//            Sanitize post data
//            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//            validating data
            $message = validateForm($data);
            if (empty($message['err'])){
                $this->appointmentModel->create($data);
                $message['success'] = true;
//                echo json_encode($messege);
//                header('location: /');
            }
//        $message['name'] = $data->name;
            echo json_encode($message);



//        }else{
//            header('location: /');
//        }
    }

    public function edit($id){
        $client = $this->getSingleAppointment($id);
        $client->date_err = '';
        $this->view('admin/appointmentEdit', $client, 'client');
    }

    public function update($id){
        guestRedirect();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//            Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            extract($_POST);

            $data = [
                'id' => $id,
                'date' =>  $appointmentYear.'-'.$appointmentMonth.'-'.$appointmentDay,
                'mechanic' => $mechanic,
            ];

//        checking if the date is valid
            if(validateDate($data['date'])){
//                update appointment
                $this->appointmentModel->update($data);
                adminRedirect();

            }else{
//                Date is invalid, redirect to edit page with error
                $client = $this->getSingleAppointment($id);
                $client->date_err = 'Invalid date';
                $this->view('admin/appointmentEdit', $client, 'client');
            }
        }else{
            header('location: /appointments/edit/'.$id);
        }

    }

//    sends single appointment
    public function getSingleAppointment($id){
        guestRedirect();
        return $this->appointmentModel->getSingle($id);
    }

//    checks if the mechanic is available
    public function validateMechanic($mechanic, $date){
        $arr = array();
        if (isMechanicAvailable($mechanic, $date)){
            $arr['response'] = true;
        }else{
            $arr['response'] = false;
        }
        echo json_encode($arr);
    }
}