<?php
include('../model/model.php');

class connexion{
    public function connexion(){
        $conn = new model;
        $conn -> connexion_user();
    }
}
$valid = new connexion;
//http_response_code(200);
$valid -> connexion();  