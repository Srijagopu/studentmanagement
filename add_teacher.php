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
    if(isset($_POST['add_teacher'])){
        $username=$_POST['name'];
        $user_description =$_POST['technology'];
        $user_salary=$_POST['salary'];
        $usertype="teacher";

        $check="SELECT * FROM teacher WHERE name='$username'";
        $check_user=mysqli_query($data,$check);
        $row_count=mysqli_num_rows($check_user);
        if ($row_count==1)
            {
                echo "<script type='text/javascript'>
                alert('user already exist. Try another one');</script>";
            }
        

        else{

        

        $sql="INSERT INTO teacher(
            name,technology,salary) VALUES('$username',' $user_description', '$user_salary'
        )";
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
		<h1>Add Teacher</h1>
        <form action="" method="POST">
            <div>
                <label>Teacher Name</label>
                <input type="text" name="name">
            </div>
            <div>
            <label>Technology</label>
                <input type="text" name="technology">
        </div>
        <div>
                <label>salary</label>
                <input type="text" name="salary">
            </div>
        
            <div>
                <input type="Submit" class="btn btn-primary"name="add_teacher" value="Add Teacher">
            </div>
</center>

                
                
            </div>
        </form>

	</div>

</body>
</html>