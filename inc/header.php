<?php

require_once('server.php');

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel=" stylesheet" href="style/style_main.css">
</head>

<div class="page container">

    <!--- WEBSITE HEADER -->

    <div class="header">

        <div class="row">
            <div class="col-sm-4" style="padding-top: 10px">
                <a href="frontpage.php">
                    <img src="images/petshop_logo.png" width="100">
                </a>
            </div>
            <div class="col-sm-3" style="padding-top: 40px; padding-right: 5px" align="center">
                <a href="frontpage.php">
                    <img src="images/search.png" width="25">
                </a>

                <input type="search" name="searchField">
            </div>
            <div class="col-sm-5" style="padding-top: 25px; padding-left: 60px">
                <table>
                    <tr align="center">
                        <td>
                            <img src="images/user.png" width="25">
                        </td>
                        <td style="font-size: 15px; text-align:center">

                            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) : ?>
                                <div class="dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown" id="noLinkUnderline">Ο
                                        λογαριασμός μου
                                    </div>
                                    <div class="dropdown-menu" style="text-align:center; background:#DBC0F9">
                                        <a class="dropdown-item" href="user-action.php"><strong>Λογαριασμός<strong></a>
                                        <a class="dropdown-item" href="orders-history.php"><strong>Ιστορικό
                                                Παραγγελιών</strong></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="logout.php">Αποσύνδεση</a>
                                    </div>
                                </div>
                            <?php else : ?>
                                <a class="underlineHover" id="noLinkUnderline" href="login.php">Σύνδεση Χρήστη</a>
                            <?php endif; ?>
                        </td>
                        <td style="padding-left: 10px">
                            <img src="images/shopping_cart.png" width="25">
                        </td>
                        <td style="font-size: 16px; padding-left: 10px">

                            <?php if (isset($_SESSION["loggedin"])) :

                                if (!empty($_SESSION["shopping_cart"])) :
                                    $total = 0;
                                    $number_of_products = 0;
                                    foreach ($_SESSION["shopping_cart"] as $key => $value) {
                                        $total = $total + ($value["product_quantity"] * $value["product_price"]);
                                        $number_of_products = $number_of_products + $value["product_quantity"];
                                    } ?>
                                    <a class="underlineHover products" id="noLinkUnderline" href="cart.php">
                                        <strong><span id="number_of_products"><?php echo $number_of_products ?></span></strong>
                                        προϊόντα (<strong><span id="total_price"><?php echo number_format($total, 2) . "€" ?></span></strong>)
                                    </a>
                                <?php else : ?>
                                    <a class="underlineHover" id="noLinkUnderline" href="cart.php">Το καλάθι είναι
                                        άδειο</a>
                                <?php endif; ?>

                            <?php else : ?>
                                <a class="underlineHover" id="noLinkUnderline" href="login.php">Το καλάθι είναι
                                    άδειο</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/email.png" width="25">
                        </td>
                        <td style="font-size: 15px; text-align:center">
                            <a class="underlineHover" id="noLinkUnderline" href="mailto:info@petshop.demo">info@petshop.demo</a>
                        </td>
                        <td align="right">
                            <img src="images/telephone.png" width="20">
                        </td>
                        <td class="underlineHover" id="noLinkUnderline" style="color:rebeccapurple; font-size: 15px" align="center"><strong>+30 2101234567</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <?php include('inc/menubar.php'); ?>