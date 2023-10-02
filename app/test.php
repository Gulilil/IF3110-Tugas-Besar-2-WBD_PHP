<?php

require_once('models/relationship.php');
require_once('models/client.php');

$r = new Relationship();

$test = $r -> getMutualRelationship(1,3);
if ($test){
  echo $test['client_id_2'];
  echo 'bisa';
} else {
  echo 'ga ada';
}

// if ($r->deleteRelationship(1)){
//   echo 'bisa';
// } else {
//   echo 'ga bisa';
// }
