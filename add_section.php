<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
} elseif ($_SESSION['usertype'] == "student") {
    header("location:login.php");
    exit;
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";
$data = mysqli_connect($host, $user, $password, $db);

if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_student'])) {
    $usersections = $_POST['sections'];
    $usertype = "student";

    foreach ($usersections as $usersection) {
        $check = "SELECT * FROM section WHERE section=?";
        $stmt = mysqli_prepare($data, $check);
        mysqli_stmt_bind_param($stmt, "s", $usersection);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "<script type='text/javascript'>alert('Section $usersection already exists. Try another one');</script>";
        } else {
            $sql = "INSERT INTO section (section) VALUES (?)";
            $stmt_insert = mysqli_prepare($data, $sql);
            mysqli_stmt_bind_param($stmt_insert, "s", $usersection);
            $result = mysqli_stmt_execute($stmt_insert);

            if ($result) {
                echo "<script type='text/javascript'>alert('Data uploaded successfully');</script>";
            } else {
                echo "<script type='text/javascript'>alert('Upload data failed');</script>";
            }
            mysqli_stmt_close($stmt_insert);
        }
        mysqli_stmt_close($stmt);
    }
}
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
