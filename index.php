<?php
	// On initialise la session
	session_start();
	$captchacrypte="";

	if ( !empty($_POST['captcha']) ) {
		$captchacrypte = md5($_SESSION['captcha']);

		# On supprime la session pour éviter la récupération pour les robots
		$_SESSION['captcha'] = '';
	}
	
	# On prépare la liste de caractère a inséré dans le captcha
	$chaine = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	# On prépare le compteur de caractère
	$nb = 0;
	$chaine2= "";
	# On limite à 6 caractères
	while( $nb < 6 ) {

		# On tire un nombre au hazard
		$rand = rand(0,51);

		# On regarde à quelle lettre il correspond et on l'ajoute à la chaine
		$chaine2 .= $chaine[$rand];

		# On prépare pour la lettre suivante
		$nb++;
	}

	# Enfin on génère la session
	$_SESSION['captcha'] = $chaine2;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Captcha</title>
		<meta  charset="UTF-8" />
	</head>
	<body>
		<center>
			<h1>Captcha</h1>
			<img src="captcha.php" />
			<?php
				if ( $captchacrypte == md5($_POST['captcha']) AND !empty($_POST['captcha']) ) {
					echo "\t\t\t<B style=\"color : #00ff00;\">Vous avez réussi</b><br />\n";
				}
				else if ( !empty($_POST['captcha']) ) {
					echo "\t\t\t<B style=\"color : #ff0000;\">Vous avez echoué</b><br />\n";
				}
			?>
			<form method="post" action="index.php">
				Recopiez : <input type="text" name="captcha" size=6 maxlength=6 />
				<input type="submit" value="Valider" />
			</form>
		</center>
	</body>
</html>
