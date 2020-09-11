 <?php

    include('admin-header.php');
    require_once('../config.php');
    require_once('../functions.php');
    global $db;

    if (!empty($_GET['product_id']) && isset($_GET['product_id'])) {

        $product_id = $_GET['product_id'];

        $sql = "SELECT * FROM product WHERE product_id=?";
        $statement = mysqli_prepare($db, $sql);
        $statement->bind_param('i', $product_id);
        $statement->execute();
        $result = $statement->get_result();

        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $category = $row['category'];
            $description = $row['description'];
            $image = $row['image'];
            $stock = $row['stock'];
            $price = $row['price'];
        }

        $statement->close();
    }

    $categories = get_enum($db, 'product', 'category');

    ?>


 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h4 class="m-0 text-dark">Επεξεργασία Προϊόντος</h4>
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
                         <div class="card-body">
                             <form action="<?php echo htmlspecialchars('product-check.php') ?>" method="post">
                                 <div class="form-group">
                                     <label for="device">
                                         <h5>Product ID</h5>
                                     </label>
                                     <input type="text" name="product_id" class="form-control" value="<?php echo $product_id ?>" readonly>
                                 </div>
                                 <div class="form-group">
                                     <label for="device">
                                         <h5>Ονομασία</h5>
                                     </label>
                                     <input type="text" name="name" class="form-control" value="<?php echo $name ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="category">
                                         <h5>Κατηγορία</h5>
                                     </label>

                                     <select class="form-control" id='<?php echo $product_id ?>'>
                                         <?php foreach ($categories as $c) : ?>
                                             <?php if ($category === $c) : ?>
                                                 <option value="<?php echo $c ?>" selected><?php echo $c ?></option>
                                             <?php else : ?>
                                                 <option value="<?php echo $c ?>"><?php echo $c ?></option>
                                         <?php endif;
                                            endforeach; ?>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="description">
                                         <h5>Περιγραφή</h5>
                                     </label>
                                     <input type="text" name="description" class="form-control" value="<?php echo $description ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="image">
                                         <h5>Φωτογραφία (σύνδεσμος)</h5>
                                     </label>
                                     <input type="text" name="image" class="form-control" value="<?php echo $image ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="stock">
                                         <h5>Απόθεμα</h5>
                                     </label>
                                     <input type="text" name="stock" class="form-control" value="<?php echo $stock ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="price">
                                         <h5>Τιμή</h5>
                                     </label>
                                     <input type="text" name="price" class="form-control" value="<?php echo $price ?>" required>
                                 </div>
                                 <div class="form-group">
                                     <input class="btn btn-primary" type="submit" name="edit-product" value="Επεξεργασία" style="float: right">
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
         <!--/. container-fluid -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->