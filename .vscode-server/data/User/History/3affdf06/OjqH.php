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
        $sql = "SELECT * FROM intervention WHERE id_client IS NULL 
        AND id_intervenant IS NULL AND id_standardiste IS NULL";

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

    public function getInterventionbyidu($idu) {
        $sql = "SELECT intervention.*, suivi.statut_suivi, urgence.deg_urgence
                FROM intervention 
                LEFT JOIN suivi ON intervention.id_suivi = suivi.id_suivi
                LEFT JOIN urgence ON intervention.id_urgence = urgence.id_urgence
                WHERE id_client = :idu
                OR id_admin = :idu 
                OR id_standardiste = :idu 
                OR id_intervenant = :idu";
    
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':idu', $idu, \PDO::PARAM_INT);
        $sth->execute();
    
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
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

    public function declencherIntervention($id_int, $idu, $id_urgence) {
        $sql = "INSERT INTO intervention (id_client, id_urgence, nom_intervention, details_intervention, date_cre_int) 
                SELECT :idu, :id_urgence, nom_intervention, details_intervention, CURRENT_TIMESTAMP
                FROM intervention
                WHERE id_intervention = :id_int";
        $sth = $this->link->prepare($sql);
        $sth->bindParam(':idu', $idu, \PDO::PARAM_INT);
        $sth->bindParam(':id_urgence', $id_urgence, \PDO::PARAM_INT);
        $sth->bindParam(':id_int', $id_int, \PDO::PARAM_INT);
        $sth->execute();
    
        return true;
    }

    public function interventionDejaDeclenchee($nom, $idu) {
        $sql = "SELECT COUNT(*) FROM intervention WHERE nom_intervention = :nom AND id_client = :idu AND ";
        $sth = $this->link->prepare($sql);        
        $sth->execute([
            ':nom' => $nom,
            ':idu' => $idu
        ]);
        
        $count = $sth->fetchColumn();
    
        return $count > 0;
    }
}