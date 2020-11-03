<?php

session_start();

        $id_redacteur = $_SESSION['idredacteur'];
        $nom =$_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        $erreur = $_SESSION['erreur'];

?>


<html>
<head>
<title>Accueil</title>
</head>
<body>
    <header>
    <a href=accueil.php><div class="bouton"><img src="home.png" style="width:20px; height:20px" align="left"> 
    </div></a>
    <div>
    <?php
    if($id_redacteur != 0){
        echo '<a href=deco.php><div class="bouton"><img src="deconnexion.png" style="width:20px; height:20px" align="left"> 
        </div></a>';
        echo "Redacteur : ".$nom." ".$prenom;
    }
    else{
        echo"Non connecté";
    }
        
    ?>
    </div>
    </header>
    <div id="accueil">
    <h1>Accueil</h1>
    <a href=news.php>News</a><br/><br/>
    <a href=inscription.php>Inscription</a><br/><br/>
    <a href=connexion.php>Connexion</a><br/><br/>
    <a href=redaction.php>Nouvel article</a><br/><br/>
    <?php
        echo '<font color=red>'.$erreur.'</font>';
    ?>
    </div>
</body>
</html>

<style>

header{
    margin : 0;
    padding : 10;
    color : white;
    background-color : black;
}

#accueil{
    text-align : center;
}

</style>