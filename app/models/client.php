<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('Database.php');

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

    public function getClientByID($id){
      $id = $this->db->processDataType($id);
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE client_id = ' . $id);
      return $this->db->fetchData();
    }

    public function getClientByUsername($username){
      $username = $this->db->processDataType($username);
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = '. $username);
      return $this->db->fetchData();
    }

    public function getClientByEmail($email){
      $email = $this->db->processDataType($email);
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = '. $email);
      return $this->db->fetchData();
    }

    public function insertClient($data){
      foreach($data as $key => $value){
        $data[$key] = $this->db->processDataType($value);
      }
      $this->db->query('INSERT INTO ' . $this->table . ' (username, email, password, admin_status, birthdate, bio, image) VALUES ('.$data['username'].','.$data['email'].','.$data['password'].','.$data['admin_status'].','.$data['birthdate'].','.$data['bio'].','.$data['image'].')');
      $this->db->execute();
      return ($this->db->countRow() != 0);
      // if countRow == 0, query fails
    }

    public function updateClient($data){
      foreach($data as $key => $value){
        $data[$key] = $this->db->processDataType($value);
      }
        $this->db->query('UPDATE ' . $this->table . 'SET username = '.$data['username'].', email = '.$data['email'].', password = '.$data['password'].', admin_status = '.$data['admin_status'].', birthdate = '.$data['birthdate'].', bio = '.$data['bio'].', image = '.$data['image'].' WHERE client_id = '. $data['client_id']);
        $this->db->execute();
        return ($this->db->countRow() != 0);
        // if countRow == 0, query fails
    }

    public function deleteClient($id){
      $id = $this->db->processDataType($id);
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE client_id = '. $id);
        $this->db->execute();
        return ($this->db->countRow() != 0);
        // if countRow == 0, query fails
    }

}