<?php

include('admin-header.php');
require_once('admin-functions.php');

if (isset($_GET['submit-dates'])) {

    global $db;

    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];

    $sql = "SELECT o.order_id, u.firstname, u.lastname, o.total_cost
    FROM orders o
    JOIN user u ON o.user_id = u.user_id
    WHERE DATE(o.datetime) >= '" . $date_from . "' AND DATE(o.datetime) <= '" . $date_to . "'
    ORDER BY o.total_cost DESC";

    $result = mysqli_query($db, $sql);
    $orders = array();

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row; //αποθήκευση κάθε γραμμής στον πίνακα orders
    }

    $five_most_popular_products_sql = "SELECT op.product_id, p.name, sum(op.product_quantity) as product_total_sell_quantity
    FROM orders_products op
    JOIN orders o ON op.order_id = o.order_id
    JOIN product p ON op.product_id = p.product_id
    WHERE DATE(o.datetime) BETWEEN '" . $date_from . "' AND '" . $date_to . "'
    GROUP BY product_id
    ORDER BY product_total_sell_quantity DESC
    LIMIT 5";


    $result2 = mysqli_query($db, $five_most_popular_products_sql);
    $popular_products = array();

    while ($row2 = $result2->fetch_assoc()) {
        $popular_products[] = $row2; //αποθήκευση κάθε γραμμής στον πίνακα popular_products
    }
}
?>

<!DOCTYPE html>
<html lang="gr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ερώτηση 3</title>
</head>

<body>
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6" style="margin: auto; padding: 10px">

                <div class="card" align="center" style="margin: 30px">

                    <?php

                    generateRawXML($orders, $popular_products);

                    $data = parseXML("xml/orders_products.xml"); ?>

                    <h4>Αριθμός Παραγγελιών: <strong><?php echo $data[0] ?></strong></h4>
                    <h4>Συνολικός Τζίρος: <strong><?php echo $data[1] ?></strong>€</h4>

                    <?php

                    if (!validateXMLwithDTD("xml/orders_products.xml")) {
                        echo "<script>alert('Σφάλμα επικύρωσης XML!')</script>";
                    }

                    styleXMLwithXSL("xml/orders_products.xml", "xml/orders_products.xsl");

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>