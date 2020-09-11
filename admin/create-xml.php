<?php

include('admin-header.php');
include('navbar.php');
include('sidebar.php');


?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-5" style="margin-top:30px;">
                            <h5 style="margin-bottom: 20px"><strong>Επιλογή Ημερομηνιών</strong></h5>
                            <form name="dateForm" target="_blank" action="<?php echo htmlspecialchars('view-xml-with-xls.php') ?>" method="get">
                                Από: <input type="date" name="date_from" id="date_from" value="<?php if (isset($_GET['submit-dates'])) echo $_GET['date_from']; ?>" required> 
                                Εώς: <input type="date" name="date_to" id="date_to" value="<?php if (isset($_GET['submit-dates'])) echo $_GET['date_to']; ?>" required>
                                <input type="submit" name="submit-dates" id="submit-dates" value="Δημιουργία" style="margin-left:5px">
                                <a href="create-xml.php" style="margin-left:5px">Καθαρισμός</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include('admin-footer.php') ?>
    </div>
</body>

</html>