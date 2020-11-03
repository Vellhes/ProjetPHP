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
<meta charset="UTF-8">
<title>Connexion</title>
<head>
<center>
<body>
    <h1>Connexion</h1>
    <form method="post" action="">
        e-mail : <input type="email" size="20" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"><br/><br/>
        Mot de passe : <input type="password" size="20" name="mdp"><br/><br/>
        <input type="submit" value="Valider" name="Valider"><br/>  
    </form>
    Vous n'êtes pas inscrit ? Cliquez <a href="inscription.php">ici</a>
    <?php
    if(isset($erreur)){
        echo '<font color=red>'.$erreur.'</font>';
    }
    ?>
</body>
</center>
</html>
