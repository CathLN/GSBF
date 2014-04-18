<!-- Division pour le sommaire -->
<div id="menuGauche">
    <div id="infosUtil">
        <h2>        </h2>
    </div>  
    
    <ul id="menuList">
        <li >
            Comptable :</br>
            <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?>
        </li></br>
        <li class="smenu">
            <a href="index.php?uc=gererFrais&action=saisirFrais" title="Consulter fiche de frais ">Consultation fiches</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=validerFrais&action=selectionnerVisiteur" title="Valider les fiches de frais">Validation fiches</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=connexion&action=deconnexion" title="Mettre à jour les remboursements sur la fiche">Suivi mise en paiement</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=campagneCloture&action=afficherCloture" title="Lancer la campagne de cloture">Cloture</a>
        </li>
        <li class="smenu">
            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
        </li>
    </ul>

</div>
