<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
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
    <center>
        <h1>Create Timetable</h1>
        <form action="" method="POST">
            <label for="class">Class:</label>
            <select name="class" id="class">
                <!-- PHP code to populate class options -->
                <?php
                $conn = new mysqli('localhost', 'root', '', 'schoolmanagement');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $result = $conn->query("SELECT id, class FROM classes");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['class']}</option>";
                }
                ?>
            </select>
            <br>

            <label for="section">Section:</label>
            <select name="section" id="section">
                <!-- PHP code to populate section options -->
                <?php
                $result = $conn->query("SELECT id, section FROM sections");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['section']}</option>";
                }
                ?>
            </select>
            <br>

            <label for="teacher">Teacher:</label>
            <select name="teacher" id="teacher">
                <!-- PHP code to populate teacher options -->
                <?php
                $result = $conn->query("SELECT id, username FROM teacher");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['username']}</option>";
                }
                ?>
            </select>
            <br>

            <label for="period">Period:</label>
            <select name="period" id="period">
                <!-- PHP code to populate period options -->
                <?php
                $result = $conn->query("SELECT id, period FROM periods");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['period']}</option>";
                }
                ?>
            </select>
            <br>

            <label for="day">Day of the Week:</label>
            <select name="day" id="day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select>
            <br>

            <input type="submit" class="btn btn-primary" value="Add Timetable">
        </form>
    </center>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = new mysqli('localhost', 'root', '', 'schoolmanagement');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $class_id = $_POST['class'];
        $section_id = $_POST['section'];
        $teacher_id = $_POST['teacher'];
        $period_id = $_POST['period'];
        $day_of_week = $_POST['day'];

        $sql = "INSERT INTO timetable (class_id, sec_id, teacher_id, time_id, day_of_week)
                VALUES ('$class_id', '$section_id', '$teacher_id', '$period_id', '$day_of_week')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Timetable updated successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
