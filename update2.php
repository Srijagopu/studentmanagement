<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
} elseif ($_SESSION['usertype'] == "student") {
    header("location:login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";

$data = new mysqli($host, $user, $password, $db);
if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
    $username = $_GET['student_id'];

    $sql = "SELECT * FROM teacher WHERE username = ?";
    $stmt = $data->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $class = $row["class"];
        $section = $row["section"];
        $salary = $row["salary"];
    } else {
        echo "No user found with the provided ID.";
        exit();
    }
    $stmt->close();
} else {
    echo "User ID not provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update user details in the database
    $newUsername = $_POST['name'];
    $newClass = $_POST['class'];
    $newSection = $_POST['section'];
    $newSalary = $_POST['salary'];

    $sql = "UPDATE teacher SET username=?, class=?, section=?,salary=? WHERE username=?";
    $stmt = $data->prepare($sql);
    $stmt->bind_param("siiis", $newUsername, $newClass, $newSection,  $newSalary,$newUsername);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Updated Successfully');</script>";
    } else {
        echo "Error updating record: " . $data->error;
    }
    $stmt->close();
}

$data->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Student</title>
    <style type="text/css">
        label {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_slidebar.php'; ?>
    <div class="content">
        <center>
            <h1>Update Student</h1>
            <form action="" method="POST">
                <div>
                    <label>Username</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($username); ?>">
                </div>
               
                <div>
                <label>Class</label>
                <select type="text" name="class" id=class><option>select class</option></select>
                <label>Section</label>
                <select type="text" name="section" id="section"><option>select sec</option></select>
            </div>
                <div>

                <div>
                    <label>Salary</label>
                    <input type="text" name="salary" id="salary" value="<?php echo htmlspecialchars($salary); ?>">
                </div>
                    <input type="submit" class="btn btn-primary" value="Update Student">
                </div>
            </form>
        </center>
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
