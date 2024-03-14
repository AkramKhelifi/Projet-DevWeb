<?php
use App\Page;

$page = new Page();
$msg1 = null;
$msg2 = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];

$interventions = $page->RepoUser->getInterventionsParIntervenantHist($_SESSION['user']['idu']);

echo $page->render('historique2.html.twig', ['interventions' => $interventions,
'photo' => $photo]);