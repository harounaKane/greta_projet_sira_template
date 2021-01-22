<?php
include 'fonctions.php';


try{
  if( isset($_GET['action']) ){
  $action = $_GET['action'];

  switch ($action) {
    case 'membre':
       $liste = listeMembre();
       render("vue_membre", ["liste" => $liste, "title" => "Membre"]);
       // include 'vues/vue_membre.php';
       break;
    case 'inscription':
       render("vue_inscription");
       break;
    case 'connexion':
       render("vue_connexion");
       break;
    case 'logOut':
      session_destroy();
      header("location: .");
      break;
    default:
      echo "erreur 404";//page 404.php Ecrire la vue
      break;
    }

  }else{
    $vehicules = liste();
    render('vue_listeVehicule', ["vehicules" => $vehicules, "title" => "Accueil"]);
  }

  if( isset($_POST['inscription']) ){
    //traitememnt des données du formulaire...
    $ins = insertMembre($_POST);
    if($ins){
      $_SESSION['message'] = "inscription OK";
      header("Location: index.php?action=connexion");
      exit;
    }
  }
  if( isset($_POST['connexion']) ){
    $connect = connexion($_POST['pseudo'], $_POST['mdp']);
    // if( $connect ){
    //   header("Location: index.php");
    //    exit;
    // }else{
    //   $_SESSION['message'] = "connexion failled";
    // }
  }

}catch(Exception $e){
  echo $e->getmessage(); //Ecrire la vue
}

function render($vue, $params = array()){
  !empty( $params ) ? extract($params) : '';

  $page =  "vues/".$vue.".php";

  if( !file_exists($page) ){
    throw new Exception("Cette page n'existe pas !");
  }
  ob_start();
  include $page;
  $content = ob_get_clean();
  include 'vues/template.php';
}
