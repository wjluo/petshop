<?php

require_once('../config.php');
global $db;

$user_id = mysqli_real_escape_string($db, $_POST['user_id']);
$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$mobile_number = mysqli_real_escape_string($db, $_POST['mobile_number']);
$address = mysqli_real_escape_string($db, $_POST['address']);
$date_of_birth = $_POST['date_of_birth'];


//ΕΠΕΞΕΡΓΑΣΙΑ
if (isset($_POST['edit-user'])) {
    $sql = "UPDATE user SET firstname=?,lastname=?,email=?,mobile_number=?,address=?,date_of_birth=? WHERE user_id=?";
    $statement = mysqli_prepare($db, $sql);
    $statement->bind_param('ssssssi', $firstname, $lastname, $email, $mobile_number, $address, $date_of_birth, $user_id);
    $result = $statement->execute();
}
//ΔΙΑΓΡΑΦΗ
else if (($_POST['action'] == 'delete')) {
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM user WHERE user_id=?";
    $statement = mysqli_prepare($db, $sql);
    $statement->bind_param('i', $user_id);
    $result = $statement->execute();
}

if ($result) {
    echo "<script>alert('Επιτυχής Ενέργεια!')</script>";
} else {
    echo "<script>alert('Κάτι πήγε στραβά...')</script>";
}
echo "<script>window.opener.location.reload()</script>";
echo "<script>window.close()</script>";
