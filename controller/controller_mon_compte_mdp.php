<?php 
include('../model/model.php');

class modif{
    public function modification(){
        $mod = new model;
        $mod -> change_mdp();
    }
}
$ok = new modif;
$ok -> modification();