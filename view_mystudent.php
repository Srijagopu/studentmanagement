<?php
session_start();

if(!isset($_SESSION['username']) || $_SESSION['usertype'] == "student") {
    header("location:login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";
$data = mysqli_connect($host, $user, $password, $db);
if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

$teacher_username = $_SESSION['username'];

// Fetch the class and section of the logged-in teacher
$sql_teacher_info = "SELECT class, section FROM teacher WHERE username='$teacher_username'";
$result_teacher_info = mysqli_query($data, $sql_teacher_info);
$row_teacher_info = mysqli_fetch_assoc($result_teacher_info);
$class = $row_teacher_info['class'];
$section = $row_teacher_info['section'];

// Fetch students from the same class and section as the teacher
$sql_students = "SELECT user.username, user.password, user.email, user.phone, classes.class, sections.section
                 FROM user
                 JOIN classes ON user.class = classes.id
                 JOIN sections ON user.section = sections.id
                 WHERE user.usertype = 'student' AND user.class = '$class' AND user.section = '$section'";

$result_students = mysqli_query($data, $sql_students);

// Check if there's any error with the SQL query
if (!$result_students) {
    echo "Error: " . mysqli_error($data);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Students</title>
    <?php include 'admin_css.php'; ?>
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
            <li><a href="add_studentbyteacher.php">Add Student</a></li>
            <li><a href="view_studentbyteacher.php">View Student</a></li>
        </ul>
    </aside>

    <div class="content">
        <center>
            <h1>View Students</h1>
            <table border="1px">
                <tr>
                    <th style="padding:20px; font-size:15px;">Name</th>
                    <th style="padding:20px; font-size:15px;">Password</th>
                    <th style="padding:20px; font-size:15px;">Email</th>  
                    <th style="padding:20px; font-size:15px;">Phone</th>   
                    <th style="padding:20px; font-size:15px;">Class</th>
                    <th style="padding:20px; font-size:15px;">Section</th>
                    <th style="padding:20px; font-size:15px;">Delete</th>
                    <th style="padding:20px; font-size:15px;">Update</th>
                </tr>
                <?php
                // Check if there are any students
                if (mysqli_num_rows($result_students) > 0) {
                    while($info = $result_students->fetch_assoc()) {
                ?>
                <tr>
                    <td style="padding:20px;"><?php echo $info['username']; ?></td>
                    <td style="padding:20px;"><?php echo $info['password']; ?></td>
                    <td style="padding:20px;"><?php echo $info['email']; ?></td>
                    <td style="padding:20px;"><?php echo $info['phone']; ?></td>
                    <td style="padding:20px;"><?php echo $info['class']; ?></td>
                    <td style="padding:20px;"><?php echo $info['section']; ?></td>
                    <td style="padding:20px;">
                        <?php echo "<a onClick=\"return confirm('Are you sure you want to delete?');\" href='delete1.php?student_id={$info['username']}'>Delete</a>"; ?>
                    </td>
                    <td style="padding:20px;">
                        <?php echo "<a onClick=\"return confirm('Are you sure you want to update?');\" href='update.php?student_id={$info['username']}'>Update</a>"; ?>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No students found in the same class and section as the teacher.</td></tr>";
                }
                ?>
            </table>
        </center>
    </div>
</body>
</html>
