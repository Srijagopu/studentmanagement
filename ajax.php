<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "schoolmanagement";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$classId=isset($_POST['classId'])? $_POST['classId']:0;
$command=isset($_POST['get'])? $_POST['get']: "";

switch($command){
    case "class":
        $statement="SELECT id,class FROM classes";
        $dt=mysqli_query($conn,$statement);
        while ($result=mysqli_fetch_array($dt)){
            echo $result1="<option value=" . $result['id'].">".$result['class']."</option>";
        }
        break;

        case "section":
            $result1="<option>Select Section</option>";
            $statement="SELECT id,section FROM sections WHERE class_id=" . $classId;
            $dt=mysqli_query($conn,$statement);
            while ($result=mysqli_fetch_array($dt)){
                 $result1 .="<option value=" . $result['id'].">".$result['section']."</option>";
            }
            echo $result1;

            break;
        }


