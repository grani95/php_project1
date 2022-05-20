<!DOCTYPE html>
<html dir = "rtl" >
<head>
<meta charset="utf-8"/>
<?php
require 'globalFunction.php';

try{
    
    $conn = Connection("root","");
$sql = $conn -> query("select concat(emploies.emp_name,' ',emploies.emp_father_name,' ',emploies.emp_sur_name) as emp_name,
emp_salaries.salary_value,sum(case employee_events.event_type when 1 then value else 0 end) as burrow, 
sum(case employee_events.event_type when 2 then value else 0 end) as discount,
 sum(case employee_events.event_type when 3 then value else 0 end) as givet
  from emploies left join emp_salaries on emploies.emp_id = emp_salaries.emp_id 
  left join employee_events on emploies.emp_id = employee_events.emp_id 
  and year(employee_events.event_date) = year(getdate())
and month(employee_events.event_date) = month(getdate()) where emploies.emp_id =".$_GET['emp_id']."
 group by emp_name,emp_father_name,emp_sur_name,salary_value");
$result = $sql -> fetch(PDO::FETCH_ASSOC);
if(!$result ){
    die('<main> عذرا لا يوجد موظف بهذا الرفم !!</main>');
}

$net_salary = $result['salary_value'] - ($result['burrow'] + $result['discount'] ) + $result['givet'];
}catch(Exception $e){
//echo $e;
echo "لقد حدث خطأ ";
}


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


        <div class="row">
  <div class = "col-md-4" >الإسم: <?php echo $result['emp_name'];?></div>
<div class = "col-md-4" >الراتب الشهري : <?php echo $result['salary_value'];?></div>
<div class = "col-md-4" >قيمة  صافي المرتب: <?php echo $net_salary;?></div>
</div>  
        <div id = "pt"></div>
        <div class="row">
            <div class = "col-md-4" >قيمة الإستعارة لهذا الشهر : <?php echo $result['burrow'];?></div>
            <div class = "col-md-4" >قيمة الخصم : <?php echo $result['discount'];?></div>
            <div class = "col-md-4" >قيمة المكافئة: <?php echo $result['givet'];?></div>

        </div>
    

        <div id = "pt"></div> 
<div class = "row">
            <div class = "col-lg-12">
  
        <form method = "POST" >
        <div class="form-row">
                <div class="col-md-3 mb-2">
                  <select class="form-control" name = "event_type" placeholder="النوع" required>
                  <option value = 1 >سلفة</option>
                      <option value =  2>خصم</option>
                      <option value = 3 >مكافئة</option>
                
                     

                </select>

                </div>


                <div class="col-md-3 mb-2">
                    <div class="input-group mb-2">
                      <input type="number" class="form-control" name = "value"  id="inlineFormInputGroup" placeholder="القيمة">
                      <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-3 mb-3">
                  <input type="date" class="form-control" name = "event_date" placeholder="تاريخ العملية" required>
                              </div>

                              <div class="col-md-1 mb-1">
                                                 <button class="btn btn-primary" type="submit" name = "edite_salary" id = "edite_salary_btn">إدراج</button>

                        </div>

</div>  


                  </form>

<?php

if(isset($_POST['edite_salary'])){

if($_POST['event_type'] == 1 || $_POST['event_type'] == 2){
$check = subtract($net_salary,$_POST['value']);
if($check < 0 ){
?>
<script>alert("عذرا ليس لديك رصيد كافي")</script>
<?php
return false;
}
}
if(!empty($_POST['value'])){
    try{
        $conn = Connection("root","");
            $sql = $conn ->
            prepare('INSERT INTO employee_events(emp_id, value, event_type, event_date) VALUES 
                                         (:emp_id,:value,:event_type,:event_date) ');               
                                 
                                                    
          $sql -> execute([':emp_id' => $_GET['emp_id'],':value' => $_POST['value'],':event_type' => $_POST['event_type'],
                          ':event_date' => $_POST['event_date'],]);
        
                          echo("<meta http-equiv='refresh' content='1'>");
        echo "<div class = 'alert alert-success' >لقد تم العملية بنجاح </div>";
        
        }catch(exception $e){
        echo $e;
            echo '<div class = "alert alert-danger" >لقد حدث خطأ !!!</div>'; 
        }
    
}else{

    ?>
    <script>alert("الرجاء إدخال القيمة")</script>
    <?php
}
     
}

?>

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