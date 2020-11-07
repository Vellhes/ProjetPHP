<?php
    date_default_timezone_set("Europe/Paris");

    session_start();
        $id_redacteur = $_SESSION['idredacteur'];
        $nom =$_SESSION['nom'];
        $prenom = $_SESSION['prenom'];

    if($id_redacteur==0){
        $_SESSION['erreur']="Veuillez vous connecter afin d'écrire un nouvel article";
        header("Location: accueil.php");
    }

    $SQL = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=behr41u_PHP','behr41u_appli', 'antoine' ); 

    if(isset($_POST['Publier'])) {
        $titre = htmlspecialchars($_POST['titre']);
        $idtheme = intval($_POST['theme']);
        $text = htmlspecialchars($_POST['textnews']);
        $date = date("Y-m-d H:i:s");
        if(!empty($_POST['titre']) AND !empty($_POST['textnews'])){
            $longueur_titre = strlen($titre);
            if($longueur_titre <= 255){
                $create = $SQL -> prepare("INSERT INTO news(idnews, idtheme, titrenews, datenews, textenews, idredacteur) VALUES (NULL,?,?,?,?,?);");
                $create -> execute(array($idtheme,$titre,$date,$text,$id_redacteur));
                $erreur = "Votre article a bien été publié.";
            }
            else{
                $erreur = "Titre trop long (plus de 255 caractères)";
            }
        }
        else{
            $erreur = "Champ(s) Vide(s)";
        }
    }

?>
<html>
<head>
<link rel="icon" href="images/logo.png"/>
<link rel="stylesheet" href="style/redactionstyle.css" />
<meta charset="UTF-8">
<title>MOSELLE INFO</title>
</head>
<body>
    <header>
    <a href=accueil.php><div class="bouton"><img src="images/home.png" style="width:20px; height:20px" align="left"> 
    </div></a>
    <div>
    <?php
    if($id_redacteur != 0){
        echo '<a href=deco.php><div class="bouton"><img src="images/deconnexion.png" style="width:20px; height:20px" align="left"> 
        </div></a>';
        echo "Redacteur : ".$nom." ".$prenom;
    }
    else{
        echo"Non connecté";
    }
        
    ?>
    </div>
    
    </header>
    <div id="redac">
    <h1>Rédaction</h1>
    <?php
    if(isset($erreur)){
        echo '<font color=red>'.$erreur.'</font>';
    }
    ?>
    <form method="post" action="redaction.php">
        Titre : <input type="text" size="20" name="titre" value="<?php if(isset($titre)) {echo $titre;} ?>"/><br/><br/>
        Theme : <select name="theme">
            <?php
                $theme = $SQL -> query("SELECT * from theme");
                while($row=$theme->fetch()){
                    echo"<option value=".$row['idtheme'].">".$row['description']."</option>";
                }
            ?>
        </select><br/><br/>
        <textarea name="textnews" rows="100" cols="100"></textarea><br/><br/>
        <input type="submit" class="brille" value="Publier" name="Publier"><br/>
    </form>
    </div>
</body> 
</html>
<style>

#redac {
    text-align : center;
}

header{
    margin : 0;
    padding :10;
    color : white;
    background-color : black;
}




</style>
