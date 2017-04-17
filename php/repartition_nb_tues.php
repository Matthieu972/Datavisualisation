<?php

    // Connexion à la BDD
    include("../bdd/connexion_bdd.php");

    //requête
    $query = "SELECT nombre_monstre_tues, niveau FROM personnage";
    $result = mysqli_query($conn, $query);

    $result_request = array();
    $nb_tues_1 = 0;
    $nb_tues_2 = 0;
    $nb_tues_3 = 0;
    $nb_tues_4 = 0;
    //nombre de monstres tués

    $niveau = 0;
    //attribuer le niveau du personnage

    while ($row = mysqli_fetch_array($result))
    {
        $niveau = $row['niveau'];

        if ($niveau >= 1 and $niveau <= 25)
        {
            $nb_tues_1 += $row['nombre_monstre_tues'];
        }

        if ($niveau >= 26 and $niveau <= 50)
        {
            $nb_tues_2 += $row['nombre_monstre_tues'];
        }

        if ($niveau >= 51 and $niveau <= 75)
        {
            $nb_tues_3 += $row['nombre_monstre_tues'];
        }

        if ($niveau >= 76 and $niveau <= 100)
        {
            $nb_tues_4 += $row['nombre_monstre_tues'];
        }
    }

    $result_request[] = array("1-25", intval($nb_tues_1));
    $result_request[] = array("26-50", intval($nb_tues_2));
    $result_request[] = array("51-75", intval($nb_tues_3));
    $result_request[] = array("76-100", intval($nb_tues_4));

    mysqli_free_result($result);

    // Déconnexion de la BDD
    include("../bdd/deconnexion_bdd.php");

    // On encode en JSON le tableau de résultats pour l'envoyer au javascript.
    echo json_encode($result_request);
    ?>
