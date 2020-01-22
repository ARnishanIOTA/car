<?php

class AdminController extends Controller {
    public function __construct(){
        $this->userModel = $this->model('Admin');
        $this->appointments = $this->model('Appointment');
    }

    public function register(){
        adminRedirect();
//        check for post method
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//            process form data

//            Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            extract($_POST);
            $data = [
                'name' => trim($name),
                'email' => trim($email),
                'pass' => $pass,
                'name_err' => '',
                'email_err' => '',
                'pass_err' => '',
            ];

//            validation
//            Validate name
            if (empty($name)){
                $data['name_err'] = 'Please enter name';
            }
//            validate email
            if (empty($email)){
                $data['email_err'] = 'Please enter email';
            }elseif ($this->userModel->checkEmail($email)){
                $data['email_err'] = 'This email already exists';
            }
//            validate password
            if (strlen($pass) < 6){
                $data['pass_err'] = 'Password must be atleast 6 characters';
            }

//            checking if errors are empty
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['pass_err'])){
//                Validated
//                password hash
                $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

//                Register User
                if ($this->userModel->register($data)){
//                    Success
                    header('location: /admin/dashboard');
                }else{
                    die('Something went wrong');
                }

            }else{
//                Load view with errors
                $this->view('/admin/signup', $data);
            }

        }else{
//            return view
            $data = [
                'name' => '',
                'email' => '',
                'name_err' => '',
                'email_err' => '',
                'pass_err' => '',
            ];
            $this->view('/admin/signup', $data);
        }
    }


    public function login(){
        adminRedirect();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//            Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            extract($_POST);
            $data = [
                'email' => trim($email),
                'pass' => $pass,
                'email_err' => '',
                'pass_err' => '',
            ];

//            validation
//            validate password
            if (empty($pass)){
                $data['pass_err'] = 'Please enter password';
            }
//            validate email
            if ($this->userModel->checkEmail($data['email'])){
                //user found
//                check if there's no error
                if (empty($data['pass_err'])){
                    $loggedInUser = $this->userModel->login($data['email'], $data['pass']);

                    if ($loggedInUser){
//                        create session
                        createAdminSession($loggedInUser);

//                        redirect to dashboard
                        header('location: /admin/dashboard');

                    }else{
                        $data['pass_err'] = 'Incorrect Password';
                    }
                }
            }else{
                $data['email_err'] = 'This email doesn\'t exist';
            }


//            checking if errors are empty
            if (empty($data['email_err']) && empty($data['pass_err'])){
                die('Success');
            }else{
//                Load view with errors
                $this->view('/admin/login', $data);
            }
        }else{
            $data = [
                'email' => '',
                'email_err' => '',
                'pass_err' => '',
            ];
            $this->view('/admin/login', $data);
        }
    }

//    admin logout
    public function logout(){
        session_destroy();
        header('location: /');
    }

    public function dashboard(){
        guestRedirect();
        $appointments = $this->appointments->getAll();
        $this->view('/admin/dashboard', $appointments, 'appointments');

    }
}