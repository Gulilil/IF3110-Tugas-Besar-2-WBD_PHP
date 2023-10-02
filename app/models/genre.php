<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('database.php');

class Genre {
  private $table = 'genre';
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getAllGenre(){
    $this->db->query('SELECT * FROM '.$this->table);
    return $this->db->fetchAllData();
  }

  public function getGenreByID($id){
    $this->db->query('SELECT * FROM ' . $this->table . 'WHERE genre_id = ' . $id);
    return $this->db->fetchData();
  }

  public function getAllGenreIDByAnimeID($id){
    $this->db->query('SELECT '.$this->table.'.genre_id FROM ' . $this->table . ' JOIN anime_genre ON '.$this->table.'.genre_id = anime_genre.genre_id JOIN anime ON anime_genre.anime_id = anime.anime_id WHERE anime.anime_id = '.$id);
    return $this->db->fetchAllData();
  }

  public function insertGenre($name){
    $this->db->query('INSERT INTO ' . $this->table . ' (name) VALUES ('.$name.')');
    $this->db->execute();
    return ($this->db->countRow() == 1);
    // if countRow != 1, query fails
  }

  public function updateGenre($data){
    $this->db->query('UPDATE ' . $this->table . 'SET name = '. $data['name']. ' WHERE genre_id = '. $data['genre_id']);
    $this->db->execute();
    return ($this->db->countRow() == 1);
    // if countRow != 1, query fails
  }

  public function deleteGenre($id){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE genre_id = '. $id);
    $this->db->execute();
    return ($this->db->countRow() == 1);
    // if countRow != 1, query fails
  }

}