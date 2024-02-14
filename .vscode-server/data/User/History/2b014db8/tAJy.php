<?php

namespace App;

class Page
{
    public \Twig\Environment $twig;
    public Session $session;
    public RepoUser $RepoUser;

    public function __construct()
    {
        $this->session = new Session();

        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true,
        ]);

        $this->RepoUser = new RepoUser();

    }


    public function render(string $name, array $data): string
    {
        return $this->twig->render($name, $data);
    }
}