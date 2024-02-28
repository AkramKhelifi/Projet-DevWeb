<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}
$msg = NULL;
if(isset($_POST['edit'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    $page->RepoUser->updateIntervention($_POST['edit_id'], $nom, $details);
    header('Location: edit.php?edit_id=' . $_POST['edit_id']);
    $msg = "La modification de votre service a été effectuée avec succès.";
}

$photo = $_SESSION['user']['photo'];
$oneint = $page->RepoUser->getInterventionbyid($_GET['edit_id']);

echo $page->render('edit.html.twig', ['photo' => $photo , 
'oneint' => $oneint , 'msg' => $msg ]);