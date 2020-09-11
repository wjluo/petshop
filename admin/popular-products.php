<?php

include('admin-header.php');
global $db;

$sql_first = "SELECT product_id, sum(product_quantity) as product_total_sell_quantity
FROM orders_products
GROUP BY product_id
ORDER BY product_total_sell_quantity DESC
LIMIT 1 OFFSET 0";

$sql_second = "SELECT product_id, sum(product_quantity) as product_total_sell_quantity
FROM orders_products
GROUP BY product_id
ORDER BY product_total_sell_quantity DESC
LIMIT 1 OFFSET 1";

$sql_third = "SELECT product_id, sum(product_quantity) as product_total_sell_quantity
FROM orders_products
GROUP BY product_id
ORDER BY product_total_sell_quantity DESC
LIMIT 1 OFFSET 2";

$sql_fourth = "SELECT product_id, sum(product_quantity) as product_total_sell_quantity
FROM orders_products
GROUP BY product_id
ORDER BY product_total_sell_quantity DESC
LIMIT 1 OFFSET 3";

$sql_fifth = "SELECT product_id, sum(product_quantity) as product_total_sell_quantity
FROM orders_products
GROUP BY product_id
ORDER BY product_total_sell_quantity DESC
LIMIT 1 OFFSET 4";

$result_first = mysqli_query($db, $sql_first);
$result_second = mysqli_query($db, $sql_second);
$result_third = mysqli_query($db, $sql_third);
$result_fourth = mysqli_query($db, $sql_fourth);
$result_fifth = mysqli_query($db, $sql_fifth);

$row_first = mysqli_fetch_assoc($result_first);
$row_second = mysqli_fetch_assoc($result_second);
$row_third = mysqli_fetch_assoc($result_third);
$row_fourth = mysqli_fetch_assoc($result_fourth);
$row_fifth = mysqli_fetch_assoc($result_fifth);

?>

<?php include('navbar.php') ?>
<?php include('sidebar.php') ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-10" style="margin-top:20px;">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title"><strong>Δημοφιλέστερα προϊόντα</strong></h3>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4">
                                        <canvas id="popular-products-chart" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('admin-footer.php') ?>

    </div>
    <!-- ./wrapper -->

</body>

</html>

<script src="plugins/chart.js/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('popular-products-chart').getContext('2d');
    var myChart = new Chart(ctx, {

        type: 'bar',
        data: {
            labels: ['<?php echo "ID = " . $row_first["product_id"] ?>', '<?php echo "ID = " . $row_second["product_id"] ?>', '<?php echo "ID = " . $row_third["product_id"] ?>', '<?php echo "ID = " . $row_fourth["product_id"] ?>', '<?php echo "ID = " . $row_fifth["product_id"] ?>'],
            datasets: [{
                label: 'Ποσότητα',
                data: [<?php echo $row_first["product_total_sell_quantity"] ?>, <?php echo $row_second["product_total_sell_quantity"] ?>, <?php echo $row_third["product_total_sell_quantity"] ?>, <?php echo $row_fourth["product_total_sell_quantity"] ?>, <?php echo $row_fifth["product_total_sell_quantity"] ?>],
                backgroundColor: [
                    '#CBDA05',
                    '#21CD5E',
                    '#7D3FDB',
                    '#E7DCCA',
                    '#E455D1',
                ],
                borderColor: [
                    '#CBDA05',
                    '#21CD5E',
                    '#7D3FDB',
                    '#E7DCCA',
                    '#E455D1',
                ],
                borderWidth: 3
            }]

        },
        options: {
            title: {
                display: true
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>