<?php

require_once('config.php');
require_once('server.php');
global $db;

if (isset($_POST['submit-order']) && !empty($_SESSION["shopping_cart"])) {

    $user_id = $_SESSION['user_id'];
    $datetime = date("Y-m-d H:i:s");
    $total_cost = $_SESSION['total_cost'];
    $status = 'ΚΑΤΑΤΕΘΗΚΕ';

    $query_order = "INSERT INTO orders(user_id,datetime,total_cost,status) VALUES (?,?,?,?);";

    $stmt = mysqli_prepare($db, $query_order);
    $stmt->bind_param('isds', $user_id, $datetime, $total_cost, $status);
    $result = $stmt->execute();

    if ($result) {

        $order_id = $db->insert_id;
    }

    foreach ($_SESSION['shopping_cart'] as $key => $value) {

        $product_id = $value['product_id'];
        $product_quantity = $value['product_quantity'];

        $query_order_products = "INSERT INTO orders_products(order_id,product_id,product_quantity) VALUES(?,?,?)";
        $stmt2 = mysqli_prepare($db, $query_order_products);
        $stmt2->bind_param('iii', $order_id, $product_id, $product_quantity);
        $result2 = $stmt2->execute();
    }

    if ($result && $result2) {
        echo "<script>alert('Επιτυχής καταχώρηση παραγγελίας!')</script>";
        unset($_SESSION['shopping_cart']);
        unset($_SESSION['total_cost']);
        echo "<script>window.location='index.php'</script>";
    }
} else if (isset($_POST['arxikopoihsh'])) {
    unset($_SESSION["shopping_cart"]);
    echo "<script>window.location='index.php?dashboard=cart'</script>";
} else {
    echo "<script>alert('Κάτι πήγε στραβά! Προσπαθήστε ξανά...')</script>";
    echo "<script>window.location='index.php?dashboard=cart'</script>";
}
