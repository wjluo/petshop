<?php

require('server.php');
require('functions.php');

if (isset($_POST["add_to_cart"])) {

    if (isset($_SESSION["shopping_cart"])) {

        $product_id_array = array_column($_SESSION["shopping_cart"], "product_id");

        if (!in_array($_GET["product_id"], $product_id_array)) {
            $count = count($_SESSION["shopping_cart"]);
            $product_array = array(
                "product_id" => $_GET["product_id"],
                "product_name" => $_POST["hidden_name"],
                "product_price" => $_POST["hidden_price"],
                "product_quantity" => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $product_array;
            echo "<script>window.location='index.php'</script>";
        } else {
            echo "<script>alert('Το προϊόν υπάρχει ήδη στο καλάθι!')</script>";
        }
    } else {
        $product_array = array(
            "product_id" => $_GET["product_id"],
            "product_name" => $_POST["hidden_name"],
            "product_price" => $_POST["hidden_price"],
            "product_quantity" => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $product_array;
        echo "<script>window.location='index.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="gr">

<head>
    <title>Petshop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?php echo ROOT_URI . 'style/style_main.css'; ?>">
    <link rel="stylesheet" href="<?php echo ROOT_URI . 'style/style_login.css'; ?>">
</head>

<?php include('headbar.php'); ?>