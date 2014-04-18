<?php
// est-ce que ça change qqchose
// 
// include("vues/comptable/v_sommaire_comptable.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idVisiteur'];
$idvar="ça ne sert à rien";
if (isset($_REQUEST['lstVisiteur'])&& isset($_REQUEST['mois'])) {
     $visiteurASelectionner = $_REQUEST['lstVisiteur'];
     $moisASelectionner = $_REQUEST['mois'];
     $lesVisiteurs=$pdo->getLesVisiteurs();
     include("vues/comptable/v_listeVisiteurs.php");
     // ici je rajoute un commmentaire
     // au retour de la vue, on r�cup�re les donn�es
     $visiteurASelectionner = $_REQUEST['lstVisiteur'];     
     $moisASelectionner = $_REQUEST['mois'];
     $lesVisiteurs=$pdo->getLesVisiteurs();
     
     $leMois = substr($moisASelectionner,3,4).substr($moisASelectionner,0,2);
     $leVisiteur = $pdo->getNomPrenomVisiteur($visiteurASelectionner); // faire un parcours de la collection $lesVisiteur pr�f�rable plut�t que acc�s pdo ?
     $nom = $leVisiteur['nom'];
     $prenom = $leVisiteur['prenom'];
}

switch($action){
    
        case 'selectionnerVisiteur':{
                $lesVisiteurs=$pdo->getLesVisiteurs();
                //La vue va afficher la liste d�roulante des visiteurs.
                $lesCles = array_keys($lesVisiteurs);
                $visiteurASelectionner  = $lesCles[0];
                // lise des mois
                $numMois = date('m');
                $jour = date("d");
                $numAnnee = date("Y");
                if ($jour > 10) {
                } else {
                    if ($numMois == 1) {
                        
                        $numAnnee --;
                        $numMois = 12;
                       
                    } else {
                         $numMois--;
                    }              
                }
                $moisASelectionner = $numMois."/".$numAnnee; 
                $mois=$numAnnee.$numMois;
                include("vues/comptable/v_listeVisiteurs.php");
		break;
	}
        case 'validerFraisForfait':{
		$lesFraisForfait= $pdo->getLesFraisForfait($visiteurASelectionner,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($visiteurASelectionner,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
               
		include("vues/comptable/v_validerFraisForfait.php");
                break;
        }
               
        case 'OKvaliderFraisForfait' :{
                $lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
                        $pdo->majFraisForfait($visiteurASelectionner,$leMois,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
                
            break;
        }
        
	case 'validerEtatFraisVisiteur':{
		
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($visiteurASelectionner,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($visiteurASelectionner,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($visiteurASelectionner,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/comptable/v_validerFrais.php");
	}
}
?>