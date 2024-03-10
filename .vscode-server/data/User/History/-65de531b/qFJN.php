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


if(isset($_POST['edit'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];
    $oneint = $page->RepoUser->getInterventionbyid($_GET['read_id']);
    var_dump($page->RepoUser->getInterventionbyid($_GET['read_id']));
}



echo $page->render('readmore.html.twig', ['photo' => $photo , 'oneint' => $oneint, 'msg' => $msg]);

?>
