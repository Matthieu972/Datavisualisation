<?php
    //connexion à la BDD
    include("../bdd/connexion_bdd.php");

    //on lance la requête
    $query = "SELECT classe.nom FROM personnage, classe
              WHERE personnage.classe = classe.id";
    $result = mysqli_query($conn, $query);

    //on déclare les variables pour le tableau de retour
    $result_request = array();
    $Guerr_cpt = 0;
    $pret_cpt = 0;
    $chasse_cpt = 0;
    $mage_cpt = 0;
    $druide_cpt = 0;
    $vol_cpt = 0;
    $inge_cpt = 0;
    $moine_cpt = 0;
    $ninja_cpt = 0;
    $paladin_cpt = 0;


    while ($row = mysqli_fetch_array($result)){
        $classe = $row[0];
        switch ($classe){
            case 'Guerrier':
                $Guerr_cpt++;
                break;
            case 'Prêtre':
                $pret_cpt++;
                break;
            case 'Chasseur':
                $chasse_cpt++;
                break;
            case 'Mage':
                $mage_cpt++;
                break;
            case 'Druide':
                $druide_cpt++;
                break;
            case 'Voleur':
                $vol_cpt++;
                break;
            case 'Ingénieur':
                $inge_cpt++;
                break;
            case 'Moine':
                $moine_cpt++;
                break;
            case 'Ninja':
                $ninja_cpt++;
                break;
            case 'Paladin':
                $paladin_cpt++;
                break;
        }
    }

    $result_request[] = array("Guerriers", intval($Guerr_cpt));
    $result_request[] = array("Prêtre", intval($pret_cpt));
    $result_request[] = array("Chasseur", intval($chasse_cpt));
    $result_request[] = array("Mage", intval($mage_cpt));
    $result_request[] = array("Druide", intval($druide_cpt));
    $result_request[] = array("Voleur", intval($vol_cpt));
    $result_request[] = array("Ingénieur", intval($inge_cpt));
    $result_request[] = array("Moine", intval($moine_cpt));
    $result_request[] = array("Ninja", intval($ninja_cpt));
    $result_request[] = array("Paladin", intval($paladin_cpt));

    mysqli_free_result($result);

    //Déconnexion de la BDD
    include("../bdd/deconnexion_bdd.php");

    //conversion des données
    echo json_encode($result_request);
?>