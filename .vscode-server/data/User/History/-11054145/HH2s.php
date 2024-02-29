<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if(isset($_POST['add'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    $page->RepoUser->addIntervention($nom, $details);
}

$photo = $_SESSION['user']['photo'];

echo $page->render('add.html.twig', ['photo' => $photo]);