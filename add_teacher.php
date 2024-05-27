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
        $user_password=$_POST['password'];
        $user_class=$_POST['class'];
        $user_section=$_POST['section'];
        $user_salary=$_POST['salary'];
        $usertype="teacher";

        $check="SELECT * FROM teacher WHERE username='$username'";
        $check_user=mysqli_query($data,$check);
        $row_count=mysqli_num_rows($check_user);
        if ($row_count==1)
            {
                echo "<script type='text/javascript'>
                alert('user already exist. Try another one');</script>";
            }
        

        else{

        

        $sql="INSERT INTO teacher(
            username,password,class,section,salary,usertype) VALUES('$username','$user_password',' $user_class',' $user_class', '$user_salary','$usertype'
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
                <label>Password</label>
                <input type="text" name="password">
            </div>
            <div>
                <label>Class</label>
                <select type="text" name="class" id=class><option>select class</option></select>
                <label>Section</label>
                <select type="text" name="section" id="section"><option>select sec</option></select>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#class').change(function(){
                loadSection($(this).find(':selected').val())
            });
        });

        function loadClass(){
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: { get: 'class' }
            }).done(function(result){
                $('#class').append(result);
            });
        }

        function loadSection(classId){
            $("#section").children().remove();
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: { get: 'section', classId: classId }
            }).done(function(result){
                $("#section").append(result);
            });
        }

        loadClass();
    </script>

</body>
</html>