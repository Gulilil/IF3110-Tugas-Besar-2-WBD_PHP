<?php

require_once(dirname(__DIR__,1).'/setup/setup.php');

function makeDBString($string){
  return "'".$string."'";
}

class Database {
  private $db;
  private $statement;
  public function __construct()
  {
    try{
      $db_host = POSTGRES_HOST;
      $db_name = POSTGRES_DB;
      $db_port = 5432;
      $db_user = POSTGRES_USER;
      $db_pass = POSTGRES_PASSWORD;
      $this->db = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
      die ($e->getMessage());
    }
  }

  public function query($query){
    $stmt = $this->db->prepare($query);
    $this->statement = $stmt;
  }

  public function execute(){
    $this->statement->execute();
  }

  public function fetchData(){
    $this->execute();
    return $this->statement->fetchAll(PDO:FETCH_ASSOC);
  }

  public function fetchAllData(){
    $this->execute();
    return $this->statement->fetch(PDO:FETCH_ASSOC);
  }

  public function countRow(){
    $this->statement->rowCount();
  }

  public function processDataType($input){
    if (is_null($input)){
      return 'NULL';
    }
    if (is_bool($input)){
      if ($input) return 'true';
      else return 'false';
    }
    if (is_string($input)){
      return makeDBString($input);
    } 
    return $input;
  }

  public function migrate(){
    try {
      $table_files = glob(dirname(__DIR__,1).'/database/tables/*.sql');
      foreach($table_files as $file){
        $file_content = file_get_contents($file);
        $this->query($file_content);
        $this->execute();
      }
      // // Ga jadi dipake karena checknya langsung pas create table
      // $constraint_files = glob(dirname(__DIR__,1).'/database/constraints/*.sql');
      // foreach($constraint_files as $file){
      //   $file_content = file_get_contents($file);
      //   $this->query($file_content);
      //   $this->execute();
      // }
      echo "Migration Success";
    } catch (Exception $e){
      echo "Migration Failed";
    }
  }
}