<?php

require_once(dirname(__DIR__,1).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');
require_once('Database.php');

class Studio {
  private $table = 'studio';
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  public function getAllStudio(){
    $this->db->query('SELECT * FROM '.$this->table.' ORDER BY studio_id');
    return $this->db->fetchAllData();
  }

  public function getStudioByID($id){
    $this->db->query('SELECT * FROM '.$this->table.' WHERE studio_id = '.$id);
    return $this->db->fetchData();
  }

  public function insertStudio($data){
    foreach($data as $key => $value){
      $data[$key] = $this->db->processDataType($value);
    }
    $this->db->query('INSERT INTO '.$this->table.'(name, description, established_date, image) VALUES ('.$data['name'].','.$data['description'].','.$data['established_date'].','.$data['image'].')');
    $this->db->execute();
    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }

  public function updateStudio($data){
    foreach($data as $key => $value){
        $data[$key] = $this->db->processDataType($value);
    }

    // Note: No single quotes around the values because processDataType is already adding them
    $this->db->query(
        'UPDATE ' . $this->table . ' SET name = ' . $data['name'] . ', 
        description = ' . $data['description'] . ', 
        established_date = ' . $data['established_date'] . ', 
        image = ' . $data['image'] . ' 
        WHERE studio_id = ' . $data['studio_id']
    );

    $this->db->execute();

    return ($this->db->countRow() != 0);
    // if countRow == 0, query fails
  }



  public function deleteStudio($id){
      $this->db->query('DELETE FROM ' . $this->table . ' WHERE studio_id = '. $id);
      $this->db->execute();
      return ($this->db->countRow() != 0);
      // if countRow == 0, query fails
  }

  // ========== SPECIFIC QUERY ==========
  
  public function getStudioByAnimeID($id){
    $this->db->query('SELECT '.$this->table.'.name FROM '.$this->table.' JOIN anime ON anime.studio_id = '.$this->table.'.studio_id WHERE anime.anime_id= '.$id);
    return $this->db->fetchData();
  }

  public function getTop5Studio(){
    $this->db->query('SELECT s.studio_id, s.name, s.description, s.established_date, s.image , AVG(score) AS avg FROM '.$this->table.' s JOIN anime a ON a.studio_id = s.studio_id GROUP BY s.studio_id ORDER BY AVG(score) DESC LIMIT 5');
    return $this->db->fetchAllData();
  }
}