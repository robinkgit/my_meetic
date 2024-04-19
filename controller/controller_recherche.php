<?php
include('../model/model.php');
//define('STDOUT', fopen('php://stdout', 'w'));


class recherche_genre{
    public function recherche_par_genre(){
        $recherche_genre = new model;
        $recherche_genre -> recherche_genre();
    }
}

class recherche_age{
    public function recherche_par_age(){

        if($_POST['age'] =='18/25'){
            $recherche_age = new model;
            $recherche_age -> recherche_age_18_25();
            //recherche_18_25();
        }
        if($_POST['age'] == '25/35'){
            $recherche_age = new model;
            $recherche_age -> recherche_age_25_35();
            //recherche_18_25();
        }
        if($_POST['age'] == '35/45'){
            $recherche_age = new model;
            $recherche_age -> recherche_age_35_45();
            //recherche_18_25();
        }
        if($_POST['age'] == '45+'){
            $recherche_age = new model;
            $recherche_age -> recherche_age_35_45();
            //recherche_18_25();
        }
    }
}

class recherche_ville{
    public function recherche_par_ville(){
       
        
        $query2 = new model;
        $query2 -> ville();
       // fwrite(STDOUT, print_r($arr_ville, true));
    }
}

class recherche_loisir{
    public function recherche_par_loisir(){
        $query3 = new model;
        $query3 -> loisir();
    }
}

class recherche_genre_age{
    public function recherche_par_genre_age(){
        $query4 = new model();
        $query4 -> recherche_genre_age();
    }
}

class recherche_genre_loisir{
    public function recherche_par_genre_loisir(){
        $query4 = new model();
        $query4 -> recherche_genre_loisir();
    }
}

class recherche_genre_ville{
    public function recherche_par_genre_ville(){
        $query5 = new model();
        $query5 -> recherche_genre_ville();
    }
}

class recherche_ville_loisir{
    public function recherche_par_ville_loisir(){
        $query6 = new model();
        $query6 -> recherche_ville_loisir();
    }
}

class recherche_ville_age{
    public function recherche_par_ville_age(){
        $query7 = new model();
        $query7 -> recherche_ville_age();
    }
}

class recherche_loisir_age{
    public function recherche_par_loisir_age(){
        $query8 = new model();
        $query8 -> recherche_loisir_age();
    }
}
class recherche_all{
    public function recherche_all_filtre(){
        $query9 = new model();
        $query9 -> all();
    }
}

class recherche_triple_1{
    public function recherche_triple_filtre_1(){
        $query10 = new model();
        $query10 -> triple1();
    }
}

class recherche_triple_2{
    public function recherche_triple_filtre_2(){
        $query10 = new model();
        $query10 -> triple2();
    }
}

class recherche_triple_3{
    public function recherche_triple_filtre_3(){
        $query10 = new model();
        $query10 -> triple3();
    }
}

class recherche_triple_4{
    public function recherche_triple_filtre_4(){
        $query10 = new model();
        $query10 -> triple4();
    }
}


if($_POST['genre'] !== "" && $_POST['age'] == "" && !array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_genre();
    $query1 -> recherche_par_genre();
}

if($_POST['genre'] == "" && $_POST['age'] !== "" && !array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_age();
    $query1 -> recherche_par_age();
}

if($_POST['genre'] == "" && $_POST['age'] == "" && array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_ville();
    $query1 -> recherche_par_ville();
}
if($_POST['genre'] == "" && $_POST['age'] == "" && !array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_loisir();
    $query1 -> recherche_par_loisir();
}
   //fwrite(STDOUT, print_r($_POST, true));

if($_POST['genre'] !== "" && $_POST['age'] !== "" && !array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_genre_age();
    $query1 -> recherche_par_genre_age();
}
if($_POST['genre'] !== "" && $_POST['age'] == "" && !array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_genre_loisir();
    $query1 -> recherche_par_genre_loisir();
}
if($_POST['genre'] !== "" && $_POST['age'] == "" && array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_genre_ville();
    $query1 -> recherche_par_genre_ville();
}
if($_POST['genre'] == "" && $_POST['age'] == "" && array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_ville_loisir();
    $query1 -> recherche_par_ville_loisir();
}
if($_POST['genre'] == "" && $_POST['age'] !== "" && array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_ville_age();
    $query1 -> recherche_par_ville_age();
}
if($_POST['genre'] == "" && $_POST['age'] !== "" && !array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_loisir_age();
    $query1 -> recherche_par_loisir_age();
}
if($_POST['genre'] !== "" && $_POST['age'] !== "" && array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_all();
    $query1 -> recherche_all_filtre();
}
if($_POST['genre'] !== "" && $_POST['age'] == "" && array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_triple_1();
    $query1 -> recherche_triple_filtre_1();
}
if($_POST['genre'] !== "" && $_POST['age'] !== "" && !array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_triple_2();
    $query1 -> recherche_triple_filtre_2();
}
if($_POST['genre'] !== "" && $_POST['age'] !== "" && array_key_exists("ville", $_POST) && !array_key_exists("loisir", $_POST)){
    $query1 = new recherche_triple_3();
    $query1 -> recherche_triple_filtre_3();
}
if($_POST['genre'] == "" && $_POST['age'] !== "" && array_key_exists("ville", $_POST) && array_key_exists("loisir", $_POST)){
    $query1 = new recherche_triple_4();
    $query1 -> recherche_triple_filtre_4();
}   
?>