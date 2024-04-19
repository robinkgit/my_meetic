<?php
session_start();

define('STDOUT', fopen('php://stdout', 'w'));

class model{
    
    public $username = 'robin';
    public $password = 'robin-mysql';



    public function inscription($arr_loisir){
try{
     $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
}catch(PDOException $e){
   echo "erreur: " . $e -> getMessage();
}

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $genre = $_POST['genre'];
    $ville = $_POST['ville'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $connexion -> prepare("SELECT * FROM user WHERE email LIKE '$email'");
    $query -> execute();
    if(!empty($query->fetchAll(PDO::FETCH_ASSOC))){
        echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }else{
   $query = $connexion-> prepare("INSERT INTO user (nom,prenom,date_de_naissance,genre,ville,email) VALUES ('$nom','$prenom','$date','$genre','$ville','$email');");
   $query ->execute();
   $query = $connexion -> prepare("SELECT id FROM user WHERE nom LIKE '%".$_POST['nom']."%';");
   $query->execute();
   $result = $query->fetchAll(PDO::FETCH_ASSOC);
   $arr4=[];
   foreach($result as $rows){
     $arr[] = $rows['id'];
   }
   $imp = implode("",$arr);
   //var_dump($imp);
$query = $connexion -> prepare("INSERT INTO user_password (id_user,password) VALUES ('$imp','$password')");
$query -> execute();

$i = 0;
$j = 0;

foreach($arr_loisir as $value){
   $query = $connexion -> prepare("SELECT id FROM loisir WHERE name LIKE '%".$arr_loisir[$i]."%'");
   $query-> execute();
   $result_loisir = $query -> fetchAll(PDO::FETCH_ASSOC);
   $arr1 = [];
   foreach($result_loisir as $rows){
       $arr1[] = $rows['id'];
   }
   //fwrite(STDOUT, print_r($arr1, true));
   foreach($arr1 as $value_loisir){
       $query = $connexion -> prepare("INSERT INTO user_loisir (id_user,id_loisir) VALUES ('$imp','".$arr1[$j]."')");
       $query -> execute();
   }
    $i++;
}
  // fwrite(STDOUT, print_r($arr_loisir, true));
    $arr = array('ok' => 'valide');
    echo json_encode($arr);
    }
    
}






    public function connexion_user(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }


   $_SESSION['email'] = $_POST["emailco"];
   $_SESSION['password'] = $_POST["passwordco"];
   //fwrite(STDOUT, print_r($_SESSION, true));



    $query = $connexion -> prepare("SELECT password FROM user_password INNER JOIN user ON user_password.id_user = user.id WHERE user.email LIKE '".$_SESSION['email']."'");
    $query -> execute();
    $result_password = $query -> fetchAll(PDO::FETCH_ASSOC);
    $arr_password = [];
    foreach($result_password as $rows_pass){
        $arr_password[] = $rows_pass['password'];
    }

     // fwrite(STDOUT, print_r($arr_password, true));
      if(empty($arr_password)){
        return false;
      }
      $_SESSION['pass'] = $arr_password[0];

    if(password_verify($_SESSION['password'], $arr_password[0])){
            $query = $connexion -> prepare("SELECT active_account FROM user WHERE email LIKE '".$_SESSION['email']."'");
            $query -> execute();
            $result_active = $query -> fetchAll(PDO::FETCH_ASSOC);
            $arr_active = [];
            foreach($result_active as $rows_active){
                $arr_active[] = $rows_active['active_account'];
            }
            if($arr_active[0] == 0){
                return "false";
            }

        $query = $connexion -> prepare("SELECT * FROM user WHERE email LIKE '".$_SESSION['email']."'");
        $query -> execute();
        $result_pass = $query -> fetchAll(PDO::FETCH_ASSOC);
        $arr2 = [];
        foreach($result_pass as $rows_res){
            //fwrite(STDOUT, print_r("WHILE", true));
            $arr2['nom'] = $rows_res['nom'];
            $arr2['prenom'] = $rows_res['prenom'];
            $arr2['date_de_naissance'] = $rows_res['date_de_naissance'];
            $arr2['genre'] = $rows_res['genre'];
            $arr2['ville'] = $rows_res['ville'];
            $arr2['email'] = $rows_res['email'];
            $id = $rows_res['id'];
        }
        $_SESSION['id'] = $id;
        $_SESSION['mail'] = $arr2['email'];
        //  fwrite(STDOUT, print($id));
        $query = $connexion -> prepare("SELECT name FROM loisir INNER JOIN user_loisir ON loisir.id = user_loisir.id_loisir WHERE user_loisir.id_user LIKE '$id'");
        $query -> execute();
        $resultat_loisir = $query -> fetchAll(PDO::FETCH_ASSOC);
        $arr3 = [];
        $k =0;
        foreach($resultat_loisir as $rows_loisir){
            $arr3[] = $rows_loisir["name"];
        }
        $arr4 = array_merge($arr2,$arr3) ;
       // fwrite(STDOUT, print_r($arr4, true));
         echo json_encode($arr4);
    }


    //fwrite(STDOUT, print_r("FINISH", true));

    }



    public function change_mdp(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }

       $actual_mdp  = $_POST["actual_mdp"];
       $new_mdp = $_POST["new_mdp"];

       if(password_verify($actual_mdp, $_SESSION['pass'])){
            $hash_new_mdp = password_hash($new_mdp, PASSWORD_DEFAULT);
            //fwrite(STDOUT, print_r($hash_new_mdp, true));
            $query = $connexion -> prepare("UPDATE user_password SET password = '$hash_new_mdp' WHERE id_user = ".$_SESSION['id']."");
            $query -> execute();
       }
       //session_unset();
    }


    public function change_mail(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }

       $actual_mail = $_POST['actuel_mail'];
       $new_mail = $_POST['new_mail'];

       if($actual_mail = $_SESSION['mail']){
        $query = $connexion -> prepare("UPDATE user SET email = '$new_mail' WHERE id = ".$_SESSION['id']."");
        $query -> execute();
       }
       session_unset();
    }


    public function delete_account(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }

       $query = $connexion -> prepare("UPDATE user SET active_account = false WHERE id = ".$_SESSION['id']."");
       $query -> execute();
      // session_unset();
    }


    public function recherche_genre(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }

        $genre = $_POST['genre'];
        // $age = $_POST['age'];
        // $loisir = $_POST['loisir'];
        // $ville = $_POST['ville'];
        $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE genre LIKE '$genre'");
        $query->execute();
        echo json_encode($query -> fetchAll(PDO::FETCH_NUM));

    }

    public function recherche_age_18_25(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
            $age = $_POST['age'];
            $date = date('m-d');
            $date_26 = '1998-'.$date;
            $query = $connexion-> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
            $query -> execute();
            echo json_encode($query-> fetchAll(PDO::FETCH_NUM));
       // $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville FROM user WHERE d LIKE '$genre'");

    }


    public function recherche_age_25_35(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
            $date = date('m-d');
            $date_26 = '1998-'.$date;
            $age = $_POST['age'];
            $date_36 = '1988-'.$date;
            $query = $connexion-> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
            $query -> execute();
            echo json_encode($query-> fetchAll(PDO::FETCH_NUM));
       // $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville FROM user WHERE d LIKE '$genre'");

    }

    public function recherche_age_35_45(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
            $date = date('m-d');
            $date_46 = '1978-'.$date;
            $age = $_POST['age'];
            $date_36 = '1988-'.$date;
            $query = $connexion-> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
            $query -> execute();
            echo json_encode($query-> fetchAll(PDO::FETCH_NUM));
       // $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville FROM user WHERE d LIKE '$genre'");

    }

    public function recherche_age_45plus(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
            $date = date('m-d');
            $date_46 = '1979-'.$date;
            $age = $_POST['age'];
            $query = $connexion-> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE date_de_naissance <='$date_46'");
            $query -> execute();
            echo json_encode($query-> fetchAll(PDO::FETCH_NUM));
       // $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville FROM user WHERE d LIKE '$genre'");

    }


    public function ville(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
       $ville = "'".implode("','",$_POST['ville'])."'";
            $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE ville IN ($ville)");
            $query -> execute();
            $resultat_brut[ ]= $query -> fetchAll(PDO::FETCH_NUM);
        echo json_encode($resultat_brut);

    }

    public function loisir(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
            $loisir = "'".implode("','",$_POST['loisir'])."'";
            $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir)");
            $query -> execute();
            $resultat_brut[]= $query -> fetchAll(PDO::FETCH_NUM);
            echo json_encode($resultat_brut);

    }


    public function recherche_genre_age(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }
        $genre = $_POST['genre'];
        $age = $_POST['age'];
        // $loisir = $_POST['loisir'];
        // $ville = $_POST['ville'];

        if($_POST['age'] == '18/25'){
            $date = date('m-d');
            $date_26 = '1998-'.$date;
            $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE genre LIKE '$genre' AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
            $query->execute();
            echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
        }elseif($_POST['age'] == '25/35'){
            $date = date('m-d');
            $date_26 = '1998-'.$date;
            $age = $_POST['age'];
            $date_36 = '1988-'.$date;
            $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE genre LIKE '$genre' AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
            $query->execute();
            echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
        }elseif($_POST['age'] == '35/45'){
            $date = date('m-d');
            $date_46 = '1978-'.$date;
            $age = $_POST['age'];
            $date_36 = '1988-'.$date;
            $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE genre LIKE '$genre' AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
            $query->execute();
            echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
        }elseif($_POST['age'] == '45+'){
            $date = date('m-d');
            $date_46 = '1979-'.$date;
            $age = $_POST['age'];
            $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE genre LIKE '$genre' AND date_de_naissance <='$date_46'");
            $query->execute();
            echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
        }
        

    }

    public function recherche_genre_loisir(){
        try{
            $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
       }catch(PDOException $e){
          echo "erreur: " . $e -> getMessage();
       }


       $genre = $_POST['genre'];
       $loisir = $_POST['loisir'];
       $loisir = "'".implode("','",$_POST['loisir'])."'";
       $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE genre LIKE '$genre' AND loisir.name IN ($loisir)");
       $query->execute();
       $resultat_brut[]= $query -> fetchAll(PDO::FETCH_NUM);
       echo json_encode($resultat_brut);
}

public function recherche_genre_ville(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }


   $genre = $_POST['genre'];
  // $ville = $_POST['ville'];


   $ville = "'".implode("','",$_POST['ville'])."'";
   $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE genre LIKE '$genre' AND ville IN ($ville)");
   $query->execute();
   $resultat_brut[]= $query -> fetchAll(PDO::FETCH_NUM);
   echo json_encode($resultat_brut);
}

public function recherche_ville_loisir(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }


  // $genre = $_POST['genre'];
  // $ville = $_POST['ville'];

   $loisir = "'".implode("','",$_POST['loisir'])."'";
   $ville = "'".implode("','",$_POST['ville'])."'";
   $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,vill,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE user.ville IN ($ville) AND loisir.name IN ($loisir)");
   $query->execute();
   $resultat_brut[]= $query -> fetchAll(PDO::FETCH_NUM);
   echo json_encode($resultat_brut);
}

public function recherche_ville_age(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }

   $age = $_POST['age'];
   $ville = "'".implode("','",$_POST['ville'])."'";


   if($_POST['age'] == '18/25'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE ville IN ($ville) AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '25/35'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE ville IN ($ville) AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '35/45'){
    $date = date('m-d');
    $date_46 = '1978-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE ville IN ($ville) AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '45+'){
    $date = date('m-d');
    $date_46 = '1979-'.$date;
    $age = $_POST['age'];
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE ville IN ($ville) AND date_de_naissance <='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}
}



public function recherche_loisir_age(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }

   $age = $_POST['age'];
   $loisir = "'".implode("','",$_POST['loisir'])."'";


   if($_POST['age'] == '18/25'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '25/35'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '35/45'){
    $date = date('m-d');
    $date_46 = '1978-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '45+'){
    $date = date('m-d');
    $date_46 = '1979-'.$date;
    $age = $_POST['age'];
    $query = $connexion -> prepare("SELECT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND date_de_naissance <='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}
}


public function all(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }
   $genre = $_POST['genre'];
   $ville = "'".implode("','",$_POST['ville'])."'";
   $age = $_POST['age'];
   $loisir = "'".implode("','",$_POST['loisir'])."'";


if($_POST['age'] == '18/25'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '25/35'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '35/45'){
    $date = date('m-d');
    $date_46 = '1978-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '45+'){
    $date = date('m-d');
    $date_46 = '1979-'.$date;
    $age = $_POST['age'];
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance <='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}
}


public function triple1(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }


   $genre = $_POST['genre'];
   $loisir = "'".implode("','",$_POST['loisir'])."'";


   $ville = "'".implode("','",$_POST['ville'])."'";
   $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND genre LIKE '$genre' AND ville IN ($ville)");
   $query->execute();
   $resultat_brut[]= $query -> fetchAll(PDO::FETCH_NUM);
   echo json_encode($resultat_brut);
}


public function triple2(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }
   $genre = $_POST['genre'];
  // $ville = "'".implode("','",$_POST['ville'])."'";
   $age = $_POST['age'];
   $loisir = "'".implode("','",$_POST['loisir'])."'";


if($_POST['age'] == '18/25'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '25/35'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '35/45'){
    $date = date('m-d');
    $date_46 = '1978-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '45+'){
    $date = date('m-d');
    $date_46 = '1979-'.$date;
    $age = $_POST['age'];
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.genre LIKE '$genre' AND date_de_naissance <='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}
}



public function triple3(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }
   $genre = $_POST['genre'];
   $ville = "'".implode("','",$_POST['ville'])."'";
   $age = $_POST['age'];


if($_POST['age'] == '18/25'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '25/35'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE  user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '35/45'){
    $date = date('m-d');
    $date_46 = '1978-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '45+'){
    $date = date('m-d');
    $date_46 = '1979-'.$date;
    $age = $_POST['age'];
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user WHERE user.genre LIKE '$genre' AND user.ville IN ($ville) AND date_de_naissance <='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}
}

public function triple4(){
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=meetic', $this->username,$this->password);
   }catch(PDOException $e){
      echo "erreur: " . $e -> getMessage();
   }
   $ville = "'".implode("','",$_POST['ville'])."'";
   $age = $_POST['age'];
   $loisir = "'".implode("','",$_POST['loisir'])."'";


if($_POST['age'] == '18/25'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND  user.ville IN ($ville) AND date_de_naissance BETWEEN '$date_26' AND CURRENT_DATE");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '25/35'){
    $date = date('m-d');
    $date_26 = '1998-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.ville IN ($ville) AND date_de_naissance <='$date_26' AND date_de_naissance >='$date_36'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '35/45'){
    $date = date('m-d');
    $date_46 = '1978-'.$date;
    $age = $_POST['age'];
    $date_36 = '1988-'.$date;
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.ville IN ($ville) AND date_de_naissance <='$date_36' AND date_de_naissance >='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}elseif($_POST['age'] == '45+'){
    $date = date('m-d');
    $date_46 = '1979-'.$date;
    $age = $_POST['age'];
    $query = $connexion -> prepare("SELECT DISTINCT nom,prenom,date_de_naissance,genre,ville,email FROM user INNER JOIN user_loisir ON user.id = user_loisir.id_user INNER JOIN loisir ON user_loisir.id_loisir = loisir.id WHERE loisir.name IN ($loisir) AND user.ville IN ($ville) AND date_de_naissance <='$date_46'");
    $query->execute();
    echo json_encode($query -> fetchAll(PDO::FETCH_NUM));
}
}

}
//fwrite(STDOUT, print_r($valeur, true));