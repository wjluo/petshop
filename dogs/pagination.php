<?php

require_once('../config.php');
require_once('../functions.php');

if (isset($_GET['page']) && is_numeric($_GET['page'])) {

    $page = $_GET['page'];
    
} else {

    $page = 1;
}

$limit = 4;
$start_from = ($page - 1) * $limit;

$category = "";
$price_order = "";

if (isset($_GET['category']) && !empty($_GET['category'])) {

    $category = "WHERE `category` = '" . htmlspecialchars($_GET['category']) . "'";
}

if (isset($_GET['price_order']) && !empty($_GET['price_order'])) {

    if ($_GET['price_order'] === "desc")

        $price_order = "ORDER BY `price` DESC";
}

$sql = "SELECT * FROM `products` $category $price_order LIMIT $start_from, $limit";
$result = $db->query($sql);

$output = "";

while ($row = $result->fetch_assoc()) {
    $output .= generate_divs($row);
}

echo $output;
