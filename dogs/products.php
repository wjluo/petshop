<?php

require_once('../header.php');
require_once('../functions.php');
require_once('../session-cart.php');

$sql = "SELECT * FROM `products`";
$result = $db->query($sql);

$categories = get_enums($db, 'products', 'category');


?>


<!--- WEBSITE DATA -->

<div class="container mt-5">

    <div class="row">

        <!--- LEFT SIDEPART -->

        <div class="col-sm-3">

            <h5 style=" color: rebeccapurple"><strong>ΚΑΤΗΓΟΡΙΕΣ</strong></h5>

            <table class="table table-hover" style="color: rebeccapurple">

                <tbody>

                    <?php foreach ($categories as $category) { ?>

                        <tr>
                            <td class="category" id="<?php echo $category; ?>">
                                <?php echo $category; ?>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

        <!--- RIGHT SIDEPART -->

        <div class="col-sm-9">

            <?php while ($row = $result->fetch_assoc()) { ?>

                <div class="row" style="border:1px rebeccapurple solid; margin: 0px 0px 10px 0px">
                    <h4 style="color:purple ;margin: 10px 0px 10px 10px"><?php echo $row['name']; ?></h4>
                    <table class="table" id="products-table">
                        <tr>
                            <td>
                                <a href="<?php echo ROOT_URI . $row['image']; ?>">
                                    <img src="<?php echo ROOT_URI . $row['image']; ?>" width="100" height="100" style="margin: 10px; border: 1px solid orange">
                                </a>
                            </td>
                            <td style="vertical-align: top;">
                                <p style="margin-top: 10px">
                                    <?php echo $row['description']; ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center">
                                <h4 class="text-danger">
                                    <?php echo $row["price"]; ?>€</h4>
                            </td>
                            <td style="text-align:left">
                                <input type="number" name="quantity" style="width: 3em" value="1" min="1" max="<?php echo $row['stock']; ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-outline-warning btn-sm"><i class="fa fa-shopping-cart"></i></button>
                                <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
                            </td>
                        </tr>
                    </table>
                </div>

            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="../scripts/js/dogs_products_filter.js"></script>
<?php include('../footer.php'); ?>