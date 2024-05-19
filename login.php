<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login Form</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body >
        <center>
            <div class="form_deg">
                <center class="tittle_deg"> Login Form 

                <h4>
                    <?php
                    error_reporting(0);
                    session_start();
                    session_destroy();
                    echo  $_SESSION['loginMessage'];

                    ?>
                </h4>
                </center>
                <form action="logic_check.php" method="POST" class="login_form">
                    <div >
                        <label class="label_deg">Username</label>
                        <input type="text" name="username">
                    </div>
                    <div>
                        <label class="label_deg" >Password</label>
                        <input type="text" name="password">
                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" name="submit" value="Login">
                    </div>
                </form>
            </div>
        </center>

    </body>
</html>