<?php

include('admin-header.php');
require_once('../functions.php');
global $db;
$sql = "SELECT * FROM orders ORDER BY datetime DESC";
$result = mysqli_query($db, $sql);

$status_array = get_enum($db, 'orders', 'status');

?>

<?php include('navbar.php') ?>
<?php include('sidebar.php') ?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <!-- <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Προϊόντα</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div> -->
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg">
              <!-- TABLE: -->
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Κατάλογος Παραγγελιών (για πληροφορίες πατήστε στο μωβ κελί του κάθε id)</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0 table-bordered table-hover">
                      <thead>
                        <tr style='text-align: center'>
                          <th>ID Παραγγελίας</th>
                          <th>ID Χρήστη</th>΄
                          <th>Email</th>
                          <th>Δημιουργήθηκε</th>
                          <th>Συνολικό Κόστος</th>
                          <th>Κατάσταση</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        if (mysqli_num_rows($result) > 0) :
                          while ($row = mysqli_fetch_assoc($result)) :

                            $order_id = $row['order_id'];
                            $user_id = $row['user_id'];

                            $email = getUserEmail($db, 'user', $user_id);

                            $created_at = $row['datetime'];
                            $total_cost = $row['total_cost'];
                            $currentStatus = $row['status'];
                        ?>

                            <tr style='text-align: center'>
                              <td style='background-color:#0277bd; color:whitesmoke' id='<?php echo $order_id ?>' class="view-order"><strong><?php echo $order_id ?></strong></td>
                              <td><?php echo $user_id ?></td>
                              <td><?php echo $email ?></td>
                              <td><?php echo $created_at ?></td>
                              <td><?php echo number_format($total_cost, 2) ?> €</td>


                              <td>
                                <select class="status-option form-control" id='<?php echo $order_id ?>'>
                                  <?php foreach ($status_array as $s) : ?>
                                    <?php if ($currentStatus === $s) : ?>
                                      <option value="<?php echo $s ?>" selected><?php echo $s ?></option>
                                    <?php else : ?>
                                      <option value="<?php echo $s ?>"><?php echo $s ?></option>
                                  <?php endif;
                                  endforeach; ?>
                                </select>
                              </td>




                            </tr>
                          <?php
                          endwhile;
                        else :
                          ?>
                          <script>
                            alert('Δεν υπάρχουν παραγγελίες')
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


    <?php include('admin-footer.php') ?>

  </div>
  <!-- ./wrapper -->

</body>

</html>

<script>
  $(".view-order").click(function() {

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

<script>
  $(".status-option").change(function() {
    var selectedStatus = $(this).children("option:selected").val();
    var selectedId = this.id;

    console.log(selectedStatus);
    console.log(selectedId);

    $.ajax({
      type: 'POST',
      url: 'update-order-status.php',
      data: {
        status: selectedStatus,
        order_id: selectedId,
        action: 'update'
      },
      success: function(response) {

        alert("Αλλαγή κατάστασης παραγγελίας με ID:" + order_id + " σε --> " + selectedStatus);

      }
    });
  });
</script>