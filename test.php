<html>
<head>

</head>
<body>
    <p>hello world !!!!!!</p>
<?php
Connection("root","");
function Connection(){
    
    try{
        //$conn = mssql_connect("");
       // echo phpinfo();

        // $conn = new PDO("mysql:server=localhost;Database=alsaheldb","root","");
        //$conn = new PDO("sqlsrv:server=localhost;Database=alsahelDb",'toshiba',null);
         $conn = new PDO("sqlsrv:Server=localhost;Database=alsahelDb;ConnectionPooling=0","maraim",'P@ssw0rd');
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    //       $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     }catch(Exception $e){
    echo $e -> getMessage();

     //die('Error!!');
    }
   // return $conn ;
    }

?>

</body>
</html>
