 <?php

    include('admin-header.php');

    if (!empty($_GET['user_id']) && isset($_GET['user_id'])) {

        $user_id = $_GET['user_id'];
        require_once('../config.php');
        global $db;
        $sql = "SELECT * FROM user WHERE user_id=?";
        $statement = mysqli_prepare($db, $sql);
        $statement->bind_param('i', $user_id);
        $statement->execute();
        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {

            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $mobile_number = $row['mobile_number'];
            $email = $row['email'];
            $password = $row['password'];
            $address = $row['address'];
            $date_of_birth = $row['date_of_birth'];
            $role = $row['role'];
        }

        $statement->close();
    }
    ?>


 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h4 class="m-0 text-dark">Επεξεργασία Χρήστη</h4>
                 </div>
             </div><!-- /.row -->
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="card">
                         <!-- <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3>Προσθήκη προϊόντος</h3>
              </div>
            </div> -->
                         <div class="card-body">
                             <form action="<?php echo htmlspecialchars('user-check.php') ?>" method="post">
                                 <div class="form-group">
                                     <label for="user_id">
                                         <h5>User ID</h5>
                                     </label>
                                     <input type="text" name="user_id" class="form-control" value="<?php echo $user_id ?>" readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="firstname">
                                         <h5>Όνομα</h5>
                                     </label>
                                     <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="lastname">
                                         <h5>Επώνυμο</h5>
                                     </label>
                                     <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="email">
                                         <h5>Email</h5>
                                     </label>
                                     <input type="text" name="email" class="form-control" value="<?php echo $email ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="mobile_number">
                                         <h5>Τηλέφωνο</h5>
                                     </label>
                                     <input type="text" name="mobile_number" class="form-control" value="<?php echo $mobile_number ?>">
                                 </div>
                                 <div class="form-group">
                                     <label for="password">
                                         <h5>Κωδικός</h5>
                                     </label>
                                     <input type="text" name="password" class="form-control" value="<?php echo $password ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="address">
                                         <h5>Διεύθυνση</h5>
                                     </label>
                                     <input type="text" name="address" class="form-control" value="<?php echo $address ?>">
                                 </div>
                                 <div class="form-group">
                                     <label for="date_of_birth">
                                         <h5>Ημερομηνία Γεννήσεως</h5>
                                     </label>
                                     <input type="date" name="date_of_birth" class="form-control" value="<?php echo $date_of_birth ?>">
                                 </div>
                                 <div class="form-group">
                                     <input class="btn btn-primary" type="submit" name="edit-user" value="Επεξεργασία" style="float: right">
                                 </div>

                             </form>
                         </div>
                     </div>
                     <!-- /.card -->
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
         </div>


 </div>
 <!--/. container-fluid -->
 </section>

 <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->