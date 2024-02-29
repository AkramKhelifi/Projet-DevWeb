<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_POST['edit'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    
    // Récupérer les valeurs actuelles de l'intervention
    $currentIntervention = $page->RepoUser->getInterventionbyid($_POST['edit_id']);
    $currentNom = $currentIntervention['nom_intervention'];
    $currentDetails = $currentIntervention['details_intervention'];
    
    // Vérifier si les nouvelles valeurs sont différentes des valeurs actuelles
    if($currentNom != $nom || $currentDetails != $details) {
        // Mettre à jour l'intervention seulement si les valeurs sont différentes
        $page->RepoUser->updateIntervention($_POST['edit_id'], $nom, $details);
        $msg = "L'intervention a été modifiée avec succès.";
    } else {
        $msg = "Aucune modification n'a été apportée.";
    }

    // Redirection vers la page profile.php après un délai de 3 secondes
    header('Refresh: 3; URL=profile.php');
} else {
    // Récupérer les détails de l'intervention à éditer
    $oneint = $page->RepoUser->getInterventionbyid($_GET['edit_id']);
}

$photo = $_SESSION['user']['photo'];

echo $page->render('edit.html.twig', ['photo' => $photo , 'oneint' => $oneint, 'msg' => $msg]);

?>
