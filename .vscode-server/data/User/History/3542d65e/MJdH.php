<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];

$interventions = $page->RepoUser->getInterventionsParIntervenant($_SESSION['user']['idu']);

if(isset($_POST['edituser'])){
    $id = $_POST['user_id'];
    $newRole = strtoupper($_POST['role_name']);
    
    $currentUser = $page->RepoUser->getInterventionbyid2($id);
    $currentRole = $currentUser['statut_suivi'];
    
    $allowed_roles = $page->RepoUser->getSuivi();
    var_dump($page->RepoUser->getSuivi());
    
    if (in_array($newRole, $allowed_roles)) {
        if ($newRole !== $currentRole) {
            $page->RepoUser->updateUser($id, $newRole);
            $msg1 = "Mise à jour du rôle (Ok)";
        } else {
            $msg1 = "Aucune modification du rôle n'a été effectuée.";
        }
      //  header('Refresh: 3; URL=utilisateurs.php');
    } else {
        $msg2 = "Le rôle fourni n'est pas valide !";
        //header('Refresh: 3; URL=utilisateurs.php');
    }
}

echo $page->render('intervenant.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
