<?php

include('connection.php');

if (isset($_POST["Import"])) {
    $con = getdb();

    echo $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sql = "INSERT INTO subject (id, name, phone, email, message) 
                    VALUES ('$getData[0]', '$getData[1]', '$getData[2]', '$getData[3]', '$getData[4]')";
            var_dump($sql);
            // Remove exit() to allow the script to continue execution
            // exit();

            // Execute the query
            $result = $con->query($sql);
            if (!$result) {
                echo "<script type=\"text/javascript\">
                        alert(\"Invalid File: Please Upload CSV File.\");
                        window.location = \"import1.php\"
                      </script>";
                exit();
            }
        }
        fclose($file);
        // Success message
        echo "<script type=\"text/javascript\">
                alert(\"CSV File has been successfully Imported.\");
              
              </script>";
    }
}
?>
