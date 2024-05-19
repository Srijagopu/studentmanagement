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
    $userid = $_GET['student_id'];

    $sql = "SELECT * FROM user WHERE id = $userid";
    $result = $data->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $email = $row["email"];
        $phone = $row["phone"];
        $password = $row["password"];

    } else {
        echo "No user found with the provided ID.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update user details in the database
    $newUsername = $_POST['name'];
    $newemail = $_POST['email'];
    $newphone = $_POST['phone'];
    $newtechnology = $_POST['technology'];
    $newpassword = $_POST['password'];

    $sql = "UPDATE user SET username='$newUsername', email='$newemail', phone='$newphone',technology='$newtechnology', password='$newpassword' WHERE id=$userid";

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
<?php
include 'admin_slidebar.php';
?>

<div class="content">
        <center>
		<h1>Update Student</h1>
        <form action="" method="POST">
            <div>
                <label>Username</label>
                <input type="text" name="name">
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
                <label>technology</label>
                <input type="text" name="technology">
            </div>
            <div>
                <label>password</label>
                <input type="text" name="password">
            </div>
            <div>
                <input type="Submit" class="btn btn-primary"name="add_student" value="Update Student">
            </div>
</center>

                
                
            </div>
        </form>

	</div>

</body>
</html>	

