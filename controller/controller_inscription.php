<?php
//define('STDOUT', fopen('php://stdout', 'w'));
include_once('../model/model.php');
class controller_inscription{
    public function inscription(){
        $exp = explode('&',$_POST["loisir"]);
        $imp = implode(",",$exp);
        $exp2 = explode('=',$imp);
        $imp2 = implode(" ",$exp2);
        $exp3 = explode(" ",$imp2);
        $imp3 = implode(" ",$exp3);
        $exp4 = explode(",",$imp3);
        $imp5 = implode(" ",$exp4);
        $exp6 = explode(" ",$imp5);
         $arr_loisir = [];
        if(array_key_exists(1,$exp6)){
            $arr_loisir[] = $exp6[1];
        }
        if(array_key_exists(3,$exp6)){
            $arr_loisir[] = $exp6[3];
        }
        if(array_key_exists(5,$exp6)){
            $arr_loisir[] = $exp6[5];
        }
        if(array_key_exists(7,$exp6)){
            $arr_loisir[] = $exp6[7];
        }
        if(array_key_exists(9,$exp6)){
            $arr_loisir[] = $exp6[9];
        }
        
        $model = new model();
        $model -> inscription($arr_loisir);
    }
}
    $inscription = new controller_inscription;
    $value_inscrip = $inscription -> inscription();
  //  var_dump("VALUE INSCRIPTION => ", $value_inscrip);
?>