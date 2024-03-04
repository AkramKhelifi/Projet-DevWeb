<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];
$users = $page->RepoUser->getUsers();

if(isset($_POST['edituser'])){
    $nom = $_POST['nom_intervention'];
        $page->RepoUser->updateUser($_POST['edit_id'], $nom, $details);
        $msg = "L'intervention a été modifiée avec succès. Vous allez être redirigé(e)";
        header('Refresh: 3; URL=profile.php'); 
    } else {
        $msg = "Aucune modification n'a été apportée.";
        $oneint = $page->RepoUser->getInterventionbyid($_POST['edit_id']);
    }
} else {
    $oneint = $page->RepoUser->getInterventionbyid($_GET['edit_id']);
}

echo $page->render('mesdemandes.html.twig', ['photo' => $photo, 'users' => $users]);