<?php
include("vues/comptable/v_sommaire_comptable.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idVisiteur'];
$montant=0;
switch($action){
    
        case 'selectionnerVisiteur':{
                // Préparer la vue pour une premier affichage 
                
                $lesVisiteurs=$pdo->getLesVisiteurs();
                //La vue va afficher la liste déroulante des visiteurs.
                $lesCles = array_keys($lesVisiteurs);
                //$visiteurASelectionner  = $lesCles[0];
                $_SESSION['idVisiteurChoisi'] = $lesCles[0];
                // liste des mois
                $numMois = date('m');
                $jour = date("d");
                $numAnnee = date("Y");
                if ($jour > 10) {
                    } 
                else {
                    if ($numMois == 1) {
                        $numAnnee --;
                        $numMois = 12;
                        } 
                    else {
                         $numMois--;
                         if ($numMois < 10) {
                             $numMois = '0'.$numMois;
                         }
                    }              
                }
                $_SESSION['idMoisChoisi'] = $numAnnee.$numMois;
		break;
	}
        case 'validerChoixVisiteur':{
                // le mois et le visiteur ont été choisis. Mémorisation dans une variable de session
                // la variable de session contient le mois sous la forme aaaamm
            
                $leMois = $_REQUEST['mois'];
                $_SESSION['idMoisChoisi'] = substr($leMois,3,4).substr($leMois,0,2);
                $_SESSION['idVisiteurChoisi'] = $_REQUEST['lstVisiteur'];
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($_SESSION['idVisiteurChoisi'],$_SESSION['idMoisChoisi']);
                $idEtat = $lesInfosFicheFrais['idEtat'];
                switch ($idEtat){
                    case 'VA' :{
                         ajouterErreur("Fiche dÃ©jÃ  validÃ©e");
                         include ("vues/v_erreurs.php");
                         $action ='selectionnerVisiteur';
                         break;
                    }
                     case 'CR' :{
                         ajouterErreur("Fiche non cloturÃ©e, validation impossible");
                         include ("vues/v_erreurs.php");
                         $action ='selectionnerVisiteur';
                         break;
                    }
                     case 'RB' :{
                         ajouterErreur("Fiche dÃ©jÃ  remboursÃ©e, validation impossible");
                         include ("vues/v_erreurs.php");
                         $action ='selectionnerVisiteur';
                         break;
                    }
                     case '' :{
                         ajouterErreur("Pas de fiche pour ce mois, validation impossible");
                         include ("vues/v_erreurs.php");
                         $action ='selectionnerVisiteur';
                         break;
                    }
                }
                break;
            }
               
        case 'OKvaliderFraisForfait' :{
                $lesFrais = $_REQUEST['lesFrais'];
                $visiteurASelectionner =  $_SESSION['idVisiteurChoisi'];
                $leMois = $_SESSION['idMoisChoisi'];
		if(lesQteFraisValides($lesFrais)){
	  	 	
                        $pdo->majFraisForfait($visiteurASelectionner,$leMois,$lesFrais);
                        ajouterMessage("ElÃ©ments forfaitisÃ©s mis Ã  jour");
                        include ("vues/comptable/v_messages.php");
		}
		else{
			ajouterErreur("Les valeurs des frais doivent Ãªtre numÃ©riques");
			include("vues/v_erreurs.php");
		}
            break;
        }
        
	case 'validerFraisHorsForfait':{
	    // on met à jour les frais hors forfait du visiteur
            // le tableau associatif lesFraisHF contient 'V' ou 'R' ou 'S', pour chaque valeur de idFrais
            
             if (!empty($_REQUEST['lesFraisHF'])){
                 $lesFraisHF = $_REQUEST['lesFraisHF']; 
                 $pdo->miseAjourFraisHF($lesFraisHF);
                 // si FHF vides, n'aoute pas le montant 
            } 
            
           
               break;
	}
}
     $visiteurASelectionner =  $_SESSION['idVisiteurChoisi'];
     $leVisiteur = $pdo->getNomPrenomVisiteur($visiteurASelectionner); // faire un parcours de la collection $lesVisiteur préférable plutôt que accès pdo ?  
    
     $nom = $leVisiteur['nom'];
     $prenom = $leVisiteur['prenom']; 
     $leMois = $_SESSION['idMoisChoisi']; // format aaaamm
     $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($visiteurASelectionner,$leMois);
     $lesFraisForfait= $pdo->getLesFraisForfait($visiteurASelectionner,$leMois);
     $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($visiteurASelectionner,$leMois);
     $numAnnee =substr( $leMois,0,4);
     $numMois =substr( $leMois,4,2);
     $moisASelectionner = $numMois.'/'.$numAnnee; 
     $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($visiteurASelectionner,$leMois);
     $lesFraisForfait= $pdo->getLesFraisForfait($visiteurASelectionner,$leMois);
     $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($visiteurASelectionner,$leMois);
     $libEtat = $lesInfosFicheFrais['libEtat'];
     $montantValide = $lesInfosFicheFrais['montantValide'];
     $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
     $dateModif =  $lesInfosFicheFrais['dateModif'];
     $dateModif =  dateAnglaisVersFrancais($dateModif);
     $lesVisiteurs=$pdo->getLesVisiteurs();
     
     include("vues/comptable/v_listeVisiteurs.php");

     if ($action != 'selectionnerVisiteur') {
           include("vues/comptable/v_validerFraisForfait.php");
           include("vues/comptable/v_validerFraisHorsForfait.php");
           
           
     }
 

?>