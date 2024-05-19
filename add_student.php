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
    if(isset($_POST['add_student'])){
        $username=$_POST['name'];
        $user_email=$_POST['email'];
        $user_phone=$_POST['phone'];
        $user_technology=$_POST['technology'];
        $user_password=$_POST['password'];
        $usertype="student";

        $check="SELECT * FROM user WHERE username='$username'";
        $check_user=mysqli_query($data,$check);
        $row_count=mysqli_num_rows($check_user);
        if ($row_count==1)
            {
                echo "<script type='text/javascript'>
                alert('user already exist. Try another one');</script>";
            }
        

        else{

        

        $sql="INSERT INTO user(
            username,email,phone,technology,usertype,password) VALUES('$username',' $user_email', '$user_phone','$user_technology',
           '$usertype', '$user_password')";
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
    label 
    {
        display: inline-block;
        text-align: right;
        width:100px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    </style>

<?php
include 'admin_css.php';
?>
</head>
<body>
<?php
include 'admin_slidebar.php';
?>
	

	<div class="content">
        <center>
		<h1>Add Student</h1>
        <form action="" method="POST">
            <div>
                <label>Username</label>
                <input type="text" name="name">
            </div>
            <div>
            <label>email</label>
                <input type="text" name="email">
        </div>
        <div>
                <label>phone</label>
                <input type="text" name="phone">
            </div>
            <div>
                <label>technology</label>
                <input type="text" name="technology">
            </div>
            <div>
                <label>password</label>
                <input type="text" name="password">
            </div>
            <div>
                <input type="Submit" class="btn btn-primary"name="add_student" value="Add Student">
            </div>
</center>

                
                
            </div>
        </form>

	</div>

</body>
</html>