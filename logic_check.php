<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";
$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$name' AND password='$pass'";
    $result = mysqli_query($data, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            if ($row["usertype"] == "student") {

                $_SESSION['username']=$name;

                $_SESSION['usertype']="student";

                header("Location: studenthome.php");
                exit();
            } elseif ($row["usertype"] == "admin") {

                $_SESSION['username']=$name;

                $_SESSION['usertype']="admin";

                header("Location: adminhome.php");
                exit();
            }
            elseif ($row["usertype"] == "teacher") {

                $_SESSION['username']=$name;

                $_SESSION['usertype']="teacher";

                header("Location: teacherhome.php");
                exit();
        } else {
            $message= "Username or password do not match";
    
            $_SESSION['loginMessage']=$message;
            header("location:login.php");
        }
    } else {
        echo "Query execution error: " . mysqli_error($data);
    }
}
}
?>
