<?php

session_start();

require "config/db.php";

date_default_timezone_set('asia/kolkata');
 $date = date('d-m-y H:i:s');
$errors = array();
$errorss = array();
$username = "";
$email = "";

//if user clicks on the signup button
if(isset($_POST['signup-btn'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];

    // empty and correct form validation
    if (empty($username)) {
        $errors['username'] = "Username Required";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email address is invalid";
    }
    if (empty($email)) {
        $errors['email'] = "Email Required";
    }
    if (empty($password)) {
        $errors['password'] = "Password Required";
    }

    if ($password !== $passwordConf) {
        $errors['password'] = "The two passwod do not match";
    }

    // validation of username
    $q = " select * from users where username = '$username'";
    $result = mysqli_query($conn, $q);
    $num = mysqli_num_rows($result);
    
    if($num == 1){
        $errors['username'] ="Usernmae already exist!";  
    }

    // validation of email
    $qs = " select * from users where email = '$email'";
    $results = mysqli_query($conn, $qs);
    $nums = mysqli_num_rows($results);
    $result = mysqli_query($conn, $qs);
    
    if ($nums == 1) {
        $errors['email'] ="Email already exist!";
        
    }

            
    

        if(count($errors) === 0){
            $verified = false;
            $token = bin2hex(random_bytes(50));

            // Insert into database
            $con = " INSERT INTO users (username, email, date, verified, token, password) values ('$username', '$email', '$date', '$verified', '$token', '$password') ";
            mysqli_query($conn, $con);

            // login user
            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;

            // set flash message
            $_SESSION['message'] = "You are now logged in!";
            $_SESSION['alert-class'] = "alert-sucess";
            header('location: index.php');
            exit();
        }
}
    
    



// If user clicks on login button
if(isset($_POST['login-btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Validation
    if (empty($username)) {
        $errors['username'] = "Username Required";
    }
    if (empty($password)) {
        $errors['password'] = "Password Required";
    }

    // login by email
    $sql = " select * from users where username = '$username' && password ='$password' ";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if (count($errors) === 0) {
        if($num == 1){
            // getting user details
            while ($row = mysqli_fetch_assoc($result)) {
                $email = $row['email'];
                $id = $row['id'];
                $verified = $row['verified'];
            }

            // login user
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;

            // set flash message
            $_SESSION['message'] = "You are now logged in!";
            $_SESSION['alert-class'] = "alert-sucess";
            header('location: index.php');
            exit();


        }else {
            $errors['login_fail'] = "wrong credentials";
        
        }
  
    }
}
           


        
// If user clicks on forgot password button
if(isset($_POST['forgot-btn'])){
    $email = $_POST['email'];

    // validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email address";
    }
    if (empty($email)) {
        $errors['email'] = "Email Required";
    }

    // connecting to database table and getting user details
    $sql = " select * from users where email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if (count($errors) === 0) {
        if($num == 1){
            // getting user details
            while ($row = mysqli_fetch_assoc($result)) {
                $email = $row['email'];
                $id = $row['id'];
                $verified = $row['verified'];
            }

            $subject = "password recovery";
            $header = "localhost provided details";

            // mail($email, $subject, $header);

            $errorss['forgot_sucess'] = "Your password successfully send to your " . $email;

        }else {
            $errors['login_fail'] = "wrong credentials";
        
       }
    }
}