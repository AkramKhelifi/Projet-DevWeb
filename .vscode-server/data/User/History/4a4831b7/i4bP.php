<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}


$All = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);
foreach($All as $one){
if($one['statut_suivi'] == "critique"){

}
$photo = $_SESSION['user']['photo'];


echo $page->render('historique.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
