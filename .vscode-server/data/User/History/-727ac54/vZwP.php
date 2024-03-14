<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg1 = null;
$msg2 = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];

var_dump($page->RepoUser->getInterventionsPourStandardiste());


echo $page->render('encour.html.twig', ['interventions' => $interventions,
'photo' => $photo, 'msg1' => $msg1, 'msg2' => $msg2]);
