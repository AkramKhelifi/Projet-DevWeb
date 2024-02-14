<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = null; 

    if (isset($_POST['send'])){

        $mail = $_POST['email'];
        $pos = strpos($_FILES["photo"]["name"], ".");
        $extension = substr($_FILES["photo"]["name"], $pos);
        $photo = "$mail$extension";
        move_uploaded_file($_FILES["photo"]["tmp_name"], "photo/$photo");
        
        $exuser = $page->RepoUser->getUserByEmail([':email' => $_POST['email']]);

        if ($_POST['password'] !== $_POST['password_confirmation']) {
            $msg = "Les mots de passe ne correspondent pas.";
        }elseif ($_POST['email'] !== $_POST['email_confirmation']) {
            $msg = "Les adresses email ne correspondent pas.";
        }elseif ($exuser) {
            $msg = "Cette adresse email est déjà utilisée.";
        }else{
        $page->RepoUser->insert('users',[
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':photo' => $photo,
            'email' => $_POST['email'],
            'mot_de_passe'  => password_hash( $_POST['password'],PASSWORD_DEFAULT)
        ]);
        header('location: index.php');}
    }

    echo $page->render('register.html.twig', ['msg' => $msg]);