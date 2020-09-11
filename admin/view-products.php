<?php

include('admin-header.php');
global $db;
$sql = "SELECT * FROM product";
$result = mysqli_query($db, $sql);

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
                  <h3 class="card-title">Κατάλογος Προϊόντων</h3>

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
                    <table class="table m-0 table-bordered table-striped">
                      <thead>
                        <tr style='text-align: center'>
                          <th>Product ID</th>
                          <th>Ονομασία</th>
                          <th>Κατηγορία</th>
                          <th>Περιγραφή</th>
                          <th>Φωτογραφία</th>
                          <th>Απόθεμα</th>
                          <th>Τιμή</th>
                          <th>Ενέργειες</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        if (mysqli_num_rows($result) > 0) :
                          while ($row = mysqli_fetch_assoc($result)) :

                            $product_id = $row['product_id'];
                            $name = $row['name'];
                            $category = $row['category'];
                            $description = $row['description'];
                            $image = $row['image'];
                            $stock = $row['stock'];
                            $price = $row['price'];
                        ?>

                            <tr id='product_id-<?php echo $product_id ?>' style='text-align: center'>
                              <td><?php echo $product_id ?></td>
                              <td><?php echo $name ?></td>
                              <td><?php echo $category ?></td>
                              <td><?php echo $description ?></td>
                              <td><?php echo $image ?></td>
                              <td><?php echo $stock ?></td>
                              <td><?php echo $price ?></td>
                              <td>
                                <button type="button" class="btn btn-primary"><i class="fas fa-pencil-alt edit-product" id="<?php echo $product_id; ?>"></i></button>
                                <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt delete-product" id="<?php echo $product_id; ?>"></i></button>
                              </td>
                            </tr>
                          <?php
                          endwhile;
                        else :
                          ?>
                          <script>
                            alert('Δεν υπάρχουν αποτελέσματα')
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
  $(".edit-product").click(function() {

    var product_id = this.id;
    var myWidth = 800;
    var myHeight = 850;
    var left = (screen.width - myWidth) / 2;
    var top = (screen.height - myHeight) / 4;
    var myURL = "edit-product.php?product_id=" + product_id;
    var title = "Επεξεργασία Προϊόντος";

    var myWindow = window.open(myURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
    myWindow.focus();
  });
</script>

<script>
  $(".delete-product").click(function() {

    var product_id_value = this.id;
    var confirmation = confirm("Θέλετε σίγουρα να διαγράψετε το προϊόν με ID=" + product_id_value + ";");
    if (confirmation == true) {

      $.ajax({
        type: 'POST',
        url: 'product-check.php',
        data: {
          product_id: product_id_value,
          action: 'delete'
        },
        success: function(response) {

          $("#product_id-" + product_id_value).remove();
          alert('Επιτυχής διαγραφή!');

        }
      });
    }
  });
</script>