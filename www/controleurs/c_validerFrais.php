<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'selectionnerVisiteur':
    $lesVisiteurs = $pdo->getLesVisiteurs();
    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
    // on demande toutes les clés, et on prend la première,
    // les mois étant triés décroissants
    $lesCles = array_keys($lesVisiteurs);
    $visiteurASelectionner = $lesCles[0];
    $mois = getMois(date('d/m/Y'));
    $lesMois = getLesDouzeDerniersMois($mois);
    $moisASelectionner = $lesCles[0];
    include 'vues/v_listeVisiteurs.php';
    break;
case 'ficheFrais':
    $idVisiteur= filter_input(INPUT_POST,'lstVisiteurs',FILTER_SANITIZE_STRING);
    $mois = filter_input(INPUT_POST,'lstMois',FILTER_SANITIZE_STRING);
    $condition = $pdo->estPremierFraisMois($idVisiteur, $mois);
    if (!$condition){
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = $idVisiteur;
        $mois1 = getMois(date('d/m/Y'));
        $lesMois = getLesDouzeDerniersMois($mois1);
        $moisASelectionner = $mois;
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $nbrJustificatifs = $pdo->getNbjustificatifs($idVisiteur, $mois);
        include 'vues/v_validerFicheFrais.php';
       
    }else{
        ajouterErreur('Le visiteur sélectionné ne possède aucune information pour le mois sélectionné');
        include 'vues/v_erreurs.php';
        header("Refresh: 3;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");
    }
    break; 
case 'boutons':
        $idVisiteur = filter_input(INPUT_POST,'lstVisiteurs',FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_POST,'lstMois',FILTER_SANITIZE_STRING);
        $lesFrais = filter_input(INPUT_POST,'lesFrais',FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $montant= filter_input(INPUT_POST,'montant',FILTER_VALIDATE_FLOAT);
        $date = filter_input(INPUT_POST,'date',FILTER_SANITIZE_STRING);
        $libelle =filter_input(INPUT_POST,'libelle',FILTER_SANITIZE_STRING);
        $idFrais= filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        
    if (isset ($_POST['corrigerfrais'])){
        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
        ajouterErreur('Votre modification a bien été enregistrée.');
        include 'vues/v_erreurs.php';
        header("Refresh: 3;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");} 
    else if (isset ($_POST['corrigerfhf'])) {
        var_dump($libelle, $date, $mois,$montant,$idVisiteur,$id);
        $pdo-> majFraisHorsForfait($idVisiteur, $mois, $montant,$idFrais,$libelle,$date);
        ajouterErreur('Votre modification a bien été enregistrée.');
        include 'vues/v_erreurs.php';
        header("Refresh: 3;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");
    } 
    else if (isset ($_POST['reporterfhf'])) {
        $libelle = 'Refusé '.$libelle;
        $mois = getMois(date('d/m/Y'));
        $pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant);
        //$pdo->supprimerFraisHorsForfait($idFrais);
        ajouterErreur('Votre report a bien été enregistré.');
        include 'vues/v_erreurs.php';
        header("Refresh: 3;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");
        
    }
        
    else if (isset ($_POST['validation'])) {
        echo 'validation justificatifs';
        
    }
break;
}