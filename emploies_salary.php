<!DOCTYPE html>
<html dir = "rtl" >
<head>
<?php

require 'globalFunction.php';
?>
<meta charset="utf-8"/>
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">
    <script src="./dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
        <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
        <img src="logo.jpeg" width="40" height="40" class="d-inline-block align-top" alt="">
          YOUR LOGO
        </a>
      </nav>
<div class = "container" >
<div id = "pt"></div> 
    <div class = "row" id = "wellcom_statment" >
        <div class = "col-lg-12" >
            <div class="alert alert-primary" role="alert">
مرحبا بك في منظومة إدارة الموظفين     
         </div>
        </div>
</div>
<div id = "pt"></div> 

        <div class = "row">
<div class = "col-lg-12">
 <ul class="nav justify-content-center">
 <li class="nav-item">
    <a class="nav-link active" href="index.php"> الصفحة الرئيسية</a>
  </li>
            <li class="nav-item">
              <a class="nav-link active" href="add_user.php"> + إضافة مستخدم جديد</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="emploies_salary.php">صرف مرتبات الموظفين لهذا الشهر</a>
            </li>
        
          </ul>
</div>
        </div> 

        <div id = "pt"></div> 

        <div class = "row">
            <div class = "col-lg-12">
               <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">إسم الموظف</th>
                <th scope="col">قيمة الراتب الشهري</th>
                <th scope="col">قيمة السلف</th>
                <th scope="col">قيمة الخصم</th>
                <th scope="col">قيمة المكافئة</th>
                <th scope="col">صافي المرتب</td>

              </tr>
            </thead>
            <tbody>

            <?php
            try{

$conn = Connection("root","");
$sql = $conn -> query("select CONCAT(emploies.emp_name,' ',emploies.emp_father_name,' ',emploies.emp_sur_name) as emp_name,
emp_salaries.salary_value,sum(case employee_events.event_type when 1 then value else 0 end) as burrow, 
sum(case employee_events.event_type when 2 then value else 0 end) as discount,
 sum(case employee_events.event_type when 3 then value else 0 end) as givet
  from emploies left join emp_salaries on emploies.emp_id = emp_salaries.emp_id 
  left join employee_events on emploies.emp_id = employee_events.emp_id 
  and year(employee_events.event_date) = year(getdate())
and month(employee_events.event_date) = month(getdate())
  group by emploies.emp_name,emp_father_name,emp_sur_name,salary_value");
$result = $sql -> fetchAll();
if(count($result) > 0){
    foreach($result as $key => $value ){
?><tr>
<td><?php echo $value[0];?></td>
<td><?php echo$value[1];?></td>
<td><?php echo $value[2];?></td>
<td><?php echo $value[3];?></td>
<td><?php echo $value[4];?></td>
<td><?php
echo $value[1] -($value[2] + $value[3])+$value[4]
?>
</td>

</tr>
<?php
}
}else{

    echo "<tr><td>لا توجد بيانات لعرضها</td></tr>";
}

}catch(Exeption $e){
echo $e;
            }
            
  ?>

            </tbody>
          </table>
            </div>
                    </div> 
        <div id="pt" ></div>
        <?php
        
        if(isset($_GET['update_salary_state'])){
          try{
           $conn = Connection("root","");
           $sql = $conn -> query("UPDATE [dbo].[employee_events]
           SET [state] = 0
         WHERE year(event_date) = year(getdate()) and month(event_date) = month(getdate())");
        if($sql){
echo "<div class = 'alert alert-success' >لقد تم صرف المرتبات لجميع الموظفين لهذا الشهر بنجاح</div>";

        }else{

          echo '<div class = "alert aler-danger" >عذرا لم تتم عملية الإضافة ! </div>';

        }
          }catch(exception $e){
         //echo $e => getMessage(); 
         //echo $e;

         echo '<div class = "alert alert-danger" >لقد حدث خطأ !!!</div>'; 

        }
         }
        ?>
      
      
      
      
      <form method = "GET">
        
       <!-- <buttn type="submit" class = "btn btn-success"   name="update_salary_state">صرف المرتب لهذا الشهر</buttn>         -->
       <button class="btn btn-success" type="submit" name = "update_salary_state" id = "update_salary_state_btn" value = 1>صرف المرتب لهذا الشهر</button>

       </form>
          

        </div>

    </div>
</div>


<div class = "row" id = "footer" >

<div class="col-md-12">

</div>

</div>
</body>
</html>