<?php

namespace App;

class RepoUser extends Repo{

    public function __construct(){
    parent::__construct();
    }

    public function insert(string $table_name, array $data)
    {
        $sql = 'INSERT INTO ' . $table_name . ' (nom, prenom, photo, email, mot_de_passe) VALUES (:nom,:prenom,:photo,:email, :mot_de_passe)';
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

    public function getInterventions(){
        $sql = "SELECT * FROM intervention";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteIntervention(array $data){
    $sql = "DELETE FROM intervention WHERE id_intervention = :id_intervention";
    $sth = $this->link->prepare($sql);
    $sth->execute();
    }
    
}