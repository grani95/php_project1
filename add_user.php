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
                <form class="needs-validation" method = "POST" novalidate>
        <fieldset>
          <legend>بيانات الموظف</legend>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">رقم الموظف</label>
                  <input type="text" class="form-control" name = "emp_id"  placeholder="رقم الموظف" required>
              
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">إسم الموظف</label>
                  <input type="text" class="form-control" name = "emp_name" placeholder="إسم الموظف" required>
              
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">إسم الأب</label>
                  <input type="text" class="form-control" name = "emp_father_name" placeholder="إسم الأب" required>
            
                </div>
              
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustomUsername">اللقب</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name = "emp_sur_name" placeholder="اللقب" required>
                 
                    </div>
                  </div>
                <div class="col-md-6 mb-3">
                  <label for="validationCustom03">تاريخ الميلاد</label>
                  <input type="date" class="form-control" name = "birth_date" placeholder="تاريخ الميلاد" required>
              
                </div>
                  <div class="col-md-6 mb-3">
                      <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline1" name="state" value = 1 checked class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline1"  >مفعل</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="customRadioInline2" name="state" value = 0  class="custom-control-input">
                          <label class="custom-control-label" for="customRadioInline2" >غير مفعل</label>
                        </div>
                
                  </div>

        </fieldset>
<fieldset>
  <legend>بيانات الراتب </legend>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">الصفة</label>
                  <select class="form-control" name = "emp_identity" placeholder="الصفة" required>
               
                <?php  $identities = GetIdentities();
                if(!empty($identities)){
                               foreach($identities as $identity){

echo "<option value =  ".$identity[0].">".$identity[1]."</option>";

                }
                }
   
                
                ?>

                  <!-- <option value = 1 >مدير</option>
                      <option value =  2>موظف</option>
                      <option value = 3 >سكريتير</option>
                      <option value = 4 >رئيس قسم</option>
                      <option value = 5 >مدير عام</option> -->
                     

                </select>

                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">الدرجة</label>
                  <select class="form-control" name = "emp_degree" required>
                 
                  <?php  $degrees = GetDegrees();
                if(!empty($degrees)){
                    foreach($degrees as $degree){

echo "<option value =  ".$degree[0].">".$degree[1]."</option>";

                }
                }
              
                
                ?>
                  <!-- <option value = 1 >الأولي</option>
                      <option value =  2>التانية</option>
                      <option value = 3 >التالتة</option>
                      <option value = 4 >الرابعة</option>
                      <option value = 5 >الخامسة</option>
                      <option value = 6 >السادسة</option>
                      <option value = 7 >السابعة</option>
                      <option value = 8 >التامنة</option> -->


                </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">القسم</label>
                  <select class="form-control" name = "emp_dep" placeholder="القسم" required>
               
                                 <?php 
                                  $departments = GetDepartments();
               if(!empty($departments)){
                  foreach($departments as $department){

echo "<option value =  ".$department[0].">".$department[1]."</option>";

                }
               } 
               
                
                ?>
                  
                  <!-- <option value = 1 >صيانة كمبيوتر</option>
                      <option value =  2>هندسة شبكات</option>
                      <option value = 3 >هندسة برمجيات</option>
                      <option value = 4 >تحليل نظم معلومات</option>
                      <option value = 5 >محاسبة</option>
                      <option value = 6 >موارد بشرية</option>
                      <option value = 7 >هندسة إتصالات</option>
                      <option value = 8 >قانون</option> -->
</select>
                </div>
                
              </div>
              <div class = "form-row">
                <div class="col-md-4 mb-3">
                    <label class="sr-only" for="inlineFormInputGroup">المرتب</label>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                      </div>
                      <input type="number" class="form-control" name = "salary_value"  id="inlineFormInputGroup" placeholder="المرتب">
                    </div>
                  </div>
<div class="col-md-6 mb-3">
                                                 <button class="btn btn-primary" type="submit" name = "add_user" id = "add_user_btn">إضافة</button>

                        </div>
              </div>

</fieldset>

                        

                  </form>
       <div class= "row">
<div class = "col-lg-12" >
    <?php


if(isset($_POST['add_user'])){
  unset($_POST['add_user']);
  //print_r($_POST);
  if(Validate($_POST)){
  
    try{

      $conn = Connection("root","");
            
      $conn -> beginTransaction();
      $sql1 = $conn ->
           prepare('INSERT INTO emploies(emp_id, emp_name, emp_father_name, emp_sur_name, birth_date, state) VALUES 
                                        (:emp_id,:emp_name,:emp_father_name,:emp_sur_name,:birth_date,:emp_state) ');               
                                
      $sql2 = $conn ->
          prepare('INSERT INTO emp_salaries(emp_id, salary_value, emp_identity, emp_degree, emp_dep) VALUES 
                                        (:emp_id,:salary_value,:emp_identity,:emp_degree,:emp_dep) ');               
                                                     
         $sql1 -> execute([':emp_id' => $_POST['emp_id'],':emp_name' => $_POST['emp_name'],':emp_father_name' => $_POST['emp_father_name'],
                         ':emp_sur_name' => $_POST['emp_sur_name'],':birth_date' => $_POST['birth_date'],':emp_state' => $_POST['state']]);
                        
                        
           $sql2 -> execute([':emp_id' => $_POST['emp_id'],':salary_value' => $_POST['salary_value'],':emp_identity' => $_POST['emp_identity'],
                         ':emp_degree' => $_POST['emp_degree'],':emp_dep' => $_POST['emp_dep']]);
   
                  $conn -> commit();
                         //echo $sql;
        
           echo "<div class = 'alert alert-success' >لقد تم إضافة المستخدم بنجاح</div>";
        
         }catch(Exception $e){
           $conn -> rollback();
           echo "<div class = 'alert alert-danger' >لقد حدث خطأ</div>";
          //echo $e;
        }







 }else{

    echo "<div class = 'alert alert-danger'>الرجاء التأكد من تعبأت جميع الخانات *</div> ";

  }  
    

}else{
  echo "";
}
?>
<div class = "alert" id = "result"></div>

</div>

       </div>           
                  <!-- <script>
                  // Example starter JavaScript for disabling form submissions if there are invalid fields
                  (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                      // Fetch all the forms we want to apply custom Bootstrap validation styles to
                      var forms = document.getElementsByClassName('needs-validation');
                      // Loop over them and prevent submission
                      var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                          if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
 }else{
   addUser();

 }
                          form.classList.add('was-validated');
                        
                        }, false);
                      });
                    }, false);
        function addUser(){

            var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText){
                    document.getElementById("result").innerHTML = "";
                    document.getElementById("result").classList.remove("alert-danger ")         
                    document.getElementById("result").innerHTML = "لقد تم إضافة المستخدم بنجاح ";
                    document.getElementById("result").classList.add("alert-success")
                                }else{
                     document.getElementById("result").innerHTML = "";
                    document.getElementById("result").classList.remove("alert-success")         
                    document.getElementById("result").innerHTML = "لقد حدث خطأ";
                    document.getElementById("result").classList.add("alert-danger")

                }
            }
        };
        xmlhttp.open("POST", "localhost:8080/index.php?addUser=1",false);
        var data={"name":"مريم"}
        xmlhttp.withCredentials = false;

        xmlhttp.send();
            }   
 var add_btn = document.getElementById("add_user_btn");
add_btn.addEventListener("click",function(e){
e.preventDefault();
addUser();

})

                  })();
                  </script>-->
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