<?php
include("config.php");
session_start();
$usernameErr = $password = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($myusername)) {
        echo "<script type='text/javascript'>alert('Username Field Cannot be Empty');</script>";
    
        $error="p";
    }
   else if (empty($mypassword)) {
        echo "<script type='text/javascript'>alert('Password Field Cannot be Empty');</script>";
    
        $error="q";
   }
 else {
    $error=NULL;    
    }
if (count($error) == 0){
    $sql = "SELECT * FROM logincredit WHERE Username = '$myusername' and Password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;

        header("location: welcome.php");
    } else {
        echo "<script type='text/javascript'>alert('Your Login Name or Password is invalid');</script>";
    }
}
}
session_abort();
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="login.css">
        <link href='https://fonts.googleapis.com/css?family=Mako' rel='stylesheet'>
    </head>
    <body>
        <div class="login">
            <div class="lgn_left"><h1>login</h1><p>Please enter your Username and
                    password</p>
            </div>
            <form method="POST" name="form1">
                <input name="username" class="field" type="text" placeholder="Username"> 
                <input name="password" class="field" type="password" placeholder="Password">
                <input class="btn" type="submit" value="LOGIN">
                <label class="forgot">
                    <input type="checkbox" checked="checked" id="rem" >Remember me
                </label><p>
                    <a href="signup.php" class="forgot">Register</a> |
                    <a href="#" class="forgot">Forgot password?</a>
                    </div>
            </form>


    </body>
</html>