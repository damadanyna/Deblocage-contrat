1<?php
$host=$_POST['proxi'];
$username="root";
$pass=$_POST['clvohama'];
$database=$_POST['db_name'] ;
$table='contrat';
$vcode=$_POST['v_code'];
 
$con= new mysqli($host,$username,$pass,$database); 
if ($con->connect_error) {
    return($con->connect_error);
}  
 
?>