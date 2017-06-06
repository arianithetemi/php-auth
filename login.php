<?php
    session_start();
    $db = mysqli_connect('localhost', 'root', '', 'php-auth');

    if(!$db) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $errors = array();

    if(isset($_POST['login-submit'])) {
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']);
        $hashed_password = md5($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            // Log user in
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are logged in!";
            header('location: home.php');
        } else {
            header('location: index.php');
        }
    }
?>
