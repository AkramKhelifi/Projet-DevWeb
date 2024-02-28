<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}
$photo = $_SESSION['user']['photo'];
$oneint = $page->RepoUser->getInterventionbyid($_GET['edit_id']);
if(isset($_POST['edit'])){
    $nom = 
    $details = 
    $page->RepoUser->updateIntervention($_GET['delete_id'],$nom,$details)
}
echo $page->render('edit.html.twig', ['photo' => $photo , 
'oneint' => $oneint]);