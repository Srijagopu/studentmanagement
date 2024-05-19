<?php
error_reporting(0);
session_start();
session_destroy();

if($_SESSION['message'])
{
    $message=$_SESSION['message'];

    echo "<script type='text/javascript'>

    alert('$message');

    </script>";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Student Management System</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    </head>
    <body>
        <nav>
            <label class="logo"> W-School</label>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">Admission</a></li>
                <li><a href="login.php" class="btn btn-sucess">Login</a></li>

            </ul>
        </nav>

        <div class="section1">
            <label class="img_text">We Teach Students With Care</label>

            <img class="main_img" src="class.webp">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="welcome_img" src="colleage.jpg">
                </div>
                <div class="col-md-8">
                    <h1>Welcome to w-school</h1>
                    <p>In most of the world, a college may be a high school or secondary school, a college of further education, a training institution that awards trade qualifications, a higher-education provider that does not have university status (often without its own degree-awarding powers), or a constituent part of a university. In the United States, a college may offer undergraduate programs – either as an independent institution or as the undergraduate program of a university – or it may be a residential college of a university or a community college, referring to (primarily public) higher education institutions that aim to provide affordable and accessible education, usually limited to two-year associate degrees.[1] The word is generally also used as a synonym for a university in the US.[2] Colleges in countries such as France, Belgium, and Switzerland provide secondary education.</p>
                </div>
        </div>
        </div>
        <center>
            <h1>Our Teachers</h1>
        </center>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="teacher"src="teaching.jpg">
                    <p>A teacher, also called a schoolteacher or formally an educator, is a person who helps students to acquire knowledge, competence, or virtue, via the practice of teaching. </p>

                </div>
                <div class="col-md-4">
                <img class="teacher" src="teacher2.webp">
                <p>A teacher is a beautiful gift given by god because god is a creator of the whole world and a teacher is a creator of a whole nation. A teacher is such an important creature in the life of a student.</p>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="teacher3.jpg">
                    <p>Teachers play the role of second parents in imparting life values and helping in our overall development. My teacher is very disciplined and punctual and always comes to class on time. </p>
                </div>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="teacher"src="course1.jpg">
                    <h1>Web development</h1>
                    <p>HTML defines the structure of your content, CSS determines the style and layout, and JavaScript makes the content interactive; therefore, it makes the most sense to learn them in that order.</p>
                    

                </div>
                <div class="col-md-4">
                <img class="teacher" src="course2.jpg">
                <h1>Graphics Design</h1>
                <p>Graphic designers create visual concepts, using computer software or by hand, to communicate ideas that inspire, inform, and captivate consumers. </p>
                
            </div>
                <div class="col-md-4">
                    <img class="teacher" src="course3.webp">
                    <h1>Marketing</h1>
                    <p>Marketing consists of many activities including: identifying customer needs; developing goods and services to satisfy those needs; communicating information</p>
                    
            </div>

        </div>

        <center>
            <h1> Admission Form </h1>
        </center>

        <div align="center" class="admission_form">
            <form action="data_check.php" method="POST">
                <div class="adm_in">
                    <label class="label_text">Name</label>
                    <input class="input_deg" type="text" name="name">
                </div>
                <div class="adm_in">
                    <label class="label_text">Email</label>
                    <input class="input_deg" type="text" name="email">
                </div>
                <div class="adm_in">
                    <label class="label_text">Phone</label>
                    <input class="input_deg" type="text" name="phone">
                </div>
                <div class="adm_in">
                    <label class="label_text">Message</label>
                    <textarea class="input_txt" name="message"></textarea>
                </div>
                <div class="adm_in">
                    <input class="btn btn-primary" id="submit"type="submit" value="apply" name="apply">
                </div>
            </form>
            
        </div>
    </body>
</html