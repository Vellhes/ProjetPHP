<?php

$SQL = new PDO ('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=behr41u_PHP','behr41u_appli', 'antoine' );

session_start();

$id_redacteur = $_SESSION['idredacteur'];
$nom =$_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$_SESSION['erreur']="";

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>MOSELLE INFO</title>
        <link rel="stylesheet" href="style.css" />
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
		<h1>MOSELLE INFO</h1><br/><br/>
		<h1>Choisissez un thème</h1>
		<form method="post" action="news.php">
		<center><select name="theme">
            <?php
                $theme = $SQL -> query("SELECT * from theme");
                while($row=$theme->fetch()){
                    echo"<option value=".$row['idtheme'].">".$row['description']."</option>";
                }
            ?>
		</select><br/><br/>
		<input type="submit" value="Valider" name="Valider"><br/><br/>
		</center>
	<section id="gugu">
		<?php
			if(isset($_POST['Valider'])){
				$idtheme = intval($_POST['theme']);
				$news = $SQL -> prepare("SELECT * FROM news WHERE idtheme = ?");
				$news -> execute(array($idtheme));
				while($row=$news->fetch()){
					$idredac = $row['idredacteur'];
					$redacteur = $SQL -> prepare("SELECT * FROM redacteur WHERE idredacteur = ?");
					$redacteur -> execute(array($idredac));
					$redac = $redacteur -> fetch();
					echo"<div>
							<article>
								<h2>".$row['titrenews']."</h2>
								<p>".$row['textenews']."</p>
								<p>Par ".$redac['nom']." ".$redac['prenom']." le ".$row['datenews']."</p>
							</article>
						</div>";
				}
			}
    	?>		

	
</section>

</body>
</html>
<style>

header{
    margin : 0;
    padding : 10;
    color : white;
    background-color : black;
}


</style>