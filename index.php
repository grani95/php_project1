<!DOCTYPE html>
<html dir = "rtl" >
<head>
    <meta charset="utf-8"/>
    <?php
require 'globalFunction.php';
?>
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
                <th scope="col">#</th>
                <th scope="col">إسم الموظف</th>
                <th scope="col">تاريخ الميلاد</th>
                <th scope="col">تاريخ الإضافة</th>
                <th scope="col">الحالة</th>
                <th scope="col"></th> 
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            <?php
            try{

$conn = Connection("root","");
$sql = $conn -> query("select emp_id,CONCAT(emp_name ,' ',emp_father_name,' ',emp_sur_name) as emp_name, birth_date,inserting_date,state from emploies");
$result = $sql -> fetchAll();
if(count($result) > 0){
    foreach($result as $key => $value ){
?><tr>
<td><?php echo $value[0];?></td>
<td><?php echo$value[1];?></td>
<td><?php echo $value[2];?></td>
<td><?php echo $value[3];?></td>
<td><?php if($value[4] == 1){echo "مفعل";}else{echo "غير مفعل";}?></td>
<td><button class = "btn btn-success" onClick = window.location="update_employee_data.php?emp_id=<?php echo $value[0];?>">تعديل</button></td>
<td><button class = "btn btn-danger" onClick = 'delete_employee( <?php echo $value[0];?>,<?php echo '"'.$value[1].'"';?>)' >حذف</button></td>
<td><button class = "btn btn-primary" onClick = window.location="edite_employee_salary.php?emp_id=<?php echo $value[0];?>">تعديل المرتب الشهري</button></td>
</tr>
<?php
}
}else{

    echo "<tr><td>لا توجد بيانات لعرضها</td></tr>";
}

}catch(Exeption $e){


            }
            
            ?>
    <script> 
    
    function delete_employee(emp_id,emp_name){
var conferm = confirm("هل أنت متأكد من حذف الموظف "+emp_name+" ؟");

if(conferm){
window.location = 'controller.php?emp_id='+emp_id+'&delete_emp';
  
 }
    } 
    </script>

            </tbody>
          </table>
            </div>
                    </div> 
        
       
          
       

        </div>

    </div>
</div>

<div class = "row" id = "footer" >

<div class="col-md-12">

</div>

</div> 
</body>
</html>