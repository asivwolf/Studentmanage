<?php
session_start();
$user=$_POST["user"];
$pass=$_POST["pass"];
$pwd = md5($pass);

require_once('./config/database.php');//连接数据库

$com1 = "SELECT sid FROM user_student WHERE sid='$user' AND pwd='$pwd'";
$com2 = "SELECT adminID FROM user_admin WHERE adminID='$user' AND pwd='$pwd'";

$result1=mysqli_query($db,$com1);
$result2=mysqli_query($db,$com2);
if($result1->num_rows>0){
    $_SESSION["login"]=true;
    $_SESSION["user"]=$user;
    header ("Location: "."./user/index.php"); 
    exit();
}
else if($result2->num_rows>0){
    $_SESSION["login"]=true;
    $_SESSION["admin"]=$user;
    header ("Location: "."./admin/index.php"); 
    exit();
}
else{
    $_SESSION["login"]=true;
    $_SESSION["user"]=$user;
    $_SESSION["retry"]=1;
    header ("Location: "."./index.php"); 
    exit();
}
 
?>