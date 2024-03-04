<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg =

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=Vous ne pouvez pas entrer !');
    exit();
}

$photo = $_SESSION['user']['photo'];
$users = $page->RepoUser->getUsers();

if(isset($_POST['edituser'])){
    $id = $_POST['user_id'];
    $role = strtoupper($_POST['role_name']);
    
    $allowed_roles = ['ADMIN', 'CLIENT', 'INTERVENANT', 'STANDARDISTE'];
    if (in_array($role, $allowed_roles)) {
        $page->RepoUser->updateUser($id, $role);
        $msg = "Maj de role (Ok)";
        header('Refresh: 3; URL=mesdemandes.php');
    } else {
        $msg = "Le rôle fourni n'est pas valide";
        header('Refresh: 3; URL=mesdemandes.php');
    }
}

echo $page->render('mesdemandes.html.twig', ['photo' => $photo, 'users' => $users, 'msg' => $msg]);
