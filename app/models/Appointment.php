<?php


class Appointment{
    public function __construct(){
        $this->db = new Database();
    }

    public function getAll(){
        $this->db->query('SELECT * FROM clients ORDER BY id DESC ');
        $appointments = $this->db->resultSet();
        return $appointments;
    }

    public function getSingle($id){
        $this->db->query('SELECT * FROM clients WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update($data){
        $this->db->query('UPDATE clients SET appointmentDate = :date, mechanic = :mechanic WHERE id = :id');
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':mechanic', $data['mechanic']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function create($data){
//        extract($data);
        $date = $data->appointmentYear.'-'.$data->appointmentMonth.'-'.$data->appointmentDay;
//        echo $date;
        $this->db->query('INSERT INTO clients (name, address, phone, engineNumber, licenseNumber, mechanic, appointmentDate) VALUES (:name, :address, :phone, :engineNumber, :licenseNumber, :mechanic, :appointmentDate)');
        $this->db->bind(':name', $data->name);
        $this->db->bind(':address', $data->address);
        $this->db->bind(':phone', $data->phone);
        $this->db->bind(':engineNumber', $data->engineNo);
        $this->db->bind(':licenseNumber', $data->licenseNo);
        $this->db->bind(':mechanic', $data->mechanic);
        $this->db->bind(':appointmentDate', $date);
        $this->db->execute();
    }

    public function getMechanicAppointmentsCount($mechanic, $date){
        $this->db->query('SELECT * FROM clients WHERE mechanic = :mechanic AND appointmentDate = :date');
        $this->db->bind(':mechanic', $mechanic);
        $this->db->bind(':date', $date);
        $this->db->execute();
        return $this->db->rowCount();
    }
}