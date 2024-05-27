<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'schoolmanagement');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT classes.class, sections.section, teacher.username, periods.period, timetable.day_of_week
        FROM timetable
        JOIN classes ON timetable.class_id = classes.id
        JOIN sections ON timetable.sec_id = sections.id
        JOIN teacher ON timetable.teacher_id = teacher.id
        JOIN periods ON timetable.time_id = periods.id
        ORDER BY timetable.day_of_week, periods.period";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <center>
    <?php include 'admin_slidebar.php'; ?>

    <div class="content">
		<center>
		
        <h1>View Teacher</h1>
		<table border="1px">
			<tr>
				<th style="padding:20px; font-size:15px	;">Class</th>
				<th style="padding:20px; font-size:15px	;">Section</th>	
				<th style="padding:20px; font-size:15px	;">Teacher</th>	
				<th style="padding:20px; font-size:15px	;">Period</th>	
                <th style="padding:20px; font-size:15px	;">Day</th>
	
				</tr>
				
				<?php

				while($info=$result->fetch_assoc()){

				
				?>
				<tr>
					<td style="padding:20px;">
					<?php echo"{$info['class']}";?>
				</td>

					<td style="padding:20px;">
					<?php echo"{$info['section']}";?></td>

					
					<td style="padding:20px;">
					<?php echo"{$info['username']}";?></td>


					<td style="padding:20px;">
					<?php echo"{$info['period']}";?></td>

                    </td>

                    <td style="padding: 20px;">
                    <?php echo"{$info['day_of_week']}";?> </td>

				
				</tr>
				<?php
				}
				?>
		</table>
		</center>

	</div>

</body>
</html>