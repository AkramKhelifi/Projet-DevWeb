<?php

namespace App;

class Page
{
    public \Twig\Environment $twig;
    public \PDO $link;
    public $session;

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

    public function insert(string $table_name, array $data)
    {
        $sql = 'INSERT INTO ' . $table_name . ' (nom, prenom, photo, email, ) VALUES (:email, :password)';
        $sth = $this->link->prepare($sql);
        $sth->execute($data);
    }

    public function getUserByEmail(array $data)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $sth = $this->link->prepare($sql);
        $sth->execute($data);

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function render(string $name, array $data): string
    {
        return $this->twig->render($name, $data);
    }
}