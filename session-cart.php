<?php

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
            echo "<script>window.location='index.php?dashboard=dogs'</script>";
        } else {
            echo "<script>alert('Το προϊόν υπάρχει ήδη στο καλάθι!')</script>";
        }
    } else if (empty($_SESSION["shopping_cart"])) {
        $product_array = array(
            "product_id" => $_GET["product_id"],
            "product_name" => $_POST["hidden_name"],
            "product_price" => $_POST["hidden_price"],
            "product_quantity" => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $product_array;
    }
}
