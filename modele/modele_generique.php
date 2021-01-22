<?php

function bd(){
  $pdo = new PDO("mysql:host=localhost;dbname=greta_projet_sira", "root", '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
  $pdo->exec("SET NAMES utf8");
  return $pdo;
}

//liste
function getAll($table){

  $recup = executeRequete("SELECT * FROM ".$table);

  return $recup->fetchAll();
}


function executeRequete($query, $params = array()){

  $res = bd()->prepare($query);
  if ( !empty($params) ) {
    foreach ($params as $key => $value) {
      $params[$key] = htmlentities($value);
    }
  }
  $res->execute($params);

  return $res;
}
