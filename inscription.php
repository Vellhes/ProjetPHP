<?php
        $SQL = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=behr41u_PHP','behr41u_appli', 'antoine' ); 

    if(isset($_POST['Valider'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $mdp2 = htmlspecialchars($_POST['mdp2']);
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){
        $longueur_prenom = strlen($prenom);
        $longueur_nom = strlen($nom);
        if($longueur_prenom <= 255){
            if($longueur_nom <= 255){
                $mailSQL = $SQL -> prepare("SELECT * FROM redacteur WHERE adressemail = ?");
                $mailSQL -> execute(array($mail));
                $mail_exist = $mailSQL ->rowCount();
                if($mail_exist == 0){
                    if($mdp==$mdp2){
                        $create = $SQL -> prepare("INSERT INTO redacteur(idredacteur, nom, prenom, adressemail, motdepasse) VALUES (NULL,?,?,?,?);");
                        $create -> execute(array($nom,$prenom,$mail,$mdp));
                        $erreur ="Votre compte a été créé avec succès";
                    }
                    else{
                        $erreur="Les deux mots de passe de correspondent pas";
                    }
                }
                else{
                    $erreur = "adresse e-mail déjà utilisée, veuillez en choisir une valide";
                }
            }
            else{
                $erreur = "Nom trop long, veuillez en entrer un faisant moins de 255 caractères";
            }
        }
        else{
            $erreur = "Prenom trop long, veuillez en entrer un faisant moins de 255 caractères";
        }
    }
    else{
        $erreur = "Champ(s) Vide(s)";
    }
    }
?>

<html>
<head>
<title>Inscription</title>
<head>
<body>
    <h1>Inscription</h1>
    <form method="post" action="creation_compte.php">
                Nom : <input type="text" size="20" name="nom" value="<?php if(isset($nom)) {echo $nom;} ?>"/><br/><br/>
                Prénom : <input type="text" size="20" name="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>"><br/><br/>
                e-mail : <input type="text" size="20" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"><br/><br/>
                Mot de passe : <input type="password" size="20" name="mdp"><br/><br/>
                Valider le mot de passe : <input type="password" size="20" name="mdp2"><br/><br/>

    <input type="submit" value="Valider" name="Valider"><br/>
    </form>
    <?php
    if(isset($erreur)){
        echo '<font color=red>'.$erreur.'</font>';
    }
    ?>
</body>
</html>
