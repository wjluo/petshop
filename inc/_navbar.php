<div class="page container">

  <div class="header">

    <div class="row">
      <!-- <div class="col-sm-4" style="padding-top: 10px">
        <a href="frontpage.php">
          <img src="images/petshop_logo.png" width="100">
        </a>
      </div>
      <div class="col-sm-3" style="padding-top: 40px; padding-right: 5px" align="center">
        <a href="frontpage.php">
          <img src="images/search.png" width="25">
        </a>

        <input type="search" name="searchField">
      </div>
      <div class="col-sm-5" style="padding-top: 25px; padding-left: 60px">
        <table>
          <tr align="center">
            <td>
              <img src="images/user.png" width="25">
            </td>
            <td style="font-size: 15px; text-align:center">

              <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) : ?>
                <div class="dropdown">
                  <div class="dropdown-toggle" data-toggle="dropdown" id="noLinkUnderline">Ο
                    λογαριασμός μου
                  </div>
                  <div class="dropdown-menu" style="text-align:center; background:#DBC0F9">
                    <a class="dropdown-item" href="user-action.php"><strong>Λογαριασμός<strong></a>
                    <a class="dropdown-item" href="orders-history.php"><strong>Ιστορικό
                        Παραγγελιών</strong></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Αποσύνδεση</a>
                  </div>
                </div>
              <?php else : ?>
                <a class="underlineHover" id="noLinkUnderline" href="login.php">Σύνδεση Χρήστη</a>
              <?php endif; ?>
            </td>
            <td style="padding-left: 10px">
              <img src="images/shopping_cart.png" width="25">
            </td>
            <td style="font-size: 16px; padding-left: 10px">

              <?php if (isset($_SESSION["loggedin"])) :

                if (!empty($_SESSION["shopping_cart"])) :
                  $total = 0;
                  $number_of_products = 0;
                  foreach ($_SESSION["shopping_cart"] as $key => $value) {
                    $total = $total + ($value["product_quantity"] * $value["product_price"]);
                    $number_of_products = $number_of_products + $value["product_quantity"];
                  } ?>
                  <a class="underlineHover products" id="noLinkUnderline" href="cart.php">
                    <strong><span id="number_of_products"><?php echo $number_of_products ?></span></strong>
                    προϊόντα (<strong><span id="total_price"><?php echo number_format($total, 2) . "€" ?></span></strong>)
                  </a>
                <?php else : ?>
                  <a class="underlineHover" id="noLinkUnderline" href="cart.php">Το καλάθι είναι
                    άδειο</a>
                <?php endif; ?>

              <?php else : ?>
                <a class="underlineHover" id="noLinkUnderline" href="login.php">Το καλάθι είναι
                  άδειο</a>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td>
              <img src="images/email.png" width="25">
            </td>
            <td style="font-size: 15px; text-align:center">
              <a class="underlineHover" id="noLinkUnderline" href="mailto:info@petshop.demo">info@petshop.demo</a>
            </td>
            <td align="right">
              <img src="images/telephone.png" width="20">
            </td>
            <td class="underlineHover" id="noLinkUnderline" style="color:rebeccapurple; font-size: 15px" align="center"><strong>+30 2101234567</strong>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div> -->

      <nav class="navbar navbar-expand-lg mt-2">

        <a class="navbar-brand" href="frontpage.php"><img src="images/petshop_logo.png" width="100"></a>
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav mr-auto">

            <!-- <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li> -->
            <!-- <li class="nav-item">
          <a class="nav-link" href="#">Σκύλοι</a>
        </li> -->
            <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li> -->
            <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </nav>