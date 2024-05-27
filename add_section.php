<?php
session_start();
    if(!isset($_SESSION['username']))
    {
        header("location:login.php");
    }

    elseif($_SESSION['usertype']=="student")
    {
        header("location:login.php");
    }

    $host="localhost";
    $user="root";
    $password="";
    $db="schoolmanagement";
    $data = mysqli_connect($host, $user, $password, $db);
    if(isset($_POST['add_section'])){
        $usersection=$_POST['section'];
       

        $check="SELECT * FROM sections WHERE section='$usersection'";
        $check_user=mysqli_query($data,$check);
        $row_count=mysqli_num_rows($check_user);
        if ($row_count==1)
            {
                echo "<script type='text/javascript'>
                alert('user already exist. Try another one');</script>";
            }
        

        else{

        

        $sql="INSERT INTO sections (section) VALUES('$usersection')";
        $result=mysqli_query($data,$sql);
        if($result)
        {
            echo "<script type='text/javascript'>
            alert('Data uploaded success');</script>";
        }
        else{

            echo "Upload data failed";

        }
    }

    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <style type="text/css">
        h1 {
            padding-left: 200px;
        }
        label {
            display: inline-block;
            width: 150px;
            padding: 10px 10px 10px 10px;
        }
        .container {
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-left: 200px;
        }
        select {
            margin-bottom: 20px;
        }
        button {
            margin-left: 17px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_slidebar.php'; ?>

    <div class="container">
        <h1>Add Sections</h1>
        <form id="sectionForm" method="POST" action="">
            <label for="section">Section</label>
            <input type="text" name="section" id="section" required>
           
            <div style="padding-top: 2%;">
                <input type="submit" class="btn btn-primary" name="add_section" value="Add Section">
            </div>
        </form>
    </div>
</body>
</html>
