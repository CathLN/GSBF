
<h3>Fiche de frais de  <?php echo $nom . " " . $prenom ?> du mois : <?php echo $numMois . "-" . $numAnnee ?>
</h3>

 <form method="POST"  action="index.php?uc=validerFrais&action=OKvaliderFraisForfait">
<div class="encadre">
    <p>
        Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>
    </p>
    <table class="listeLegere">
        <caption>Eléments forfaitisés </caption>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle'];
                ?>	
                <th> <?php echo $libelle ?></th>
                <?php
            }
            ?>
        </tr>
        
        
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $quantite = $unFraisForfait['quantite'];
                $idFrais = $unFraisForfait['idfrais'];
                ?>            
                <td class="qteForfait"><input type="text" name="lesFrais[<?php echo $idFrais ?>]" size="10" maxlength="5" value = "<?php echo $quantite ?>" </td>
             <?php
                }
                echo $idFrais;
                echo $quantite;
            ?>
        </tr>
    </table>
</div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
 </form>
</div>
</div>