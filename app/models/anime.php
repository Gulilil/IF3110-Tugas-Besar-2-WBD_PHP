<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('Database.php');

class Anime {
  private $table = 'anime';
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getAllAnime(){
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->fetchAllData();
  }

  public function getAllAnimeByStudioID($id){
    $this->db->query('SELECT * FROM '.$this->table.' WHERE studio_id = '.$id);
    return $this->db->fetchAllData();
  }

  public function getAnimeByID($id){
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE anime_id = ' . $id);
    return $this->db->fetchData();
  }

  public function getAllAnimeBySearch($string){
    $this->db->query('SELECT * FROM ' . $this->table . " WHERE title LIKE '%".$string."%'");
  }

  public function getAllAnimeIDByGenreID($id){
    $this->db->query('SELECT '.$this->table.'.anime_id FROM ' . $this->table . ' JOIN anime_genre ON '.$this->table.'.anime_id = anime_genre.anime_id JOIN genre ON anime_genre.genre_id = genre.genre_id WHERE genre.genre_id = '.$id);
    return $this->db->fetchAllData();
  }

  public function insertAnime($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('INSERT INTO ' . $this->table . ' (title, type, status, release_date, episodes, rating, score, image, trailer, synopsis, studio_id) VALUES ('.$data['title'].','.$data['type'].','.$data['status'].','.$data['release_date'].','.$data['episodes'].','.$data['rating'].','.$data['score'].','.$data['image'].','.$data['trailer'].','.$data['synopsis'].','.$data['studio_id'].')');
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function updateAnime($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('UPDATE ' . $this->table . 'SET title = '.$data['title'].', type = '.$data['type'].', status = '.$data['status'].', release_date = '.$data['release_date'].', episodes = '.$data['episodes'].', rating = '.$data['rating'].', score = '.$data['score'].', image = '.$data['image'].', trailer = '.$data['trailer'].', synopsis = '.$data['synopsis'].', studio_id = '.$data['studio_id'].' WHERE anime_id = '. $data['anime_id']);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function deleteAnime($id){
    $this->db->query('DELETE FROM ' . $this->table . ' WHERE anime_id = '. $id);
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }


  // ======== SPECIFIC QUERY ========== 
  public function getTop5AnimeScore(){
    $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY score DESC LIMIT 5');
    return $this->db->fetchAllData();
  }

  public function getTop4AnimeLatest(){
    $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY release_date DESC LIMIT 4');
    return $this->db->fetchAllData();
  }

  public function getTop4AnimeUpcoming(){
    $this->db->query('SELECT * FROM '.$this->table." WHERE status = 'UPCOMING' ORDER BY score DESC LIMIT 4");
    return $this->db->fetchAllData();
  }

  public function getAllAnimeWithTrailer(){
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE NOT trailer IS NULL ORDER BY release_date DESC');
    return $this->db->fetchAllData();
  }

  public function get5LatestAnimeReview(){
    $this->db->query('SELECT a.anime_id, a.title, c.client_id, c.username, l.user_score, l.review 
      FROM anime_list l JOIN '.$this->table.' a ON l.anime_id = a.anime_id JOIN client c ON l.client_id = c.client_id 
      WHERE NOT review IS NULL
      ORDER BY l.list_id DESC 
      LIMIT 5');
    return $this->db->fetchAllData();
  }

  public function get4RandomAnimeRecommendation(){
    $data = $this->getAllAnime();
    $result = array ();
    for($i = 0; $i < 4; $i++ ){
      array_push($result, $data[rand(0, count($data)-1)]);
    }
    return $result;
  }

  public function getReviewsByAnimeID($id){
    $this->db->query('SELECT a.anime_id, a.title, c.client_id, c.username, l.watch_status, l.user_score, l.review 
    FROM anime_list l JOIN '.$this->table.' a ON l.anime_id = a.anime_id JOIN client c ON l.client_id = c.client_id 
    WHERE NOT review IS NULL AND a.anime_id = '.$id);
    return $this->db->fetchAllData();
  }

  public function getAverageAnimeScoresByStudioID($id){
    $this->db->query('SELECT AVG(score) AS avg FROM '.$this->table.' WHERE studio_id = '.$id);
    return $this->db->fetchData();
  }

}