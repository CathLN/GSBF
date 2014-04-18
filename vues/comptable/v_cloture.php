<div id="contenu">
<h2>Campagne de cloture </h2>
    <form action="index.php?uc=campagneCloture&action=demarrerCloture" method="post">
        <div class="corpsForm">

        
             <label for="mois">Mois à cloturer : </label>
                <input id="mois" type="text" name="mois"  size="22" value="<?php echo $moisASelectionner ?>" >
        </p>  
        
        
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
                <input id="annuler" type="reset" value="Effacer" size="20" />
            </p> 
            </div>
    </form>