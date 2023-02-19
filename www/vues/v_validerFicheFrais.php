<?php
/**
 * Vue Liste des mois
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<form action="index.php?uc=validerFrais&action=boutons" 
              method="post" role="form">
<div class="row">
    <div class="col-md-4">
        <h4>Sélectionner un visiteur : </h4>
    </div>
    <div class="col-md-4">
        
            <div class="form-group">
                <label for="lstVisiteurs" accesskey="n">Visiteur : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom,' ', $prenom?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id?>">
                                <?php echo $nom,' ', $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
          
        
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <h4>Sélectionner un mois : </h4>
    </div>
       <div class="col-md-4">
        
            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois. '/'. $numAnnee?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois?>">
                                <?php echo $numMois. '/'. $numAnnee?> </option>

                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
           </div>
</div>
    <br>
<div class="row">
     <div class="col-md-4">    
<h2> Valider la fiche de frais</h2>
     </div>
</div>
<div class="row">
    <div class="col-md-4">
        <h3>Eléments forfaitisés </h3>
    </div>
    <div class="col-md-4"></div>   
    </div>
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label><br>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="20" maxlength="5" 
                               value="<?php echo $quantite ?>" >
                    </div>
                    <?php
                }
                ?>
    <input id="corrigerfrais" name="corrigerfrais" type="submit" value="Corriger" class="btn btn-success" />
    <input id="reinitialiser" name="reinitialiser" type="reset" value="Réinitialiser" class="btn btn-danger"/>
<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading" style="background-color: orange; color: white">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive" >
            
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <input type="text" id="date" 
                               name="date"
                               size="10" maxlength="10" 
                               value="<?php echo $date ?>" ></td>
                    <td> <input type="text" id="libelle" 
                               name="libelle"
                               size="20" maxlength="20" 
                               value="<?php echo $libelle ?>" ></td>
                    <td><input type="text" id="montant" 
                               name="montant"
                               size="4" maxlength="4" 
                               value="<?php echo $montant?>" ></td>
                    <td><input type="hidden" id="id" 
                               name="id"
                               value="<?php echo $id?>" ></td>
                      
                    <td>
                        <input id="corrigerfhf" name="corrigerfhf" type="submit" value="Corriger" class="btn btn-success"/>
                        <input id="reporterfhf" name="reporterfhf" type="submit" value="Reporter" class="btn btn-danger"/>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>           
<div class="col-md-4">
   <label for="nbJustificatif"> Nombre de justificatifs </label>
                        <input type="text" id="nbJustificatif" 
                               name="justificatifs"
                               size="2" maxlength="2" 
                               value="<?php echo $nbrJustificatifs ?>" >
                    
</div><br>
<div class="col-md-4">
    <input id="validation" name="validation" type="submit" value="Valider" class="btn btn-success"/>                       
</div>  
</div> 
</form>