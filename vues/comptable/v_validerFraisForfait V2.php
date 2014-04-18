
<h3>Fiche de frais de  <?php echo $nom . " " . $prenom ?> du mois : <?php echo $numMois . "-" . $numAnnee ?>
</h3>

 <form method="POST"  action="index.php?uc=validerFrais&action=OKvaliderFraisForfait">
<div class="encadre">
    <p>
        Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>
    </p>
    <fieldset>
            <legend>Eléments forfaitisés
            </legend>
			<?php
				foreach ($lesFraisForfait as $unFrais)
				{
					$idFrais = $unFrais['idfrais'];
					$libelle = $unFrais['libelle'];
					$quantite = $unFrais['quantite'];                                        
			?>
					<p>
						<label for="idFrais"><?php echo $libelle ?></label>
						<input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" size="10" maxlength="5" value="<?php echo $quantite?>" >
					</p>
			
			<?php
				}
			?>
                                       
          </fieldset>
</div>
      <div class="piedForm">
      <p>
        <input type = "hidden" name="lstVisiteur" value ="<?php echo $visiteurASelectionner ?>">
        <input type = "hidden" name="mois" value ="<?php echo $moisASelectionner ?>">
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
 </form>
</div>
</div>