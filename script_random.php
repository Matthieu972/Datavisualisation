<?php
	/* 
		Si la base actuelle de personnages ne vous convient pas, n'hésitez pas à rejouer ce script.
		Ceci dit... l'intérêt du TP est ailleurs !
		
		Ce script va insérer des valeurs en base de manière random pour la table personnage.
		Veuillez vider la table avec un DROP avant de ré-utiliser ce script.
		Les soucis d'encodage peuvent bloquer l'insertion.
		Si cela se produit, remplacez les accents par des caractères normaux dans le fichier texte.
	*/
	// Connexion à la BDD
	include("bdd/connexion_bdd.php");
	
	// On va lire le fichier => liste_promo_random.txt ligne par ligne.
	$lines = file('liste_promo_random.txt');
	
	/*On parcourt le tableau $lines et on affiche le contenu de chaque ligne précédée de son numéro*/
	$cpt = 0;
	foreach ($lines as $line) {
		$cpt++;
		$tab_line = explode(" ", $line);
		
		$query = "INSERT INTO personnage (`id`, `nom`, `prenom`, `sexe`, `niveau`, `classe`, `race`, `or`, `nombre_quete_finies`, `nombre_monstre_tues`) VALUES('".$cpt."', '".$tab_line[0]."', '".$tab_line[1]."', '".trim($tab_line[2])."', '".rand(1, 100)."', '".rand(1, 10)."', '".rand(1, 8)."', '".rand(1, 1000)."', '".rand(1, 500)."', '".rand(1, 1000)."')";
		mysqli_query($conn, $query);	
	}	
	// Déconnexion de la BDD
	include("bdd/deconnexion_bdd.php");
?>