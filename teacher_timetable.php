<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
} elseif ($_SESSION['usertype'] != 'teacher') {
    header('Location: login.php');
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";

$data = mysqli_connect($host, $user, $password, $db);
if ($data->connect_errno) {
    die("Connection failed: " . $data->connect_error);
}

$teacher_username = $_SESSION['username'];

$stmt = $data->prepare("SELECT id FROM teacher WHERE username = ?");
$stmt->bind_param("s", $teacher_username);
$stmt->execute();
$result = $stmt->get_result();
$teacher = $result->fetch_assoc();
$teacher_id = $teacher['id'];

$stmt = $data->prepare("SELECT c.class, s.section, p.period, t.day_of_week 
                        FROM timetable t
                        JOIN classes c ON t.class_id = c.id
                        JOIN sections s ON t.sec_id = s.id
                        JOIN periods p ON t.time_id = p.id
                        WHERE t.teacher_id = ?");
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

$timetable = [
    'Monday' => ['', '', '', '', ''],
    'Tuesday' => ['', '', '', '', ''],
    'Wednesday' => ['', '', '', '', ''],
    'Thursday' => ['', '', '', '', ''],
    'Friday' => ['', '', '', '', ''],
];

while ($row = $result->fetch_assoc()) {
    $day = $row['day_of_week'];
    $period = $row['period'];
    $class_section = "{$row['class']} {$row['section']}";

    switch ($period) {
        case 'period-1':
            $timetable[$day][0] = $class_section;
            break;
        case 'period-2':
            $timetable[$day][1] = $class_section;
            break;
        case 'period-3':
            $timetable[$day][2] = $class_section;
            break;
        case 'period-4':
            $timetable[$day][3] = $class_section;
            break;
        case 'period-5':
            $timetable[$day][4] = $class_section;
            break;
    }
}

$stmt = $data->prepare("SELECT DISTINCT c.class, s.section 
                        FROM timetable t
                        JOIN classes c ON t.class_id = c.id
                        JOIN sections s ON t.sec_id = s.id
                        WHERE t.teacher_id = ?");
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$class_section_result = $stmt->get_result();

$assigned_classes = [];
while ($row = $class_section_result->fetch_assoc()) {
    $assigned_classes[] = "Class: " . $row['class'] . " Section: " . $row['section'];
}

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

            <li>
                <a href="teacher_timetable.php"> View Timetable</a>
                                </li>
			


		</ul>


	</aside>
	
    <h1>Your Timetable</h1>
    <center>
   
    <table border="1">
    <tr>
                <th style="padding:20px; font-size:15px	;"></th>
				<th style="padding:20px; font-size:15px	;">Period-1</th>
				<th style="padding:20px; font-size:15px	;">Period-2</th>	
				<th style="padding:20px; font-size:15px	;">Period-3</th>	
				<th style="padding:20px; font-size:15px	;">Period-4</th>	
                <th style="padding:20px; font-size:15px	;">Period-5</th>
				
	
				</tr>
        <tbody>
            <?php foreach ($timetable as $day => $periods): ?>
                <tr>
                    <th style="padding:20px; font-size:15px	;"><?php echo htmlspecialchars($day); ?></th>
                    <?php foreach ($periods as $period): ?>
                        <td style="padding: 20px;"><?php echo $period ? htmlspecialchars($period) : '--'; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </center>
   
</body>
</html>
<?php
$stmt->close();
$data->close();
?>
