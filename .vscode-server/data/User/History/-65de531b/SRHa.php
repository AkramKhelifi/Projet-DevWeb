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
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    $id_int = $_POST['add_int_id'];

    $page->RepoUser->declencherIntervention($id_int, $_SESSION['user']['idu']);
    $msg = "L'intervention a été déclenchée avec succès. Vous allez être redirigé(e)";
    header('Refresh: 3; URL=client.php');

    $oneint = $page->RepoUser->getInterventionbyid($id_int);

}else{
    $oneint = $page->RepoUser->getInterventionbyid($_GET['read_id']);
    $urgences = $page->RepoUser->getUrgences();
}



echo $page->render('readmore.html.twig', ['photo' => $photo , 
'oneint' => $oneint, 
'msg' => $msg,
'urgences' => $urgences]);

?>
