<?php session_start();
header('type-content:text/html');
require __DIR__ . './db.php';

if (isset($_POST['ppr']) and isset($_POST['pwd'])) {
	if (isset($_POST['retenir'])) {
		if ($_POST['retenir'] == 'true')
			setcookie('ppr', $_POST['ppr'], time() + 365 * 24 * 3600, null, null, false, true);
		else if ($_POST['retenir'] == 'false')
			setcookie('ppr', '', time() - 3600);
	}
	$reponse = $bdd->prepare('SELECT ppr,password FROM Employé WHERE ppr=?  AND etat=\'admin\'');
	$reponse->execute(array($_POST['ppr']));

	if ($reponse->rowCount() != 0) {
		$donnes = $reponse->fetch();
		$ispasswordCorrect = password_verify($_POST['pwd'], $donnes['password']);
		if ($ispasswordCorrect) {
			$_SESSION['ppr_admin'] = $_POST['ppr'];
			$reponse2 = $bdd->prepare('SELECT chemin_image FROM Employé WHERE ppr=?');
			$reponse2->execute(array($_POST['ppr']));
			if ($donnes2 = $reponse2->fetch()) {
				setcookie('image_admin', $donnes2['chemin_image'], time() + 365 * 24 * 3600, null, null, false, true);
			}
			$reponse2->closeCursor();
			echo 'true';
		} else {
			echo 'false';
		}
	} else {
		echo 'false';
	}
}


$bdd = NULL;
