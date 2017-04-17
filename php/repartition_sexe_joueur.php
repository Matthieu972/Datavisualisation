<?php
	// Connexion à la BDD
	include("../bdd/connexion_bdd.php");
	
	// On lance la requête
	$query = "SELECT sexe FROM personnage t";
	$result = mysqli_query($conn, $query);
	
	// On déclare les variables pour le tableau de retour.
	$result_request = array();
	$masculin_cpt = 0;
	$feminin_cpt = 0;
	
	// On parcourt les résultats et on effectue les traitements sur les données.
	while ($row = mysqli_fetch_array($result)) {
		$sexe = $row[0];
		if($sexe == 1) {
			$feminin_cpt++;
		}
		else $masculin_cpt++;
	}
	// On remplit le tableau de retour.
	$result_request[] = array("Personnages Masculins", intval($masculin_cpt));
	$result_request[] = array("Personnages Féminins", intval($feminin_cpt));

	mysqli_free_result($result);
	
	// Déconnexion de la BDD
	include("../bdd/deconnexion_bdd.php");
	
	// On encode en JSON le tableau de résultats pour l'envoyer au javascript.
	echo json_encode($result_request);
?>