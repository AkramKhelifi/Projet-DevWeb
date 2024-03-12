<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();


if(!$page->session->isConnected()) {
    if($_SESSION['user']['role_id'] != 1){
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
    }
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteIntervention($_GET['delete_id']);
}

$interventions = $page->RepoUser->getInterventions();
$photo = $_SESSION['user']['photo'];

var_dump($_SESSION['user']['role_id']);

//echo $page->render('admin.html.twig', ['interventions' => $interventions,
//'photo' => $photo]);
