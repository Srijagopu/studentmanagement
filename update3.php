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
    
    $newUserclass = $_POST['class'];
    

    $sql = "UPDATE classes SET class='$newUserclass' WHERE id=$userid";

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
		<h1>update teacher</h1>
        <form action="" method="POST">
        
            <div>
                <label>Add Class</label>
                <input type="text" name="class">
            </div>
            
                <input type="Submit" class="btn btn-primary"name="add_class" value="Update Class">
            </div>
</center>

                
                
            </div>
        </form>

	</div>

</body>
</html>