<?php

// include 'modele_generique.php';

function liste(){
  $vehicules = executeRequete("SELECT v.*, a.titre as titre_ag
                                FROM vehicule as v, agence as a
                                WHERE a.id_agence = v.id_agence");

  return $vehicules->fetchAll();
}


function listeMembre(){
  $membres = executeRequete("SELECT *
                                FROM membre");
  return $membres->fetchAll();
}
