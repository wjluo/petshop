<?php
require_once('config.php');

global $db;

$sql = "SELECT pr.name, pr.price, op.product_quantity, pr.price * op.product_quantity as total_product_price
FROM orders_products op
JOIN orders o ON op.order_id = o.order_id 
JOIN product pr ON op.product_id = pr.product_id
WHERE op.order_id =" . $_GET['order_id'];

$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="gr">

<head>
    <title>Προβολή Παραγγελίας</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style_main.css">
</head>

<body>



    <!-- Main content -->
    <section class="content" style="margin-top: 20px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <!-- TABLE: -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Παραγγελία ID:<?php echo $_GET['order_id'] ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr style='text-align: center'>
                                            <th width="60%">Προϊόν</th>
                                            <th width="15%">Τιμή</th>
                                            <th width="5%">Ποσότητα</th>
                                            <th width="15%">Σύνολο Προϊόντος</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if (mysqli_num_rows($result) > 0) :
                                            $order_total = 0;
                                            while ($row = mysqli_fetch_assoc($result)) :

                                                $name = $row['name'];
                                                $price_per_product = number_format($row['price'], 2);
                                                $product_quantity = $row['product_quantity'];
                                                $total_product_price = $row['total_product_price'];
                                        ?>

                                                <tr id='order_id-<?php echo $_GET['order_id'] ?>' style='text-align: center'>
                                                    <td><?php echo $name ?></td>
                                                    <td><?php echo $price_per_product ?> €</td>
                                                    <td><?php echo $product_quantity ?></td>
                                                    <td><?php echo $total_product_price ?> €</td>
                                                    <?php $order_total = $order_total + $total_product_price ?>
                                                </tr>
                                            <?php
                                            endwhile; ?>
                                            <tr>
                                                <td colspan="3" align="right">Κόστος παραγγελίας:</td>
                                                <td align="center"><strong><?php echo number_format($order_total, 2); ?>€</strong></td>
                                            </tr>
                                        <?php endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->

                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</body>

</html>