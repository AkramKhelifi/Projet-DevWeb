<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_POST['send'])){

        $dossier_tmp = $_FILES['photo']['tmp_name'];
        $nom_fichier = $_FILES['photo']['name'];
        $dossier_destination = '/home/akraaam_kh/Paris-B2-DevWeb-main/app/public/photo/';

        $exuser = $page->getUserByEmail([':email' => $_POST['email']]);

        if ($_POST['password'] !== $_POST['password_confirmation']) {
            echo "Les mots de passe ne correspondent pas.";
        }elseif ($_POST['email'] !== $_POST['email_confirmation']) {
            echo "Les adresses email ne correspondent pas.";
        }elseif ($exuser) {
            echo "Cette adresse email est déjà utilisée.";
        }else{
        $page->insert('users',[
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':photo' => $_FILES['photo']['name'],
            'email' => $_POST['email'],
            'mot_de_passe'  => password_hash( $_POST['password'],PASSWORD_DEFAULT)
        ]);
        header('location: index.php');}
    }

    echo $page->render('register.html.twig', []);