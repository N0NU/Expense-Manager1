<?php
session_start();

$username = "";
$email = "";
$errors = array();

$db = mysqli_connect('localhost:3306', 'root', '1234', 'exp_mngr');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);
    $password_2 = mysqli_real_escape_string($db, $_POST['conf']);

    if (empty($username)) {
        echo "<script type='text/javascript'>alert('Username Field Cannot be Empty');</script>";
    }
    if (empty($email)) {
        echo "<script type='text/javascript'>alert('Please enter Email Address');</script>";
    }
    if (empty($password_1)) {
        echo "<script type='text/javascript'>alert('Password Field Cannot be Empty');</script>";
    }
    if ($password_1 != $password_2) {
       echo "<script type='text/javascript'>alert('Passwords didnt match');</script>";
    }

    $user_check_query = "SELECT * FROM logincredit WHERE Username='$username' OR Email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['Username'] === $username) {
            echo "<script type='text/javascript'>alert('Username already Exist');</script>";
            $errors = "p";
        }  else if ($user['Email'] === $email) {
            echo "<script type='text/javascript'>alert('Email already exist');</script>";
            $errors = "q";
        }
    }
    else
    {
        $errors=NULL;
    }

    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO logincredit (Username, Email, Password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: welcome.php');
    }
}
mysqli_close($db);
?>
<html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" type="text/css" href="signup.css">
        <link href='https://fonts.googleapis.com/css?family=Mako' rel='stylesheet'>
    </head>
    <body>
        <div class="hed">Create New Account</div>
        <form method="POST" name="reg-form">
            <div class="sign">
                <label class="text">Username<br>
                    <input type="text" class="field" placeholder="Enter Your Name" name="username"></label><br><br>
                <label class="text">Email<br>
                    <input type="email" class="field" name="email" placeholder="Enter Your Email Address"></label><br><br>
                <label class="text">Password<br>
                    <input type="password" class="field" name="password" placeholder="Enter Password(minimum 8 character)">
                </label><br><br>
                <label class="text">Confirm Password</label><br>
                <input type="password" class="field" name="conf" placeholder="Re-Enter Password"><br><br>
                <label><font style="Mako" size="5px">Gender</font></label><br>
                <input type="radio" name="gender" checked>Male<br>
                <input type="radio" name="gender">Female
                <br>
                <input type="submit" class="btn" value="Sign Up">
            </div>
        </form>
    </body>
</html>