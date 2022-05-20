<!DOCTYPE html>
<html dir = "rtl" >
<head>
<meta charset="utf-8"/>
<?php
require 'globalFunction.php';



if(isset($_GET['emp_id'])){
    // try{
    
    //     $conn = Connection("root","");
    //     $conn -> beginTransaction();
    
    
    // $conn -> commit();
    // }catch(Exception $e){
    // echo $e;
    // $conn -> rollback();
    
    // }
    
    try{
    
        $conn = Connection("root","");
    $sql = $conn -> query("select * from emploies inner join emp_salaries on 
    emploies.emp_id = emp_salaries.emp_id where emploies.emp_id = ".$_GET['emp_id']);
    $result = $sql -> fetch(PDO::FETCH_ASSOC);
    if(!$result ){
        die('<main> عذرا لا يوجد موظف بهذا الرفم !!</main>');
    }
    
    }catch(Exception $e){
    echo $e;
    
    }
    
    
    }else{
    
    header("location: index.php");
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

        <div class = "row">
            <div class = "col-lg-12">
                <form class="needs-validation" method = "POST" novalidate>
        <fieldset>
          <legend>بيانات الموظف</legend>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">رقم الموظف</label>
                  <input type="number" class="form-control" name = "emp_id"  placeholder="رقم الموظف" value = <?php echo $result['emp_id']; ?> required>
              
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">إسم الموظف</label>
                  <input type="text" class="form-control" name = "emp_name" placeholder="إسم الموظف"  value = "<?php echo $result['emp_name'] ; ?>" required>
              
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">إسم الأب</label>
                  <input type="text" class="form-control" name = "emp_father_name" placeholder="إسم الأب"  value = "<?php echo $result['emp_father_name']; ?>" required>
                </div>
              
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationCustomUsername">اللقب</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name = "emp_sur_name" placeholder="اللقب"  value = "<?php echo  $result['emp_sur_name']; ?>"" required>
                 
                    </div>
                  </div>
                <div class="col-md-6 mb-3">
                  <label for="validationCustom03">تاريخ الميلاد</label>
                  <input type="date" class="form-control" name = "birth_date" placeholder="تاريخ الميلاد"  value = <?php echo  $result['birth_date']; ?> required>
              
                </div>
                <?php
                
                if($result['state'] == 1){
?>
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
<?php
                }else{
?>
                    <div class="col-md-6 mb-3">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="state" value = 1  class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1"  >مفعل</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="state" checked value = 0  class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2" >غير مفعل</label>
                      </div>
                </div>

              
  <?php
                }

?>


<div class = "col-md-3 mb-3" >
                  <button class="btn btn-success" type="submit" name = "edite_emp_data" id = "edite_emp_data_btn">تعديل بيانات الموظف</button>
                </div></div>
<?php

                if(isset($_POST['edite_emp_data'])){
                  unset($_POST['edite_emp_data']);
                  if(Validate($_POST)){
                    try{
                
                      $conn = Connection("root","");
                            
                      $sql = $conn ->
                           prepare('update emploies set emp_id = :emp_id, emp_name = :emp_name, emp_father_name = :emp_father_name, emp_sur_name = :emp_sur_name, birth_date = :birth_date, state = :state where id = :id');               
                                                
                    //   $sql2 = $conn ->
                    //       prepare('INSERT INTO `emp_salaries`(`emp_id`, `salary_value`, `emp_identity`, `emp_degree`, `emp_dep`) VALUES 
                    //                                     (:emp_id,:salary_value,:emp_identity,:emp_degree,:emp_dep) ');               
                                                                     
                         $sql -> execute([':emp_id' => $_POST['emp_id'],':emp_name' => $_POST['emp_name'],
                         ':emp_father_name' => $_POST['emp_father_name'],
                                         ':emp_sur_name' => $_POST['emp_sur_name'],
                                         ':birth_date' => $_POST['birth_date'],':state' => $_POST['state'],
                                         ':id' => $result['id']]);
                                        
                                        
                        //    $sql2 -> execute([':emp_id' => $_POST['emp_id'],':salary_value' => $_POST['salary_value'],':emp_identity' => $_POST['emp_identity'],
                        //                  ':emp_degree' => $_POST['emp_degree'],':emp_dep' => $_POST['emp_dep']]);
                   
                        echo("<meta http-equiv='refresh' content='1'>");

                        echo "<div class = 'alert alert-success' >لقد تمت عملية التعديل علي بيانات المستخدم بنجاح</div>";
                          }catch(Exception $e){
echo $e;
                          echo "<div class = 'alert alert-danger' >لقد حدث خطأ</div>";
                        }
                
               
                 }else{
                
                    echo "<div class = 'alert alert-danger'>الرجاء التأكد من تعبأت جميع الخانات *</div> ";
                
                  }  
                    
                
                }else{
                  echo "";
                }
                
                ?>
            
                  

        </fieldset>
             

</form>
<form class="needs-validation" method = "POST" novalidate>

<fieldset>
  <legend>بيانات الراتب </legend>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">الصفة</label>
                  <select class="form-control" name = "emp_identity" placeholder="الصفة" required>
                  
                  <?php
              
              $identities = GetIdentities();

                  FillList($identities,$result['emp_identity']);
                  ?>
                  <!-- <option value = 1 >مدير</option>
                      <option value =  2>موظف</option>
                      <option value = 3 >سكريتير</option>
                      <option value = 4 >رئيس قسم</option>
                      <option value = 5 >مدير عام</option>
                      -->

                </select>

                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">الدرجة</label>
                  <select class="form-control" name = "emp_degree" required>
                  
                  <?php
              
              $degrees = GetDegrees();

                  FillList($degrees,$result['emp_degree']);
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
              
              $dep = GetDepartments();

                  FillList($dep,$result['emp_dep']);
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
                      <input type="number" class="form-control" name = "salary_value"  id="inlineFormInputGroup"  value = <?php echo  $result['salary_value']; ?>  placeholder="المرتب">
                    </div>
                  </div>
                <div class="col-md-3">
                                                 <button class="btn btn-success" type="submit" name = "edite_emp_salary_data" id = "edite_emp_salary_data_btn">تعديل بينات الراتب </button>

                        </div> 
              </div>
   
                   
</fieldset>

                        

                  </form>
       <div class= "row">
<div class = "col-lg-12" >

<?php

                if(isset($_POST['edite_emp_salary_data'])){
                  unset($_POST['edite_emp_salary_data']);
                  if(Validate($_POST)){
                    try{
                
                      $conn = Connection("root","");
                            
                                                  
                      $sql = $conn ->
                          prepare('update emp_salaries set  salary_value=:salary_value, emp_identity = :emp_identity,
                           emp_degree = :emp_degree, emp_dep = :emp_dep where id = :id');
                                                                     
                         $sql -> execute([':salary_value' => $_POST['salary_value'],
                         ':emp_identity' => $_POST['emp_identity'],
                        ':emp_degree' => $_POST['emp_degree'],':emp_dep' => $_POST['emp_dep'],
                        ':id' => $result['id']]);
                                        
                     
                        echo("<meta http-equiv='refresh' content='1'>");

                        echo "<div class = 'alert alert-success' >لقد تمت عملية التعديل علي بيانات الراتب لهذا الموظف بنجاح</div>";
                          }catch(Exception $e){
echo $e;
                          echo "<div class = 'alert alert-danger' >لقد حدث خطأ</div>";
                        }
                
                
                
                
                
                
                
                 }else{
                
                    echo "<div class = 'alert alert-danger'>الرجاء التأكد من تعبأت جميع الخانات *</div> ";
                
                  }  
                    
                
                }else{
                  echo "";
                }
                
                ?>
            
<!-- oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo -->

</div>

       </div>           

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