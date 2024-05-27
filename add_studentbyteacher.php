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
    elseif($_SESSION['usertype']=="admin")
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
        $user_password=$_POST['password'];
        $user_class=$_POST['class'];
        $user_section=$_POST['section'];
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

        

        $sql="INSERT INTO user(username,password,email,phone,usertype,class,section) VALUES('$username','$user_password',' $user_email', '$user_phone',
            '$usertype','$user_class','$user_section' )";
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
<header class="header">
		
		<a href="">Admin Dashboard</a>

		<div class="logout">
			
			<a href="logout.php" class="btn btn-primary">Logout</a>

		</div>

	</header>


	<aside>
		
		<ul>
			
		

			<li>
				<a href="add_studentbyteacher.php">Add Student</a>
			</li>

			<li>
				<a href="view_studentbyteacher.php">View Student</a>
			</li>


		</ul>


	</aside>
	

	<div class="content">
        <center>
		<h1>Add Student</h1>
        <form action="" method="POST">
            <div>
                <label>Username</label>
                <input type="text" name="name">
            </div>

            <div>
                <label>password</label>
                <input type="text" name="password">
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
                <label>Class</label>
                <select type="text" name="class" id=class><option>select class</option></select>
                <label>Section</label>
                <select type="text" name="section" id="section"><option>select sec</option></select>
            </div>

            <div>
                <input type="Submit" class="btn btn-primary"name="add_student" value="Add Student">
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
                })
              
        });

        function loadClass(){
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:'get=class'
            }).done(function(result){
                $(result).each(function(){
                    $('#class').append($(result));

                })
            });
        }

        function loadSection(classId){
            $("#section").children().remove()
            $.ajax({
                type:"POST",
                url:"ajax.php",
                data:{get:'section',classId : classId}
            }).done(function(result){
                $("#section").append($(result));
            });

    
            
        }

        loadClass();
        </script>

</body>
</html>