<?php


class Admin{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    //    Register admin
    public function register($data){
        $this->db->query('INSERT INTO admin (name, email, pass) VALUES (:name, :email, :pass)');

//        Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);

//        Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

//    admin login
    public function login($email, $pass){
        $this->db->query('SELECT * FROM admin WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        $hashedPass = $row->pass;
        if (password_verify($pass, $hashedPass)){
            return $row;
        }else{
            return false;
        }
    }

//    Check if email already exists
    public function checkEmail($email){
        $this->db->query('SELECT * FROM admin WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}