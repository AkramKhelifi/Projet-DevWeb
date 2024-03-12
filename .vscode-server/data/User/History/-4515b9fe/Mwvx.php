<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    
if(!$page->session->isConnected()) {
    header('Locat

$page->session->destroy();
header('Location: index.php?msg=Vous allez etre rediriger!');
    