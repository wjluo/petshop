<?php

require_once('server.php');

if (isset($_POST['edit_user'])) {

    $user_id = $_SESSION["user_id"];

    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    if (!empty($_POST['new_password'])) {
        $password = $_POST['new_password'];
        $password = md5($password);
    } else {
        $password = $_SESSION['password'];
    }
    $address = htmlspecialchars($_POST['address']);
    $date_of_birth = $_POST['date_of_birth'];

    $sql = "UPDATE user 
            SET firstname=?,
            lastname=?,
            email=?,
            address=?,
            date_of_birth=?,
            password=? 
            WHERE user_id=?";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssssi", $firstname, $lastname, $email, $address, $date_of_birth, $password, $user_id);
    $result = $stmt->execute();

    $stmt->close();
    $db->close();

    if ($result) {
        echo "<script>alert('Επιτυχής τροποποίηση χρήστη!')</script>";
        echo "<script>window.location='index.php'</script>";
    } else {
        echo "<script>alert('Σφάλμα κατά την τροποποίηση!')</script>";
        echo "<script>window.location='index.php?dashboard=user-action'</script>";
    }
}


//User deletion
else if (isset($_POST['action']) && $_POST['action'] === 'delete') {

    $user_id = $_SESSION["user_id"];
    $sql = "DELETE FROM user WHERE user_id = {$user_id}";
    $result = mysqli_query($db, $sql);
}
