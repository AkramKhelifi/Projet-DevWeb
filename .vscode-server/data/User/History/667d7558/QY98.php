<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();

if(!$page->session->isConnected()) {
    header('Location: index.php?msg=vous ne pouvez pas entrer !');
}
$photo = $_SESSION['user']['photo'];
<div class="edit_container">
    {% if msg %}
        <div class="success">{{ msg }}</div>
    {% endif %}
    <form action="add.php" method="POST">
        <div class="edit_title">
            <input type="text" id="nom_intervention" name="nom_intervention" placeholder ="Titre...." required>
        </div>

        <div class="edit_body">
            <textarea id="details_intervention" name="details_intervention" placeholder ="Détails..." required></textarea>
        </div>
        
        <button type="submit" name="add" class="edit_button">ADD</button>
    </form>
</div>
<img class="logo" src='images/Logo.jpg'>



echo $page->render('urgences.html.twig', ['photo' => $photo]);