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
	
	// On récupère les ids des persos
	$query = "SELECT id, niveau FROM personnage";
	$result = mysqli_query($conn, $query);
	$ids_personnage = array();
	
	// On parcourt les résultats et on effectue les traitements sur les données.
	while ($row = mysqli_fetch_array($result)) {
		$ids_personnage[] = array($row[0], $row[1]);
	}
	
	// On récupère les niveaux des boss et leur ID.
	$query = "SELECT id, niveau FROM boss";
	$result = mysqli_query($conn, $query);
	$donjeons_level = array();
	
	// On parcourt les résultats et on effectue les traitements sur les données.
	while ($row = mysqli_fetch_array($result)) {
		$donjeons_level[] = array($row[0], $row[1]);
	}
	
	$query = "SELECT MAX(id) FROM combat";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$max = $row[0] + 1;
	
	foreach($ids_personnage as $perso_id) {
		$nb_donjons_done = rand(1, 3);
		
		for($i = 0; $i < $nb_donjons_done; $i++) {
			$difficulte_donjeon = rand(1,5);
			$nombre_mort = rand(1,10);
			$isBossDead = rand(0, 1);
			$niveau_test = $perso_id[1] + 10;
			$date = rand(strtotime("2017-01-01"), strtotime("2017-06-01"));
			$date_random = date("Y-m-d",$date);
			
			$test_OK_niveau = false;
			
			do {
				$donjon_rand = rand(0, count($donjeons_level) - 1);
				$donjon_id = $donjeons_level[$donjon_rand][0];
				
				$test_OK_niveau = ($donjeons_level[$donjon_rand][1] < $niveau_test);
			} while(!$test_OK_niveau);
			
			$query = "INSERT INTO combat (`id`, `perso`, `donjon`, `difficulte`, `nombre_de_mort`, `date`, `isBossDead`) VALUES('".$max."', '".$perso_id[0]."', '".$donjon_id."', '".$difficulte_donjeon."', '".$nombre_mort."', '".$date_random."', '".$isBossDead."')";
			$max++;
			echo "<pre>";
			print_r($query);
			echo "</pre>";
			mysqli_query($conn, $query);
		}
	}
	// Déconnexion de la BDD
	include("bdd/deconnexion_bdd.php");
?>