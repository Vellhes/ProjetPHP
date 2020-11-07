<?php

session_start();

        $id_redacteur = $_SESSION['idredacteur'];
        $nom =$_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        $erreur = $_SESSION['erreur'];

?>


<html>
<head>
<title>MOSELLE INFO</title>
<link rel="stylesheet" href="accueilstylee.css" />
<link rel="icon" href="images/logo.png"/>
</head>
<body>
    <header>
    <a href=accueil.php><div class="bouton"><img src="images/home.png" alt="accueil" style="width:23px ; height:23px" align="left" ></a>
    <a href=connexion.php style="float: right" id="con"> Connexion   </a> 
    <a style="float: right" href=inscription.php id="iscri"> Inscription &nbsp &nbsp </a>

    </div>
    <div>
    
    <?php
    if($id_redacteur != 0){
        echo '<a href=deco.php><div class="bouton"><img src="images/deconnexion.png" alt="deconnexion" style="width:23px ; height:23px" align="left" > 
        </div></a>';
        echo "Redacteur : ".$nom." ".$prenom;
    }
    else{
        echo"Non connecté";
    }
    ?>
    </div>
    </header>
    <h1>MOSELLE INFO</h1>
    <div id="back">
    <article id="bienvenue">
    <p>Bienvenue sur le site des actualités de Moselle.</P>
    </article>
    <article>
    <div id="accueil">
    <a href=news.php> Actualités </a><br/><br/>
    <a href=redaction.php> Ecrire un nouvel article </a><br/><br/>
    <?php
        echo '<p class="erreur">'.$erreur.'</p>';
    ?>
    <br/><br/><br/><br/>
    </article>
    <article id=pres>
        <p>Ce site vous est présenté par SCANU Antoine et BEHR Malo, étudiants en informatique de l'université de Metz,
           dans le cadre de leurs apprentissage du développement en web avancé</p>
    </article>
    </div>
    </div>
    </body>
</html>