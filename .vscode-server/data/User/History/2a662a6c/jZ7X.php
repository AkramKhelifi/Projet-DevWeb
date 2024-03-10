<?php


require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$msg = false;

if (isset($_POST['send'])) {
    $user = $page->RepoUser->getUserByEmail(['email' => $_POST['email']]);

    if (!$user) {
        $msg = "Email ou mot de passe incorrect !";
    } else {
        if (!password_verify($_POST['password'], $user['mot_de_passe'])) {
            $msg = "Email ou mot de passe incorrect !";
        } else {
            $page->session->add('user', $user);
            var_dump($user);
           // header('Location: admin.php');
        }
    }
}


echo $page->render('index.html.twig', ['msg' => $msg]);