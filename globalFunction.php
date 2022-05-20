<?php

function Connection(){
    
    try{
       // $conn = new PDO("mysql:server=localhost;Database=alsaheldb","root","");
       // $conn = new PDO("mysql:server=localhost;dbname=alsaheldb",'root',null,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
       $conn = new PDO("sqlsrv:Server=localhost;Database=alsahelDb;ConnectionPooling=0","admin","admin");

        // $conn = new PDO("sqlsrv:Server=localhost;Database=alsahelDb;ConnectionPooling=0", "toshiba", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
          $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
     $e -> getMessage();
die('Error!!');
    }
    return $conn ;
    }
    
    function Validate($array){
        foreach($array as $key => $value){
          if(empty($value) && !isset($value)){

        return false;
         }
        }
        return true;
        
        }

        function GetIdentities(){
          try{
    
            $conn = Connection("root","");
        $sql = $conn -> query("select id,identity_name from [alsahelDb].[dbo].[identity] where state = 1");
        $result = $sql -> fetchAll(PDO::FETCH_NUM);
        return $result;
        }catch(Exception $e){
        //log error in log file
        
        echo $e;
        
        }

        }

        function GetDepartments(){
          try{
    
            $conn = Connection("root","");
        $sql = $conn -> query("select id,dep_name from [alsahelDb].[dbo].[department] where state = 1");
        $result = $sql -> fetchAll(PDO::FETCH_NUM);
        return $result;
        }catch(Exception $e){
        //log error in log file
        
        //echo $e;
        
        }

        }

        function GetDegrees(){
          try{
    
            $conn = Connection("root","");
        $sql = $conn -> query("select id,degree_name from [alsahelDb].[dbo].[degree] where state = 1");
        $result = $sql -> fetchAll(PDO::FETCH_NUM);
        return $result;
        }catch(Exception $e){
        //log error in log file
        
        //echo $e;
        
        }

        }


function FillList($array,$selected){


  foreach($array as $row){
if($row[0] == $selected){
  echo '<option value = '. $row[0].' selected >'.$row[1].'</option>';


}else{
  echo '<option value = '. $row[0].'>'.$row[1].'</option>';

}
}
}

        function AddGivet($net_salary,$givet_value){
return $net_salary + $givet_value;

}
function subtract($_net_salary,$subtract_value){
@ $net_salary = $_net_salary - $subtract_value;
  return $net_salary;
}
function NetSalaryCalc($salary,$burow_value,$discount_value,$givet_value){
$net_salary = ($salary+$givet_value)-($discount_value+$burow_value);
return $net_salary;

}

?>