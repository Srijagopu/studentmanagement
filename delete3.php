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
if (isset($_GET['class_id']) && !empty($_GET['class_id'])) {
    // Decode the base64 encoded student_id
    $encoded_id = $_GET['class_id'];
    $class_id = base64_decode($encoded_id);

    // Ensure the decoded ID is a valid integer
    if (is_numeric($class_id)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $data->prepare("DELETE FROM classes WHERE id = ?");
        $stmt->bind_param("i", $class_id);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            // Redirect to the view_teacher.php page after successful deletion
            header("Location: View_class.php");
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

// Close the database connection
$data->close();
?>

