<?php

namespace App;

class Page
{
    public \Twig\Environment $twig;
    public Session $session;
    public RepoUser $repoUser;

    public function __construct()
    {
        $this->session = new Session();

        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true,
        ]);

        try {
            $this->link = new \PDO('mysql:host=mysql;dbname=b2-paris', "root", "", [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
        } catch (\PDOException $e) {
            // Handle database connection error more gracefully (e.g., log the error)
            die("Connection failed: " . $e->getMessage());
        }
    }


    public function render(string $name, array $data): string
    {
        return $this->twig->render($name, $data);
    }
}