<?php

global $db;

$sql = "SELECT * FROM orders WHERE user_id =" . $_SESSION['user_id'] . " ORDER BY datetime DESC";
$result = mysqli_query($db, $sql);


?>


<!-- Main content -->
<section class="content" style="margin-top: 20px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">
                <!-- TABLE: -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Ιστορικό Παραγγελιών</h3>

                        <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered table-hover">
                                <thead>
                                <tr style='text-align: center'>
                                    <th>ID Παραγγελίας</th>
                                    <th>Ημερομηνία Καταχώρησης</th>
                                    <th>Συνολικό Κόστος</th>
                                    <th>Κατάσταση</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if (mysqli_num_rows($result) > 0) :
                                while ($row = mysqli_fetch_assoc($result)) :

                                    $order_id = $row['order_id'];
                                    $created_at = $row['datetime'];
                                    $total_cost = number_format($row['total_cost'], 2);
                                    $status = $row['status'];
                                    ?>

                                    <tr id="<?php echo $order_id ?>" class="view-order" style='text-align: center'>
                                        <td><?php echo $order_id ?></td>
                                        <td><?php echo $created_at ?></td>
                                        <td><?php echo $total_cost ?> €</td>
                                        <td><?php echo $status ?></td>
                                    </tr>
                                <?php
                                endwhile;
                                else :
                                ?>
                                    <script>
                                        alert('Δεν υπάρχουν καταχωρημένες παραγγελίες.')
                                    </script>
                                <?php endif; ?>
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

<br>
<br>

<?php include('footer.php') ?>

<script>
    $(".view-order").click(function () {

        var order_id = this.id;
        var myWidth = 800;
        var myHeight = 450;
        var left = (screen.width - myWidth) / 2;
        var top = (screen.height - myHeight) / 4;
        var myURL = "view-order?order_id=" + order_id;
        var title = "Προβολή Παραγγελίας";

        var myWindow = window.open(myURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
        myWindow.focus();
    });
</script>