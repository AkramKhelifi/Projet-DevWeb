<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

// Insérer un nouveau message de chat
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $userId = $_SESSION['user']['idu']; // Ou tout autre moyen d'obtenir l'ID de l'utilisateur
    $page->RepoUser->insertChatMessage($userId, $message);
}

// Récupérer tous les messages de chat
$chatMessages = $page->RepoUser->getAllChatMessages();



$photo = $_SESSION['user']['photo'];

echo $page->render('chat.html.twig', ['photo' => $photo]);
