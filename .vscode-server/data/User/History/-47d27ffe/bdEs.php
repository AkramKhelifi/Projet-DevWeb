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
    $nom = $_POST['suivie'];

    // Vérifier si le suivi existe déjà
    $existeDeja = $page->RepoUser->verifierSuivie($nom);

    if($existeDeja){
        $msg = "Le statut existe déjà dans la base de données.";
    } else {
        // Ajouter le suivi s'il n'existe pas
        $page->RepoUser->addSuivie($nom);
        $msg = "Le statut a été ajouté avec succès. Vous allez être redirigé(e)";
        header('Refresh: 3; URL=suivies.php');
    }
}


if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteSuivie($_GET['delete_id']);
}

$suivies = $page->RepoUser->getSuivies();
$photo = $_SESSION['user']['photo'];




echo $page->render('suivies.html.twig', ['suivies' => $suivies,'photo' => $photo, 'msg' => $msg]);