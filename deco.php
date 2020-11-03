<?php
session_start();
$_SESSION = array();
session_destroy();
session_start();
$_SESSION['idredacteur'] = 0;
$_SESSION['nom']="";
$_SESSION['prenom']="";
$_SESSION['erreur']="";
header("Location: accueil.php");
?>