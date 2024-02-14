<?php 

namespace App;

class Repo{
    protected $link;

    function __construct(){
    $this->link = new \PDO('mysql:host=mysql;dbname=b2-paris', "root", "");
    }
}