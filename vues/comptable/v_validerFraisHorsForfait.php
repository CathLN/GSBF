 <form method="POST"  action="index.php?uc=validerFrais&action=validerFraisHorsForfait">
    <table class="listeLegere">
        <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
        </caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th> 
            <th class='action'>Action</th>   
            
        </tr>
<?php
foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
    $id = $unFraisHorsForfait['id'];
    $date = $unFraisHorsForfait['date'];
    $libelle = $unFraisHorsForfait['libelle'];
    $montant = $unFraisHorsForfait['montant'];
    ?>
            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                 <td><SELECT name="lesFraisHF[<?php echo $id ?>]">
                        <OPTION selected value ='V'>Validé
                        <OPTION value ='S'>Supprimé
                        <OPTION value ='R'>Reporté
                    </SELECT>
                 </td>
            </tr>
    <?php
    
}
?>
    </table>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
 </form>
</div>












