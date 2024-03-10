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
$oneint = $page->RepoUser->getInterventionbyid($_GET['read_id']);


if(isset($_POST['Add'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    $id = $_POST['add_int_id'];
    

}



echo $page->render('readmore.html.twig', ['photo' => $photo , 'oneint' => $oneint, 'msg' => $msg]);

?>
