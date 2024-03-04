<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];
$users = $page->RepoUser->getUsers();

if(isset($_POST['edituser'])){
    $id = $_POST['user_id'];
    $role = $_POST['role_id'];
    var_dump($_POST);
    $page->RepoUser->updateUser($id, $role);
    //header('Refresh: 3; URL=mesdemandes.php'); 
}


echo $page->render('mesdemandes.html.twig', ['photo' => $photo, 'users' => $users]);