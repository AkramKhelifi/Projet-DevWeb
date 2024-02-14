<?php


require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;

if (isset($_POST['send'])) {
    $user = $page->getUserByEmail(['email' => $_POST['email']]);

    if (!$user) {
        echo "Email ou mot de passe incorrect !";
    } else {
        if (!password_verify($_POST['password'], $user['mot_de_passe'])) {
            echo "Email ou mot de passe incorrect !";
        } else {
            $page->session->add('user', $user);
            header('Location: profile.php');
        }
    }
}

// Rendre le modèle Twig
echo $page->render('index.html.twig', []);