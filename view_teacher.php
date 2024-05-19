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

	 $sql="SELECT * from teacher";
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
				<th style="padding:20px; font-size:15px	;">technology</th>	
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
					<?php echo"{$info['technology']}";?></td>

					<td style="padding:20px;">
					<?php echo"{$info['salary']}";?></td>
					
                    <td style="padding:20px;">
					<?php
$student_id = $info['id'];
$encoded_id = base64_encode($student_id);

echo "<a onClick=\"return confirm('Are you sure you want to delete?');\" href='delete2.php?student_id={$encoded_id}'>Delete</a>";
?>

                    </td>
					<td style="padding:20px;">
					<?php
					
$student_id = $info['id'];
$encoded_id = base64_encode($student_id);

echo "<a onClick=\"return confirm('Are you sure you want to update?');\" href='update2.php?student_id={$encoded_id}'>Update</a>";
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