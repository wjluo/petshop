<?php

require_once('../config.php');
global $db;

if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $selectedStatus = $_POST['status'];
    $order_id = $_POST['order_id'];
    $sql = "UPDATE orders SET status='" . $selectedStatus . "' WHERE order_id=$order_id";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        echo "Error: " . mysqli_error($db);
    }
}
