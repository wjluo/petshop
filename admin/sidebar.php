<?php

$active_file = $_SERVER['PHP_SELF'];

?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/admin.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['email'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <?php if ($active_file == '/petshop/admin/create-xml.php') : ?>
                        <a href="create-xml.php" class="nav-link active">
                        <?php else : ?>
                            <a href="create-xml.php" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-file"></i>
                            <p>
                                Δημιουργία XML με XSL
                            </p>
                            </a>
                </li>

                <li class="nav-item has-treeview menu-open">
                    <?php if (
                        $active_file == '/petshop/admin/turnover.php' || $active_file == '/petshop/admin/popular-products.php' ||
                        $active_file == '/petshop/admin/best-customers.php'
                    ) : ?>

                        <a href="#" class="nav-link active">
                        <?php else : ?>
                            <a href="#" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Στατιστικά
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/turnover.php') : ?>
                                        <a href="turnover.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="turnover.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="fas fa-chart-bar nav-icon"></i>
                                            <p>Τζίρος</p>
                                            </a>
                                </li>
                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/popular-products.php') : ?>
                                        <a href="popular-products.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="popular-products.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="far fa-star nav-icon"></i>
                                            <p>Δημοφ/στερα προϊόντα</p>
                                            </a>
                                </li>

                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/best-customers.php') : ?>
                                        <a href="best-customers.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="best-customers.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="far fa-user nav-icon"></i>
                                            <p>Καλύτεροι πελάτες</p>
                                            </a>
                                </li>
                            </ul>
                </li>

                <li class="nav-item has-treeview menu-open">
                    <?php if (
                        $active_file == '/petshop/admin/view-products.php' || $active_file == '/petshop/admin/add-product.php'
                    ) : ?>

                        <a href="#" class="nav-link active">
                        <?php else : ?>

                            <a href="#" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Προϊόντα
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/view-products.php') : ?>
                                        <a href="view-products.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="view-products.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="fas fa-binoculars nav-icon"></i>
                                            <p>Προβολή Προϊόντων</p>
                                            </a>
                                </li>
                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/add-product.php') : ?>
                                        <a href="add-product.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="add-product.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="far fa-keyboard nav-icon"></i>
                                            <p>Προσθήκη Προϊόντος</p>
                                            </a>
                                </li>
                            </ul>
                </li>

                <li class="nav-item has-treeview menu-open">
                    <?php if ($active_file == '/petshop/admin/view-orders.php') : ?>

                        <a href="#" class="nav-link active">
                        <?php else : ?>

                            <a href="#" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Παραγγελίες
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/view-orders.php') : ?>
                                        <a href="view-orders.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="view-orders.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="fas fa-binoculars nav-icon"></i>
                                            <p>Προβολή Παραγγελιών</p>
                                            </a>
                                </li>
                            </ul>
                </li>


                <li class="nav-item has-treeview menu-open">
                    <?php if ($active_file == '/petshop/admin/view-users.php') : ?>
                        <a href="#" class="nav-link active">
                        <?php else : ?>

                            <a href="#" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Χρήστες
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <?php if ($active_file == '/petshop/admin/view-users.php') : ?>
                                        <a href="view-users.php" class="nav-link active">
                                        <?php else : ?>
                                            <a href="view-users.php" class="nav-link">
                                            <?php endif; ?>
                                            <i class="fas fa-binoculars nav-icon"></i>
                                            <p>Προβολή Χρηστών</p>
                                            </a>
                                </li>
                            </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>