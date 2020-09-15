<body>

<div class="container">

    <nav class="navbar navbar-expand-md navbar-light">

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

            <div class="navbar-nav">
                <a href="<?php echo ROOT_URI . 'index.php' ?>" class="nav-item nav-link">
                    <img src="<?php echo ROOT_URI . 'images/logo.png' ?>" width="100">
                </a>
            </div>

            <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Αναζήτηση...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary btn-custom"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>


            <div class="navbar-nav">

                <a href="<?php echo ROOT_URI . "login.php" ?>" class="nav-item nav-link nav-purple"><i class="fas fa-user"></i></a>


                <?php if (isset($_SESSION['loggedin']) && $_SESSION('loggedin')) { ?>

                    <!-- <a href="cart.php" class="nav-item nav-link nav-purple"><i class="fas fa-shopping-cart"></i></a> -->

                <?php } ?>

                <a href="<?php echo ROOT_URI . "cart.php" ?>" class="nav-item nav-link nav-purple"><i class="fas fa-shopping-cart"></i></a>

            </div>

        </div>
    </nav>

<?php include('navbar.php'); ?>