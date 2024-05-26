<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";

$data = mysqli_connect($host, $user, $password, $db);
if($_GET['student_id']){
    $username=$_GET['student_id'];
    $sql="DELETE FROM user WHERE username='$username'";
    $result=mysqli_query($data,$sql);
    if($result){
        header("location:view_student.php");
    }
}
?>