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
	 if ($data->connect_error) {
		 die("Connection failed: " . $data->connect_error);
	 }

	 $sql="SELECT user.username, user.password, user.email, user.phone, classes.class, sections.section
	 FROM user
	 JOIN classes ON user.class = classes.id
	 JOIN sections ON user.section= sections.id";
	 $result=mysqli_query($data,$sql);



?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>

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
		
        <h1>view students</h1>
		<table border="1px">
			<tr>
				<th style="padding:20px; font-size:15px	;">Name</th>
				<th style="padding:20px; font-size:15px	;">Password</th>
				<th style="padding:20px; font-size:15px	;">Email</th>	
				<th style="padding:20px; font-size:15px	;">Phone</th>	
				<th style="padding:20px; font-size:15px	;">Class</th>
				<th style="padding:20px; font-size:15px	;">Section</th>
                <th style="padding:20px; font-size:15px	;">Delete</th>
				<th style="padding:20px; font-size:15px	;">Update</th>
	
				</tr>
				
				<?php

				while($info=$result->fetch_assoc()){

				
				?>
				<tr>
					<td style="padding:20px;">
					<?php echo"{$info['username']}";?>
				</td>

				<td style="padding:20px;">
					<?php echo"{$info['password']}";?></td>

					<td style="padding:20px;">
					<?php echo"{$info['email']}";?></td>

					<td style="padding:20px;">
					<?php echo"{$info['phone']}";?></td>

					<td style="padding:20px;">
					<?php echo"{$info['class']}";?></td>
					
					<td style="padding:20px;">
					<?php echo"{$info['section']}";?></td>
					
					

                    <td style="padding:20px;">
                    <?php
echo "<a onClick=\"return confirm('Are you sure you want to delete?');\" href='delete1.php?student_id={$info['username']}'>Delete</a>";
?>

                    </td>
					<td style="padding:20px;">
                    <?php
echo "<a onClick=\"return confirm('Are you sure you want to update?');\" href='update.php?student_id={$info['username']}'>Update</a>";
?>

                    </td>

				
				</tr>
				<?php
				}
				?>
		</table>
		</center>

	</div>

</body>
</html>