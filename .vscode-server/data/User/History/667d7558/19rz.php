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
    $page->RepoUser->addUrgence($nom);
    $msg = "L'Urgence a été ajoutée avec succès. Vous allez être redirigé(e)";
    header('Refresh: 3; URL=urgences.php');
}



echo $page->render('urgences.html.twig', ['photo' => $photo, 'msg' => $msg]);