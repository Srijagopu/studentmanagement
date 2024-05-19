<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";

$data = mysqli_connect($host, $user, $password, $db);
if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

if(isset($_GET['student_id']) && !empty($_GET['student_id'])) {
    $encoded_id=$_GET['student_id'];
    $userid =base64_decode($encoded_id);

    $sql = "SELECT * FROM section WHERE id = $userid";
    $result = $data->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $usersection = $row["section"];
       
    } else {
        echo "No user found with the provided ID.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $newUsersection = $_POST['section'];
    

    $sql = "UPDATE section SET section='$newUsersection' WHERE id=$userid";

    if ($data->query($sql) === TRUE) {
        echo "<script>alert('Updated Successfully');</script>";
    } else {
        echo "Error updating record: " . $data->error;
    }
}

$data->close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <style type="text/css">
        h1 {
            padding-left: 200px;
        }
        label {
            display: inline-block;
            width: 150px;
            padding: 10px 10px 10px 10px;
        }
        .container {
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-left: 200px;
        }
        select {
            margin-bottom: 20px;
        }
        button {
            margin-left: 17px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_slidebar.php'; ?>
    <div class="container">
        <h1>Add Sections</h1>
        <form id="sectionForm" method="POST" action="">
            <label for="sections">Select Sections:</label>
            <select id="sections" name="sections[]" multiple>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
            </select>
            <div>
                <input type="submit" class="btn btn-primary" name="add_student" value="Add class">
            </div>
        </form>
    </div>
</body>
</html>
