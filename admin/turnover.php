<?php

include('admin-header.php');
global $db;
$sql_today_turnover = "SELECT ROUND(SUM(total_cost),2) AS today_turnover FROM orders
WHERE date(datetime) = CURDATE()";

$sql_week_turnover = "SELECT ROUND(SUM(total_cost),2) AS week_turnover FROM orders
WHERE YEARWEEK(DATE(datetime)) = YEARWEEK(NOW())";

$sql_month_turnover = "SELECT ROUND(SUM(total_cost),2) AS month_turnover FROM orders
WHERE month(date(datetime)) = MONTH(CURDATE())";

$result_today = mysqli_query($db, $sql_today_turnover);
$result_week = mysqli_query($db, $sql_week_turnover);
$result_month = mysqli_query($db, $sql_month_turnover);

$row_today = mysqli_fetch_assoc($result_today);
$row_week = mysqli_fetch_assoc($result_week);
$row_month = mysqli_fetch_assoc($result_month);

$today_turnover = $row_today['today_turnover'];
$week_turnover = $row_week['week_turnover'];
$month_turnover = $row_month['month_turnover'];

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
                                    <h3 class="card-title"><strong>Τζίρος Petshop</strong></h3>
                                </div>
                                <div class="card-body">
                                    <div class="position-relative mb-4">
                                        <canvas id="turnover-chart" height="100"></canvas>
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
    var ctx = document.getElementById('turnover-chart').getContext('2d');
    var myChart = new Chart(ctx, {

        type: 'bar',
        data: {
            labels: ['Σήμερα', 'Εβδομάδα', 'Μήνας'],
            datasets: [{
                label: 'Σύνολο Τζίρου',
                data: [<?php echo $today_turnover ?>, <?php echo $week_turnover ?>, <?php echo $month_turnover ?>],
                backgroundColor: [
                    'rgba(107, 0, 0, 0.8)', //dark red
                    'rgba(153, 102, 255, 0.8)', //purple
                    'rgba(255, 159, 64, 0.8)' //orange
                ],
                borderColor: [
                    'rgba(107, 0, 0, 1)', //dark red
                    'rgba(153, 102, 255, 1)', //purple
                    'rgba(255, 159, 64, 1)' //orange
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