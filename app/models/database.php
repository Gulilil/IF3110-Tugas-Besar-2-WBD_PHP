<?php

require_once(dirname(__DIR__,1).'/setup/setup.php');

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

  function makeDBString($string){
    return "'".$string."'";
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
    return $this->statement->fetch();
  }

  public function fetchAllData(){
    $this->execute();
    return $this->statement->fetchAll();
  }

  public function countRow(){
    return $this->statement->rowCount();
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
      return $this->makeDBString($input);
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
      echo "Migration Success \n";
    } catch (Exception $e){
      echo "Migration Failed \n";
    }
  }

  public function constraints(){
    try {
      $constraint_files = glob(dirname(__DIR__,1).'/database/constraints/*.sql');
      foreach($constraint_files as $constraint){
        $constraint_content = file_get_contents($constraint);
        $this->query($constraint_content);
        $this->execute();
      }
      echo "Adding Constraints Success \n";
    } catch (Exception $e) {
      echo "Adding Constraints Failed \n";
    }
  }


  public function resetSchema(){
    $this->query('DROP SCHEMA public CASCADE');
    $this->execute();
    $this->query('CREATE SCHEMA public');
    $this->execute();
    echo "Successfully reset schema \n";
  }
}