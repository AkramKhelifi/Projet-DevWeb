<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=Vous ne pouvez pas entrer !');
    exit();
}

$photo = $_SESSION['user']['photo'];
$users = $page->RepoUser->getUsers();

if(isset($_POST['edituser'])){
    $id = $_POST['user_id'];
    $role = $_POST['role_name'];
    
    $allowed_roles = ['ADMIN', 'CLIENT', 'INTERVENANT', 'STANDARDISTE'];
    if (in_array($role, $allowed_roles)) {
        $page->RepoUser->updateUser($id, $role);
        header('Refresh: 0; URL=mesdemandes.php');
        exit();
    } else {
        header('Location: mesdemandes.php?error=Le rôle fourni n\'est pas valide');
        exit();
    }
}

echo $page->render('mesdemandes.html.twig', ['photo' => $photo, 'users' => $users]);
