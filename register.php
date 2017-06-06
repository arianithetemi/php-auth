<?php
    session_start();
    // Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'php-auth');

    if(!$db) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $errors = array();

    if(isset($_POST['register'])){
        $username = mysql_real_escape_string($_POST['username']);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $confirm_password = mysql_real_escape_string($_POST['confirm_password']);

        // Validation
        if(empty($username)) {
            array_push($errors, "Username is required!");
        }
        if(empty($email)) {
            array_push($errors, "Email is required!");
        }
        if(empty($password)) {
            array_push($errors, "Password is required!");
        }
        if($password != $confirm_password) {
            array_push($errors, "Passwords not matching!");
        }
        // Save into DB
        if(count($errors) == 0){
            $hashed_password = md5($password);
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are logged in";
            header('location: home.php');
        }
    }
