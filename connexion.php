 <?php
session_start();

        $id_redacteur = $_SESSION['idredacteur'];
        $nom =$_SESSION['nom'];
        $prenom = $_SESSION['prenom'];

        if($id_redacteur>0){
            $_SESSION['erreur']="Vous êtes déjà connecté";
            header("Location: accueil.php");
        }

    $SQL = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=behr41u_PHP','behr41u_appli', 'antoine' ); 

    $SQL->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['Valider'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars($_POST['mdp']);

        if(!empty($_POST['mail']) AND !empty($_POST['mdp'])){
            $verif = $SQL -> prepare("SELECT * FROM redacteur WHERE adressemail = ? AND motdepasse = ?");
            $verif -> execute(array($mail,$mdp));
            $veriflength = $verif -> rowCount();
            if($veriflength == 1){
                $user = $verif ->  fetch();
                $_SESSION['idredacteur'] = $user['idredacteur'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['erreur']="";
                header("Location: accueil.php");
            }
            else{
                $erreur = "adresse mail ou mot de passe incorrect";
            }
        }
        else{
            $erreur = "champ(s) vide(s)";
        }
    }
?>
<html>
<head>
		<meta charset="utf-8" />
		<title>MOSELLE INFO</title>
        <link rel="stylesheet" href="style/connexionstyle.css" />
        <link rel="icon" href="images/logo.png"/>
        <meta name="viewport"  content="width=max-device-width, initial-scale=1" />
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
<meta charset="UTF-8">
<title>Connexion</title>
<center>

    <h1>Connexion</h1>
    <div id="back">
    <form method="post" action="">
        Adresse mail : <input type="email" size="20" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"><br/><br/>
        Mot de passe : <input type="password" size="20" name="mdp"><br/><br/>
        <input type="submit" class="brille" value="Valider" name="Valider"><br/>  
    </form>
    <article>Vous n'êtes pas encore inscrit ? <a href="inscription.php">Cliquez ici</a></article>
    <?php
    if(isset($erreur)){
        echo '<font color=red>'.$erreur.'</font>';
    }
    ?>
    
</center>
</div>
</body>
</html>
<style>

