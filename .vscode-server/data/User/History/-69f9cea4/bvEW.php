<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = null;

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

if($_SESSION['user']['role_id'] != 4){
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}


if(isset($_POST['add'])){
    $nom = $_POST['nom_intervention'];
    $details = $_POST['details_intervention'];

    $verification = $page->RepoUser->getInterventionsStd();

    $existeDeja = false;
    foreach ($verification as $ver) {
        if ($ver['nom_intervention'] == $nom) {
            $existeDeja = true;
            $msg = "L'intervention éxiste déjà!. Vous allez être redirigé(e)";
            break; 
        }
    }

    if (!$existeDeja) {
    $page->RepoUser->addInterventionStd($nom, $details, $_SESSION['user']['idu']);
    $msg = "L'intervention a été ajoutée avec succès. Vous allez être redirigé(e)";
    }

    header('Refresh: 3; URL=standardiste.php');
}

$photo = $_SESSION['user']['photo'];

echo $page->render('addstd.html.twig', ['photo' => $photo, 'msg' => $msg]);
