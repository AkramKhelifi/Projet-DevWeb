<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_POST['send'])){

        $photo_name = $_FILES['photo']['name'];
        $photo_tmp_name = $_FILES['photo']['tmp_name'];
        $upload_directory = '\\wsl.localhost\Ubuntu-22.04\home\akraaam_kh\Paris-B2-DevWeb-main\app\public\photo';
        $target_file = $upload_directory . basename($photo_name);

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
            ':photo' => $photo_name,
            'email' => $_POST['email'],
            'mot_de_passe'  => password_hash( $_POST['password'],PASSWORD_DEFAULT)
        ]);
        header('location: index.php');}
    }

    echo $page->render('register.html.twig', []);