<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = null;


if(isset($_POST['add'])){
    $nom = $_POST['suivie'];

    $verification = $page->RepoUser->getSuivies();
    $existeDeja = false;
    foreach ($verification as $ver) {
        if ($ver['statut_suivi'] == $nom) {
            $existeDeja = true;
            $msg = "Le statut existe déjà.";
            break; // Sortie anticipée si le statut existe déjà
        }
    }

    if (!$existeDeja) {
        // Ajout du nouveau statut de suivi si ce dernier n'existe pas déjà
        $page->RepoUser->addSuivie($nom);
        $msg = "Le statut a été ajouté avec succès. Vous allez être redirigé(e)";
    }

    // Redirection indépendamment de l'ajout ou non pour afficher le message approprié
    header('Refresh: 3; URL=suivies.php');
    // Assurez-vous de ne pas avoir d'écho ou de HTML avant cette ligne pour éviter des erreurs de header déjà envoyé
}


if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteSuivie($_GET['delete_id']);
}

$suivies = $page->RepoUser->getSuivies();
$photo = $_SESSION['user']['photo'];




echo $page->render('suivies.html.twig', ['suivies' => $suivies,'photo' => $photo, 'msg' => $msg]);