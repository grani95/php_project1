<?php
require 'globalFunction.php';

if(isset($_GET['delete_emp']) && !empty($_GET['emp_id'])){

    try{ 
        $conn = Connection("root","");
        $conn -> beginTransaction();

        $sql1 = $conn -> query("delete from emploies where emp_id = ".$_GET['emp_id']);
        $sql2 = $conn -> query("delete from emp_salaries where emp_id = ".$_GET['emp_id']);
        $sql3 = $conn -> query("delete from employee_events where emp_id = ".$_GET['emp_id']);
      
        $conn -> commit();
      header("location:index.php");
      }catch(Exception $e){
      $conn -> rollback();
      echo $e;
      }  
 
}


?>