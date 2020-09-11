<?php

require_once('../config.php');
global $db;

$product_id = mysqli_real_escape_string($db, $_POST['product_id']);
$name = mysqli_real_escape_string($db, $_POST['name']);
$category = mysqli_real_escape_string($db, $_POST['category']);
$description = mysqli_real_escape_string($db, $_POST['description']);
$photo = mysqli_real_escape_string($db, $_POST['photo']);
$stock = mysqli_real_escape_string($db, $_POST['stock']);
$price = mysqli_real_escape_string($db, $_POST['price']);

//ΠΡΟΣΘΗΚΗ
if (isset($_POST['add-product'])) {
    $sql = "INSERT INTO product(name,category,description,photo,stock,price) VALUES (?,?,?,?,?,?)";
    $statement = mysqli_prepare($db, $sql);
    $statement->bind_param('ssssid', $name, $category, $description, $photo, $stock, $price);
    $result = $statement->execute();
}
//ΕΠΕΞΕΡΓΑΣΙΑ
else if (isset($_POST['edit-product'])) {
    $sql = "UPDATE product SET name=?,category=?,description=?,photo=?,stock=?,price=? WHERE product_id=?";
    $statement = mysqli_prepare($db, $sql);
    $statement->bind_param('ssssidi', $name, $category, $description, $photo, $stock, $price, $product_id);
    $result = $statement->execute();
}
//ΔΙΑΓΡΑΦΗ
else if (($_POST['action'] == 'delete')) {
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM product WHERE product_id=?";
    $statement = mysqli_prepare($db, $sql);
    $statement->bind_param('i', $product_id);
    $result = $statement->execute();
}

if ($result) {
    echo "<script>alert('Επιτυχής Ενέργεια!')</script>";
} else {
    echo "<script>alert('Κάτι πήγε στραβά...')</script>";
}
echo "<script>window.opener.location.reload()</script>";
echo "<script>window.close()</script>";
