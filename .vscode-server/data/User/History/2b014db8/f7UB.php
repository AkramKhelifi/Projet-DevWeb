<?php

namespace App;

class Page
{
    private \Twig\Environment $twig;
    private $link ;
    function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug'  => true
        ]);
    
        hea
    } try{
        $link =new \Pdd('mysql:host=mysql ;dbname=bé-paris',"root", "");
        } catch (\PDOException $e){
        var_dump($e->getMessage());
        die();
                                }
    }

    $link =new \Pdd('mysql:host=mysql ;dbname=bé-paris',"root", "");

    function render(string $name, array $data) :string
    {
        return $this->twig->render($name, $data);
    }
}