<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('database.php');

class Anime_List{
  private $table = 'anime_list';
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getAllAnimeList(){
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->fetchAllData();
  }

  public function getAnimeListByID($id){
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE list_id = '. $id);
    return $this->db->fetchData();
  }

  public function getAllAnimeListByClientID($id){
    $thid->db->query('SELECT * FROM ' . $this->table . ' WHERE client_id = '. $id);
    return $this->db->fetchAllData();
  }

  public function insertAnimeList($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('INSERT INTO ' . $this->table . ' (client_id, anime_id, user_score, progress, watch_status, review) VALUES ('.$data['client_id'].','.$data['anime_id'].','.$data['user_score'].','.$data['progress'].','.$data['watch_status'].','.$data['review'].')');
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function updateAnimeList($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('UPDATE ' . $this->table . 'SET client_id = '.$data['client_id'].', anime_id = '.$data['anime_id'].', user_score = '.$data['user_score'].', progress = '.$data['progress'].', watch_status = '.$data['watch_status'].', review = '.$data['review'].' WHERE list_id = '. $data['list_id']);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function deleteAnimeList($id){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE list_id = '. $id);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
}

}