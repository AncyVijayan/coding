<?php
//session_start();
$DB_HOST='localhost';
$DB_USERNAME='root';
$DB_PASSWORD='';
$DB_NAME='invoice_db';
$conn=mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME) or die("there is some problem.....");
$db=mysqli_select_db($conn,$DB_NAME) or die("there is some problem..");
?>
