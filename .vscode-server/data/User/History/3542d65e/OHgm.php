<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}

$photo = $_SESSION['user']['photo'];

$interventions = $page->RepoUser->getInterventionbyidu($_SESSION['user']['idu']);
public function getInterventionsParIntervenant($idIntervenant) {
    // Requête pour récupérer les interventions associées à l'idIntervenant
    $sql = "SELECT i.* FROM intervention i 
            INNER JOIN intervention_intervenant ii ON i.id_intervention = ii.id_intervention 
            WHERE ii.id_intervenant = :idIntervenant";

    $sth = $this->link->prepare($sql);
    $sth->bindParam(':idIntervenant', $idIntervenant, \PDO::PARAM_INT);
    $sth->execute();

    // Récupération des interventions sous forme d'un tableau d'objets ou d'associatif
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}


echo $page->render('intervenant.html.twig', ['interventions' => $interventions,
'photo' => $photo]);
