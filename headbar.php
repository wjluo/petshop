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

                    <a href="<?php echo ROOT_URI . "register.php" ?>" class="nav-item nav-link nav-purple"><i class="fas fa-user"></i></a>


                    <?php if (isset($_SESSION['loggedin']) && $_SESSION('loggedin') === 'true') { ?>

                        <!-- <a href="cart.php" class="nav-item nav-link nav-purple"><i class="fas fa-shopping-cart"></i></a> -->

                    <?php } ?>

                    <a href="<?php echo ROOT_URI . "cart.php" ?>" class="nav-item nav-link nav-purple"><i class="fas fa-shopping-cart"></i></a>

                </div>

            </div>

        </nav>

    </div>

    <div class="content-wrapper">

        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar10">
                    <ul class="navbar-nav nav-fill w-100">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URI . 'index.php' ?>">
                                <h5>ΑΡΧΙΚΗ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URI . 'dogs/' ?>">
                                <h5>ΣΚΥΛΟΙ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΓΑΤΕΣ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΠΟΥΛΙΑ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΨΑΡΙΑ</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h5>ΜΙΚΡΑ ΖΩΑ</h5>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>