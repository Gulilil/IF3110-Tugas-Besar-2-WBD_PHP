<?php

require_once(dirname(__DIR__, 1).'/setup/setup.php');
require_once('database.php');

class Client {
    private $table = 'client';
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllClient(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->fetchAllData();
    }

    public function getClientByUsername($username){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = '. $username);
        return $this->db->fetchData();
    }

    public function getClientByEmail($email){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = '. $email);
        return $this->db->fetchData();
    }

    public function insertClient($data){
        $this->db->query('INSERT INTO ' . $this->table . 'VALUES ('.$data['client_id'].','.$data['username'].','.$data['email'].','.$data['password'].','.$data['admin_status'].','.$data['birthdate'].','.$data['biography'].','.$data['image'].')');
        $this->db->execute();
        return ($this->db->countRow() == 1);
        // if countRow != 1, query fails
    }

    public function updateClient($data){
        $this->db->query('UPDATE ' . $this->table . 'SET username = '.$data['username'].', email = '.$data['email'].', password = '.$data['password'].', admin_status = '.$data['admin_status'].', birthdate = '.$data['birthdate'].', biography = '.$data['biography'].', image = '.$data['image'].' WHERE cliend_id = '. $data['client_id']);
        $this->db->execute();
        return ($this->db->countRow() == 1);
        // if countRow != 1, query fails
    }

    public function deleteClient($id){
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE client_id = '. $id);
        $this->db->execute();
        return ($this->db->countRow() == 1);
        // if countRow != 1, query fails
    }
}