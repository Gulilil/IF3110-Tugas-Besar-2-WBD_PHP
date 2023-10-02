<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('database.php');

class Relationship {
  private $table = 'relationship';
  private $db;

  public function __construct(){
    $this->db = new Database ();
  }

  public function getAllRelationship(){
    $this->db->query('SELECT * FROM '.$this->table);
    return $this->db->fetchAllData();
  }

  public function getRelationShipByID($id){
    $this->db->query('SELECT * FROM '.$this->table. 'WHERE relationship_id = '. $id);
    return $this->db->fetchData();
  }

  public function insertRelationship($data){
    $this->db->query('INSERT INTO ' . $this->table . ' (client_id_1, client_id_2) VALUES ('.$data['client_id_1'].','.$data['client_id_2'].')');
    $this->db->execute();
    return ($this->db->countRow() == 1);
    // if countRow != 1, query fails
  }

  public function updateRelationship($data){
    $this->db->query('UPDATE ' . $this->table . 'SET client_id_1 = '.$data['client_id_1'].', client_id_2 = '.$data['client_id_2'].' WHERE relationship_id = '. $data['relationship_id']);
    $this->db->execute();
    return ($this->db->countRow() == 1);
    // if countRow != 1, query fails
  }

  public function deleteRelationship($data){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE relationship_id = '. $id);
    $this->db->execute();
    return ($this->db->countRow() == 1);
    // if countRow != 1, query fails
  }

}