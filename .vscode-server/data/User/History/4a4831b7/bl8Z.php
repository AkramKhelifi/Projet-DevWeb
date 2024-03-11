<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}


$verifications = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);
foreach($Try as $T){
if($T)
}
$photo = $_SESSION['user']['photo'];


echo $page->render('historique.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
