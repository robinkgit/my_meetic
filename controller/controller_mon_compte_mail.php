<?php 
include('../model/model.php');

class modif_mail{
    public function modification_mail(){
        $mod = new model;
        $mod -> change_mail();
    }
}
$ok = new modif_mail;
$ok -> modification_mail();