<?php

include('admin-header.php');
global $db;
$sql_first_customer = "SELECT o.user_id,u.email, ROUND(SUM(total_cost),2) as total_cost
FROM orders o
JOIN user u ON o.user_id = u.user_id 
GROUP BY o.user_id
ORDER BY total_cost DESC
LIMIT 1 OFFSET 0";

$sql_second_customer = "SELECT o.user_id,u.email, ROUND(SUM(total_cost),2) as total_cost
FROM orders o
JOIN user u ON o.user_id = u.user_id 
GROUP BY o.user_id
ORDER BY total_cost DESC
LIMIT 1 OFFSET 1";

$sql_third_customer = "SELECT o.user_id,u.email, ROUND(SUM(total_cost),2) as total_cost
FROM orders o
JOIN user u ON o.user_id = u.user_id 
GROUP BY o.user_id
ORDER BY total_cost DESC
LIMIT 1 OFFSET 2";

$result_first_customer = mysqli_query($db, $sql_first_customer);
$result_second_customer = mysqli_query($db, $sql_second_customer);
$result_third_customer = mysqli_query($db, $sql_third_customer);

$row_first_customer = mysqli_fetch_assoc($result_first_customer);
$row_second_customer = mysqli_fetch_assoc($result_second_customer);
$row_third_customer = mysqli_fetch_assoc($result_third_customer);

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
                                    <h3 class="card-title"><strong>Καλύτεροι Πελάτες</strong></h3>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4">
                                        <canvas id="best-customers-chart" height="100"></canvas>
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
    var ctx = document.getElementById('best-customers-chart').getContext('2d');
    var myChart = new Chart(ctx, {

        type: 'bar',
        data: {
            labels: ['<?php echo $row_first_customer['email'] ?>', '<?php echo $row_second_customer['email'] ?>', '<?php echo $row_third_customer['email'] ?>'],
            datasets: [{
                label: 'Αξία Αγορών Πελάτη',
                data: [<?php echo $row_first_customer['total_cost'] ?>, <?php echo $row_second_customer['total_cost'] ?>, <?php echo $row_third_customer['total_cost'] ?>],
                backgroundColor: [
                    '#E66585',
                    '#C3C8C8',
                    '#20EEFC'
                ],
                borderColor: [
                    '#E66585',
                    '#C3C8C8',
                    '#20EEFC'
                ],
                borderWidth: 3
            }]

        },
        options: {
            title: {
                display: false
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