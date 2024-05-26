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

	 $sql="SELECT teacher.name, teacher.salary, classes.class, sections.section
	 FROM teacher
	 JOIN classes ON teacher.class = classes.id
	 JOIN sections ON teacher.section= sections.id";
	 $result=mysqli_query($data,$sql);



?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
<?php

include 'admin_css.php'
?>
</head>
<body>
<?php
 include 'admin_slidebar.php'
 ?>



	<div class="content">
		<center>
		
        <h1>View Teacher</h1>
		<table border="1px">
			<tr>
				<th style="padding:20px; font-size:15px	;">Name</th>
				<th style="padding:20px; font-size:15px	;">Class</th>	
				<th style="padding:20px; font-size:15px	;">Section</th>	
				<th style="padding:20px; font-size:15px	;">Salary</th>	
                <th style="padding:20px; font-size:15px	;">Delete</th>
				<th style="padding:20px; font-size:15px	;">Update</th>
	
				</tr>
				
				<?php

				while($info=$result->fetch_assoc()){

				
				?>
				<tr>
					<td style="padding:20px;">
					<?php echo"{$info['name']}";?>
				</td>

					<td style="padding:20px;">
					<?php echo"{$info['class']}";?></td>

					
					<td style="padding:20px;">
					<?php echo"{$info['section']}";?></td>


					<td style="padding:20px;">
					<?php echo"{$info['salary']}";?></td>
					
					<td style="padding:20px;">
                    <?php
echo "<a onClick=\"return confirm('Are you sure you want to delete?');\" href='delete2.php?student_id={$info['name']}'>Delete</a>";
?>

                    </td>
					<td style="padding:20px;">
                    <?php
echo "<a onClick=\"return confirm('Are you sure you want to update?');\" href='update2.php?student_id={$info['name']}'>Update</a>";
?>

                    </td>

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