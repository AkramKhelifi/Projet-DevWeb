<?php

require_once '../vendor/autoload.php';

use App\Page;

$page=new Page();

if(!$page->session->isConnected())

var_dump($page->get('user'));