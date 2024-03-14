<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$oneint = null;
$msg = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];


if(isset($_POST['Add'])){
    $id_int = $_POST['add_int_id'];
    $idu = $_SESSION['user']['idu'];
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    $id_urgence = $_POST['urgence'];
    
    if(!$page->RepoUser->interventionDejaDeclenchee($nom, $idu)){
        $id_intervention = $page->RepoUser->declencherIntervention($id_int, $idu, $id_urgence);
        $ids_intervenants = $page->RepoUser->getIntervenantsAleatoires(2); // Exemple pour 2 intervenants

// Associer les intervenants sélectionnés à l'intervention
$page->RepoUser->associerIntervenants($id_intervention, $ids_intervenants);

        $msg = "L'intervention a été déclenchée avec succès. Vous allez être redirigé(e)";
        header('Refresh: 3; URL=client.php');
    } else {
        $msg = "L'intervention a déjà été déclenchée par vous!!!. Vous allez être redirigé(e)";
        header('Refresh: 3; URL=client.php');
    }

    $oneint = $page->RepoUser->getInterventionbyid($id_int);
    $urgences = $page->RepoUser->getUrgences();
}else{
    $oneint = $page->RepoUser->getInterventionbyid($_GET['read_id']);
    $urgences = $page->RepoUser->getUrgences();
}




echo $page->render('readmore.html.twig', ['photo' => $photo , 
'oneint' => $oneint, 
'msg' => $msg,
'urgences' => $urgences]);

?>
