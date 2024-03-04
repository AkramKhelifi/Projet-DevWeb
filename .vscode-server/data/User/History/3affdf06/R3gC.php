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

    public function deleteIntervention($id) {
        $sql = "DELETE FROM intervention WHERE id_intervention = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    }

    public function getInterventionbyid($id) {
        $sql = "SELECT * FROM intervention WHERE id_intervention = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateIntervention($id, $nom, $details) {
        $sql = "UPDATE intervention SET nom_intervention = :nom, details_intervention = :details WHERE id_intervention = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $sth->bindParam(':details', $details, \PDO::PARAM_STR);
        $sth->execute();
    }    
    
    public function addIntervention($nom, $details) {
        $sql = "INSERT INTO intervention (nom_intervention, details_intervention) VALUES (:nom, :details)";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $sth->bindParam(':details', $details, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getUsers(){
        $sql = "SELECT nom, prenom, role_id FROM users";
        $sth = $this->link->prepare($sql);
        $sth->execute($);

        return $sth->fetchALL(\PDO::FETCH_ASSOC);
    }
    
}