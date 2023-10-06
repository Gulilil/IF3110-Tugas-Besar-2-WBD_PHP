<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('Database.php');

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
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE client_id = '. $id);
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

  // ================ SPECIFIC QUERY ================
  public function getAnimeListByAnimeClientID($aid, $cid){
    $this->db->query('SELECT * FROM '.$this->table.' 
    WHERE anime_id = '.$aid.' AND client_id = '.$cid);
    return ($this->db->fetchData());
    // return true if there is a row, otherwise false
  }

  public function getAverageUserScoreByClientID($id){
    $this->db->query('SELECT AVG(user_score) AS avg FROM '.$this->table.' WHERE client_id = '.$id);
    return $this->db->fetchData();
  }

  public function getCountAnimeByClientID($id){
    $this->db->query('SELECT COUNT(anime_id) as count FROM '.$this->table.' WHERE client_id = '.$id);
    return $this->db->fetchData();
  }

  public function getAnimeListAndAnimeByClientID( $cid){
    $this->db->query('SELECT a.title, a.image, l.list_id, l.user_score, l.watch_status, l.review  FROM '.$this->table.' l 
    JOIN anime a ON l.anime_id = a.anime_id 
    WHERE l.client_id = '.$cid);
    return ($this->db->fetchAllData());
    // return true if there is a row, otherwise false
  }


  

}