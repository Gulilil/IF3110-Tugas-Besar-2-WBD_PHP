<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('Database.php');

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

  public function getRelationshipByID($id){
    $this->db->query('SELECT * FROM '.$this->table. ' WHERE relationship_id = '. $id);
    return $this->db->fetchData();
  }

  public function getMutualRelationship($id1, $id2){
    $this->db->query('SELECT * FROM '.$this->table.' WHERE client_id_1 = '.$id1.' AND client_id_2 = '.$id2.' OR client_id_1 = '.$id2.' AND client_id_2 = '.$id1);
    return ($this->db->fetchData());
    // return true if there is a mutual relationship, otherwise false
  }

  public function insertRelationship($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('INSERT INTO ' . $this->table . ' (client_id_1, client_id_2, type) VALUES ('.$data['client_id_1'].','.$data['client_id_2'].','.$data['type'].')');
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function updateRelationship($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('UPDATE ' . $this->table . 'SET client_id_1 = '.$data['client_id_1'].', client_id_2 = '.$data['client_id_2'].', type = '.$data['type'].' WHERE relationship_id = '. $data['relationship_id']);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function deleteRelationship($id){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE relationship_id = '. $id);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

}