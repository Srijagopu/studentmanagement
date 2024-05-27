
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
		<h1>View TimeTable</h1>
        <form action="" method="POST">
            <div>
                <label>Class</label>
                <select type="text" name="class" id=class><option>select class</option></select><br>
                <label>Section</label>
                <select type="text" name="section" id="section"><option>select sec</option></select>
            </div>
       
</center>

                
                
            </div>
        </form>

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