<?php
    try{
        $objPdo = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=behr41u_PHP',
        'behr41u_appli', 'antoine' ); 
    } 
    catch( Exception $exception){ 
        die($exception->getMessage());
    }

    if(isset($_GET['Valider'])) {
        $nom = htmlspecialchars($_GET['nom']);
        $prenom = htmlspecialchars($_GET['prenom']);
        $mail = htmlspecialchars($_GET['mail']);
        $mdp = htmlspecialchars($_GET['mdp']);
        $mdp2 = htmlspecialchars($_GET['mdp2']);
    }

    if(!empty($_GET['nom']) AND !empty($_GET['prenom']) AND !empty($_GET['mail']) AND !empty($_GET['mdp']) AND !empty($_GET['mdp2'])){
        $longueur_prenom = strlen($prenom)
    }
    
?>

<html>
<head>
<title>Inscription</title>
<head>
<body>
    <h1>Inscription</h1>
    <form method="get" action = "creation_compte.php">
                Nom : <input type="text" size="20" name="nom"><br/><br/>
                Prénom : <input type="text" size="20" name="prenom"><br/><br/>
                e-mail : <input type="text" size="20" name="mail"><br/><br/>
                Mot de passe : <input type="password" size="20" name="mdp"><br/><br/>
                Valider le mot de passe : <input type="password" size="20" name="mdp2"><br/><br/>
    <input type="submit" value="Valider">
</body>
</html>
