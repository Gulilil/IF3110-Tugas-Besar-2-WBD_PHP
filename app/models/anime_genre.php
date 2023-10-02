<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('database.php');

class Anime_Genre {
  private $table = 'anime_genre';
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getAllAnimeGenre(){
    $this->db->query('SELECT * FROM '.$this->table);
    return $this->db->fetchAllData();
  }

  public function getAnimeGenreByID($id){
    $this->db->query('SELECT * FROM '.$this->table.' WHERE anime_genre_id = '. $id);
    return $this->db->fetchData();
  }

  public function insertAnimeGenre($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('INSERT INTO '.$this->table. ' (anime_id, genre_id) VALUES ('. $data['anime_id'].','.$data['genre_id'].')');
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function updateAnimeGenre($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('UPDATE ' . $this->table . 'SET anime_id = '.$data['anime_id'].', genre_id = '.$data['genre_id'].' WHERE anime_genre_id = '. $data['anime_genre_id']);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function deleteAnimeGenre($id){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE anime_genre_id = '. $id);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }
}