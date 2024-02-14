<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    
if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$page->session->destroy();
echo "Vous allez etre rediriger!";
header('Location: index.php?msg=vous ne pouvez pas entrer !');
    