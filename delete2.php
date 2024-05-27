<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolmanagement";

// Establish a database connection
$data = new mysqli($host, $user, $password, $db);

// Check the connection
if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

// Check if student_id is provided in the GET request
if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
    // Decode the base64 encoded student_id
    $user_id = $_GET['student_id'];


    // Ensure the decoded ID is a valid integer
    if (is_string($user_id)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $data->prepare("DELETE FROM teacher WHERE username = ?");
        $stmt->bind_param("s", $user_id);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            // Redirect to the view_teacher.php page after successful deletion
            header("Location: view_teacher.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid user ID.";
    }
} else {
    echo "User ID not provided.";
}
$data->close();
?>

