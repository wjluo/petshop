<?php

require_once('config.php');
session_start();

// Check if the user is already logged in, if yes then redirect him to starting page

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

//  User Registration

if (isset($_POST['register_user'])) {

    $firstname = $db->escape_string($_POST['firstname']);
    $lastname = $db->escape_string($_POST['lastname']);
    $email = $db->escape_string($_POST['email']);
    $password = $db->escape_string($_POST['password']);

    //  Checks if user exists

    $user_check_query = "SELECT * FROM `users` WHERE `email` = ?";
    $stmt = $db->prepare($user_check_query);
    $stmt->bind_param('s', $email);
    $result = $db->fetch_assoc();

    if ($result) {

        $row = $result->fetch_assoc();

        if (!empty($row['email'])) {
            echo "<script>alert('E-mail is already being used! Try with a different one.')</script>";
            echo "<script>window.location='registration.php'</script>";
        }
    }

    $password = md5($password); //must be replaced with stronger encryption

    $role = "user"; //default

    $register_query = "INSERT INTO user(firstname,lastname,email,password,role) VALUES(?,?,?,?,?)";

    $stmt = $db->prepare($register_query);
    $stmt->bind_param('sssss', $firstname, $lastname, $email, $password, $role);
    $result = $stmt->execute();

    if ($result) {
        echo "<script>alert('Registration complete. Please log in.')</script>";
        echo "<script>window.location='login.php'</script>";
    } else {
        die("Error:" . $db->error);
        echo "<script>alert('Error during registration! Please try again.')</script>";
        echo "<script>window.location='registration.php'</script>";
    }
} // User login

else if (isset($_POST['login_user'])) {

    $email = $db->escape_string($_POST['email']);
    $password = $db->escape_string($_POST['password']);

    $password_md5 = md5($password);
    $select_query = "SELECT * FROM `users` WHERE `email` = ? AND `password` = ?";
    $stmt = $db->prepare($select_query);
    $stmt->bind_param('ss', $email, $password_md5);
    $result = $stmt->execute();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['$email'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] === "admin") {
            header("Location: admin/index.php");
        } else {
            echo "<script>alert('Successful login!')</script>";
            header("Location: index.php");
        }
    } else {
        echo "<script>alert('Login failed, please try again!')</script>";
        header("Location: login.php");
    }
}
