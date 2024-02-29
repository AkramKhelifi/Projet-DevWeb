<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$oneint = null;
$msg = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_POST['edit'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];

    $currentIntervention = $page->RepoUser->getInterventionbyid($_POST['edit_id']);
    $currentNom = $currentIntervention['nom_intervention'];
    $currentDetails = $currentIntervention['details_intervention'];

    if($currentNom != $nom || $currentDetails != $details) {
        $page->RepoUser->updateIntervention($_POST['edit_id'], $nom, $details);
        $msg = "L'intervention a été modifiée avec succès.";
        header('Refresh: 3; URL=profile.php'); 
    } else {
        $msg = "Aucune modification n'a été apportée.";
        $oneint = $page->RepoUser->getInterventionbyid($_GET['edit_id']);
    }
} else {
    $oneint = $page->RepoUser->getInterventionbyid($_GET['edit_id']);
}

$photo = $_SESSION['user']['photo'];

echo $page->render('edit.html.twig', ['photo' => $photo , 'oneint' => $oneint, 'msg' => $msg]);

?>
