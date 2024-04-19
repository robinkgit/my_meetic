<?php 
include('../model/model.php');

class sup_compt{
    public function supprimer(){
        $mod = new model;
        $mod -> delete_account();
    }
}
$ok = new sup_compt;
$ok -> supprimer();