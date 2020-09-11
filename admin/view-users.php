<?php

include('admin-header.php');
global $db;
$sql = "SELECT * FROM user WHERE role='user' ORDER BY lastname";
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
                  <h3 class="card-title">Κατάλογος Χρηστών</h3>

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
                          <th>ID Χρήστη</th>
                          <th>Όνομα</th>
                          <th>Επώνυμο</th>
                          <th>Email</th>
                          <th>Τηλέφωνο</th>
                          <th>Διεύθυνση</th>
                          <td>Ενέργειες
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        while ($row = mysqli_fetch_assoc($result)) :

                          $user_id = $row['user_id'];
                          $firstname = $row['firstname'];
                          $lastname = $row['lastname'];
                          $email = $row['email'];
                          $mobile_number = $row['mobile_number'];
                          $address = $row['address'];

                        ?>
                          <tr style='text-align: center' id="user_id-<?php echo $row['user_id'] ?>">

                            <td><?php echo $user_id ?></td>
                            <td><?php echo $firstname ?></td>
                            <td><?php echo $lastname ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $mobile_number ?></td>
                            <td><?php echo $address ?></td>

                            <td>
                              <button type="button" class="btn btn-primary btn-sm edit-user" id="<?php echo $user_id; ?>"><i class="fas fa-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger btn-sm edit-user" id="<?php echo $user_id; ?>"><i class="fas fa-trash-alt delete-user"></i></button>
                            </td>

                          </tr>
                        <?php
                        endwhile;
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
  </div>
  <!-- ./wrapper -->

</body>

<?php include('admin-footer.php') ?>

</html>

<script>
  $(".edit-user").click(function() {

    var user_id = this.id;
    var myWidth = 800;
    var myHeight = 850;
    var left = (screen.width - myWidth) / 2;
    var top = (screen.height - myHeight) / 4;
    var myURL = "edit-user.php?user_id=" + user_id;
    var title = "Επεξεργασία Χρήστη";

    var myWindow = window.open(myURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
    myWindow.focus();
  });
</script>

<script>
  $(".delete-user").click(function() {

    var user_id_value = this.id;
    var confirmation = confirm("Θέλετε σίγουρα να διαγράψετε τον χρήστη με ID=" + user_id_value + ";");
    if (confirmation == true) {

      $.ajax({
        type: 'POST',
        url: 'user-check.php',
        data: {
          user_id: user_id_value,
          action: 'delete'
        },
        success: function(response) {

          $("#user_id-" + user_id_value).remove();
          alert('Επιτυχής διαγραφή!');

        }
      });
    }
  });
</script>