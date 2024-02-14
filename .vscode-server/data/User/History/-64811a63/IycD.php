<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_POST['send'])){

        $mail = $page->getUserByEmail([':email' => $_POST['email']]);
        $pos = strpos($_FILES["photo"]["name"], ".");
        $extension = substr($_FILES["photo"]["name"], $pos);
        $photo = "$mail$extension";
        move_uploaded_file($_FILES["photo"]["tmp_name"], "Paris-B2-DevWeb-main/app/public/photo/$photo");

        if ($_POST['password'] !== $_POST['password_confirmation']) {
            echo "Les mots de passe ne correspondent pas.";
        }elseif ($_POST['email'] !== $_POST['email_confirmation']) {
            echo "Les adresses email ne correspondent pas.";
        }elseif ($mail) {
            echo "Cette adresse email est déjà utilisée.";
        }else{
        $page->insert('users',[
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':photo' => $_FILES['photo']['name'],
            'email' => $mail,
            'mot_de_passe'  => password_hash( $_POST['password'],PASSWORD_DEFAULT)
        ]);
        header('location: index.php');}
    }

    echo $page->render('register.html.twig', []);