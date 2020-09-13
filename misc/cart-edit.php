<?php
require_once("server.php");

if (isset($_POST["action"])) {

    $product_id = $_POST["product_id"];

    if ($_POST["action"] == "update") {

        $product_quantity = $_POST["product_quantity"];

        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($value["product_id"] == $product_id) {
                $_SESSION["shopping_cart"][$key]["product_quantity"] = $product_quantity;
            }
        }
    } else if ($_POST["action"] === "delete") {
        foreach ($_SESSION['shopping_cart'] as $key => $value) {
            if ($value['product_id'] == $product_id) {
                unset($_SESSION['shopping_cart'][$key]);
            }
        }
    }
}
