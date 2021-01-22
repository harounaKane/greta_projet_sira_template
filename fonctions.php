<?php
session_start();

include "modele/modele_generique.php";
include "modele/modele_vehicule.php";
include "modele/modele_membre.php";


function isConnected(){
  if( isset($_SESSION['membre']) ){
    return true;
  }
  return false;
}

function isAdmin(){
 if( isConnected() && $_SESSION['membre']['statut'] == 1 ){
  return true;
 }
 return false;
}



function loadImage($destination, $name){
  //taille autorisée
  if( $_FILES['photo']['size'] <= 20000 ){
    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'];
    $info = pathinfo($_FILES['photo']['name']);

    if( in_array($info['extension'], $extensions) ){
     $root = "public/images/".$destination.'/'.$name.'.'.$info['extension'];
     //déplacement de l'image
     move_uploaded_file($_FILES['photo']['tmp_name'], $root);
     return $name.'.'.$info['extension'];
   }
 }
}


function nombreJour($debut, $fin){
  $dd = strtotime($debut);
  $df = strtotime($fin);
  $nbjTimeStamp = $df - $dd;

  return $nbjTimeStamp/86400 + 1; //86400 = 60*60*24;
}


function existes($table, $colonne, $valeur){
  $req = executeRequete("SELECT * FROM $table  WHERE $colonne = ?", [$valeur]);
  $res = $req->fetch();

  if( $res[$colonne] == $valeur ){
    return true;
  }
  return false;
}


function enLocation($id_vehicule){
  $dateActuelle = date("Y-m-d");
  $resultat = executeRequete("SELECT id_vehicule
        FROM  commande
        WHERE id_vehicule = :id_v
        AND date_heure_fin >= :dactuelle", ["id_v" => $id_vehicule, "dactuelle" => $dateActuelle]);

  if( $resultat->rowCount() != 0 ){
    return true;
  }else{
    return false;
  }
}
