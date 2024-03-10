<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = null;


if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}
$photo = $_SESSION['user']['photo'];

if(isset($_POST['add'])){
    $nom = $_POST['urgence'];

    $verification = $page->RepoUser->getUrgences();
    $existeDeja = false;
    foreach ($verification as $ver) {
        if ($ver['deg_urgence'] == $nom) {
            $existeDeja = true;
            $msg = "L'Urgence existe déjà.";
            break; 
        }
    }

    if (!$existeDeja) {
        $page->RepoUser->addSuivie($nom);
        $msg = "Le statut a été ajouté avec succès. Vous allez être redirigé(e)";
    }

    header('Refresh: 3; URL=suivies.php');
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteUrgence($_GET['delete_id']);
}

$urgences = $page->RepoUser->getUrgences();
$photo = $_SESSION['user']['photo'];




echo $page->render('urgences.html.twig', ['urgences' => $urgences,'photo' => $photo, 'msg' => $msg]);