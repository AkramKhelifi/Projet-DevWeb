<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg1 = null;
$msg2 = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=Vous ne pouvez pas entrer !');
    exit();
}

$photo = $_SESSION['user']['photo'];
$users = $page->RepoUser->getUsers($_SESSION['user']['idu']);

if(isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $users = $page->RepoUser->searchUsersByName($searchTerm,$_SESSION['user']['idu']);
}

if(isset($_GET['delete_id'])) {
    $page->RepoUser->deleteUser($_GET['delete_id']);
    $msg = "Suppression (Ok). Vous allez être redirigé(e)";
    header('Refresh: 3; URL=mesdemandes.php');
}

if(isset($_POST['edituser'])){
    $id = $_POST['user_id'];
    $newRole = strtoupper($_POST['role_name']);
    
    $currentUser = $page->RepoUser->getUserById($id);
    var_dump($page->RepoUser->getUserById($id));
    $currentRole = $currentUser['nom_role'];

    $allowed_roles = ['ADMIN', 'CLIENT', 'INTERVENANT', 'STANDARDISTE'];
    if (in_array($newRole, $allowed_roles)) {
        if ($newRole !== $currentRole) {
            $page->RepoUser->updateUser($id, $newRole);
            $msg1 = "Mise à jour du rôle (Ok)";
        } else {
            $msg1 = "Aucune modification du rôle n'a été effectuée.";
            header('Refresh: 3; URL=mesdemandes.php');
        }
    } else {
        $msg2 = "Le rôle fourni n'est pas valide !";
        header('Refresh: 3; URL=mesdemandes.php');
    }
}


echo $page->render('mesdemandes.html.twig', ['photo' => $photo, 'users' => $users, 'msg1' => $msg1, 'msg2' => $msg2]);
