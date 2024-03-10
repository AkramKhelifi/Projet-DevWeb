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
    
    $page->RepoUser->addSuivie($nom);
    $msg = "Le statut a été ajoutée avec succès. Vous allez être redirigé(e)";
    header('Refresh: 3; URL=suivies.php');
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteSuivie($_GET['delete_id']);
}

$suivies = $page->RepoUser->getSuivies();
$photo = $_SESSION['user']['photo'];




echo $page->render('suivies.html.twig', ['suivies' => $suivies,'photo' => $photo, 'msg' => $msg]);