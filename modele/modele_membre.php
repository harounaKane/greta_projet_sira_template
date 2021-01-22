<?php

function insertMembre($data){
  extract($data);
  //$data['pseudo'] ....
  $sql = "INSERT INTO membre VALUES(NULL, :login, :mdp, :nom, :prenom, :mail, :sexe, 0, now())";
   $req = executeRequete($sql, [
    "login"   => $pseudo,
    "mdp"     => password_hash($mdp, PASSWORD_DEFAULT),
    "nom"     => $nom,
    "prenom"  => $prenom,
    "mail"    => $mail,
    "sexe"    => $civilite
  ]);
   return $req;
}


function connexion($login, $mdp){
   $sql = "SELECT * FROM membre WHERE pseudo = ?";
  $req = executeRequete($sql, [$login]);

  if($req->rowCount() != 0){

    $membre= $req->fetch();
    //test si mdp POST == mdp BD
    if( password_verify($mdp, $membre['mdp']) ){
      $_SESSION['membre'] = $membre;
      $_SESSION['message'] = "Connexion réussie !";
      header("location: index.php");
      exit;
    }else{
      $_SESSION['message'] = "Mot de pas incorrect !";
      header("location: index.php?action=connexion");
      exit;
    }
  }else{
    $_SESSION['message'] = "Login et/ou mot de passe incorrect !";
    header("location: index.php?action=connexion");
    exit;
  }
}
