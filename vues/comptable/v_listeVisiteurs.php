<div id="contenu">
<h2>Validation des frais par visiteur</h2>
    <form action="index.php?uc=validerFrais&action=validerChoixVisiteur" method="post">
        <div class="corpsForm">

            <p>
                <label for="lstVisiteur" accesskey="n">Choisir le visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $idVisiteur = $unVisiteur['id'];
                        $nomV = $unVisiteur['nom'];
                        $prenomV = $unVisiteur['prenom'];
                        
                    
                     if ($idVisiteur == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $idVisiteur ?>"><?php echo $nomV . " " . $prenomV ?> </option>
                            <?php
                        } 
                        else {
                            ?>
                             <option value="<?php echo $idVisiteur ?>"><?php echo $nomV . " " . $prenomV ?> </option>
                            <?php
                        }  
                    }
                    ?>
                </select> 
            </p>
             <label for="mois">Mois : </label>
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