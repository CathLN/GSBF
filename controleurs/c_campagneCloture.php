<?php

include("vues/comptable/v_sommaire_comptable.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idVisiteur'];
// A priori, cette action se fait entre le 10 et le 20 du mois suivant
// Elle a pour but de cloturer des fiches du mois précédent
// et de créer une nouvelle fiche de frais pour le mois courant 
// affichage du mois
// 
switch ($action) {
    case 'afficherCloture' : {
            $numMois = date('m');
            $numAnnee = date("Y");
            if ($numMois == 1) {
                $numAnnee--;
                $numMois = 12;
            } else {
                $numMois--;
                if ($numMois < 10) {
                    $numMois = '0' . $numMois;
                }
            }
            $_SESSION['idMoisChoisi'] = $numAnnee . $numMois;
            $moisASelectionner = $numMois . '/' . $numAnnee;

            break;
        }
    case 'demarrerCloture' : {
        $leMois = $_REQUEST['mois'];
        $_SESSION['idMoisChoisi'] = substr($leMois,3,4).substr($leMois,0,2);
        $pdo->clotureLesFiches($_SESSION['idMoisChoisi']);
        $message = "Mise à jour effectuée";
            break;
        }
}
$leMois = $_SESSION['idMoisChoisi']; // format aaaamm
$numAnnee = substr($leMois, 0, 4);
$numMois = substr($leMois, 4, 2);
$moisASelectionner = $numMois . '/' . $numAnnee;

include("vues/comptable/v_cloture.php");
?>