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

$interventions = $page->RepoUser->getInterventionsParIntervenant($_SESSION['user']['idu']);

if(isset($_POST['edituser'])){
    $id = $_POST['user_id'];
    $newRole = strtoupper($_POST['role_name']);
    
    $currentUser = $page->RepoUser->getInterventionbyid2($id);
    $currentRole = $currentUser['statut_suivi'];
    
    $allowed_roles = $page->RepoUser->getSuivi();

    if (in_array($newRole, $allowed_roles)) {
        if ($newRole !== $currentRole) {
            $msg1 = "Mise à jour du statut (Ok)";
        } else {
            $msg1 = "Aucune modification n'a été effectuée.";
        }
        header('Refresh: 3; URL=intervenant.php');
    } else {
        $msg2 = "Le statut fourni n'est pas valide !";
        header('Refresh: 3; URL=intervenant.php');
    }
}

echo $page->render('intervenant.html.twig', ['interventions' => $interventions,
'photo' => $photo, 'msg1' => $msg1, 'msg2' => $msg2]);
