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

    
    public function getUserById($id){
    $sql = "SELECT u.idu, u.nom, u.prenom, r.nom_role
            FROM users u
            INNER JOIN role r ON u.role_id = r.id_role
            WHERE u.idu = :id"; 
    $sth = $this->link->prepare($sql);
    $sth->bindValue(':id', $id, \PDO::PARAM_INT); 
    $sth->execute();

    return $sth->fetch(\PDO::FETCH_ASSOC); }


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
    
    public function addIntervention($nom, $details, $idu) {
        $sql = "INSERT INTO intervention (id_admin, nom_intervention, details_intervention) VALUES (:idu, :nom, :details)";
        $sth = $this->link->prepare($sql);
        $sth->bindValue(':idu', $idu, \PDO::PARAM_INT);
        $sth->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $sth->bindParam(':details', $details, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getUsers($userId){
        $sql = "SELECT u.idu, u.nom, u.prenom, r.nom_role
                FROM users u
                INNER JOIN role r ON u.role_id = r.id_role
                WHERE u.idu != :userId";
        $sth = $this->link->prepare($sql);
        $sth->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    

    public function updateUser($idu, $role_name) {
        $sql = "UPDATE users SET role_id = (SELECT id_role FROM role WHERE nom_role = :role_name) WHERE idu = :idu";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':role_name', $role_name, \PDO::PARAM_STR); 
        $sth->bindParam(':idu', $idu, \PDO::PARAM_INT);
        $sth->execute();
    }
    
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE idu = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    }
    

    public function searchUsersByName($searchTerm, $userId) {
        $sql = "SELECT u.idu, u.nom, u.prenom, r.nom_role
                FROM users u
                INNER JOIN role r ON u.role_id = r.id_role
                WHERE (CONCAT(u.nom, ' ', u.prenom) LIKE :searchTerm OR r.nom_role LIKE :searchTerm) 
                AND u.idu != :userId";
        $sth = $this->link->prepare($sql);
        $searchTerm = "%$searchTerm%";
        $sth->bindValue(':searchTerm', $searchTerm, \PDO::PARAM_STR);
        $sth->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $sth->execute();
    
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function addUrgence($nom) {
        $sql = "INSERT INTO urgence (deg_urgence) VALUES (:nom)";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getUrgences(){
        $sql = "SELECT * FROM urgence";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteUrgence($id) {
        $sql = "DELETE FROM urgence WHERE id_urgence = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    }

    public function addSuivie($nom) {
        $sql = "INSERT INTO suivi (statut_suivi) VALUES (:nom)";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getSuivies(){
        $sql = "SELECT * FROM suivi";
        $sth = $this->link->prepare($sql);
        $sth->execute();
        
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteSuivie($id) {
        $sql = "DELETE FROM suivi WHERE id_suivi = :id";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    }

    public function addIntervention($id_int, $idu) {
        $sql = "INSERT INTO intervention (id_client, nom_intervention, details_intervention, date_cre_int) VALUES idu,
        SELECT , id_admin, id_standardiste, id_urgence, ID_SUIVI_INITIAL, nom_intervention, details_intervention, CURRENT_TIMESTAMP
        FROM intervention
        WHERE id_intervention = ID_INTERVENTION_MODELE";

        $sth = $this->link->prepare($sql);
        $sth->bindValue(':idu', $idu, \PDO::PARAM_INT);
        $sth->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $sth->bindParam(':details', $details, \PDO::PARAM_STR);
        $sth->execute();
    }

}