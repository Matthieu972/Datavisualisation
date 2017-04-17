<!DOCTYPE html>
<html>
	<head>
		<title>Data Vizualisation - TP1 RPG</title>
        <?php include ('structure/header.php'); ?>
        <?php include ('structure/footer.php'); ?>
	</head>
	<body>
		<div id="content">
			<div class="answer">
				<h2>EXEMPLE : PIE CHART - Répartition du nombre de personnages par sexe</h2>
                <div class="plot" id="classeJ"></div>
				<div class="plot" id="example"></div>
                <div class="plot" id="monstretues"></div>
				<div class="explication">
					Ceci n'est qu'une représentation graphique du pourcentage de fille que l'on peut trouver dans une promo de filière informatique.<br/>
					Ceci vient du fait que je me suis servi du trombinoscope étudiant pour créer les entrées dans la base.<br/>
					Dans un vrai MMORPG, cette proportion est toutefois discutable !
				</div>
			</div>
		</div>
	</body>
</html>