<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if($_SESSION['user']['role_id'] != 1){
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_POST['add'])){
    $nom = $_POST['suivie'];

    $verification = $page->RepoUser->getSuivies();
    $existeDeja = false;
    foreach ($verification as $ver) {
        if ($ver['statut_suivi'] == $nom) {
            $existeDeja = true;
            $msg = "Le statut existe déjà.";
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
    $page->RepoUser->deleteSuivie($_GET['delete_id']);
}

$suivies = $page->RepoUser->getSuivies();
$photo = $_SESSION['user']['photo'];




echo $page->render('suivies.html.twig', ['suivies' => $suivies,'photo' => $photo, 'msg' => $msg]);