<?php
include('connection.php');

$con = getdb();

if (isset($_POST["Import"])) {		
    $filename = $_FILES["file"]["tmp_name"];
    echo $filename;
    
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        
        // Skip the header row if there is one
        // fgetcsv($file);

        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            // Ensure there are exactly 5 elements in the array
            if (count($getData) == 5) {
                // Use prepared statements to avoid SQL injection
                $stmt = $con->prepare("INSERT INTO admission (id, name, phone, email, message) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isiss", $getData[0], $getData[1], $getData[2], $getData[3], $getData[4]);
                
                if (!$stmt->execute()) {
                    echo "<script type=\"text/javascript\">
                            alert(\"Invalid File: Please Upload CSV File.\");
                            window.location = \"index.php\"
                          </script>";
                    exit();
                } else {
                    echo "<script type=\"text/javascript\">
                            alert(\"CSV File has been successfully Imported.\");
                          </script>";
                }
                
                $stmt->close();
            } else {
                echo "<script type=\"text/javascript\">
                        alert(\"Invalid File: Please ensure the CSV file has exactly 5 columns.\");
                        window.location = \"index.php\"
                      </script>";
                exit();
            }
        }
        
        fclose($file);
    }
}

if (isset($_POST["Export"])) {
    header('Content-Type: text/csv; charset=utf-8');  
    header('Content-Disposition: attachment; filename=data.csv');  
    $output = fopen("php://output", "w");  
    fputcsv($output, array('ID', 'NAME', 'Phone', 'Email', 'Message'));  
    $query = "SELECT * FROM admission ORDER BY id DESC";  
    $result = mysqli_query($con, $query);  
    while ($row = mysqli_fetch_assoc($result)) {  
        fputcsv($output, $row);  
    }  
    fclose($output);  
}

function get_all_records() {
    $con = getdb();
    $Sql = "SELECT * FROM admission";
    $result = mysqli_query($con, $Sql);  

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
        </tr>
        </thead>
        <tbody>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['id'] . "</td>
                      <td>" . $row['name'] . "</td>
                      <td>" . $row['phone'] . "</td>
                      <td>" . $row['email'] . "</td>
                      <td>" . $row['message'] . "</td></tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "You have no recent pending orders.";
    }
}
?>
