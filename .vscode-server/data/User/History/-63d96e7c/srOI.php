<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$id = $_GET['edit_id'];


$photo = $_SESSION['user']['photo'];
$oneint = $page->RepoUser->getInterventionbyid($id);

echo $page->render('edit.html.twig', ['photo' => $photo , 
'oneint' => $oneint]);