<?php

require_once('../header.php');
require_once('../functions.php');
//require_once('../session-cart.php');

$categories = get_enum($db, 'products', 'category');

if (!empty($_POST['category'])) {

    $category = $_POST['category'];
    $sql = "SELECT * FROM `products` WHERE `category` = '$category'";
} else {

    $sql = "SELECT * FROM `products` LIMIT 0,3";
}

$result = $db->query($sql);

?>

<br>

<!--- WEBSITE DATA -->

<div class="container">

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
                                <button type="submit" name="add_to_cart" class='btn btn-outline-warning btn-sm'><i class="fa fa-shopping-cart"></i></button>
                                <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
                            </td>
                        </tr>
                    </table>
                </div>

            <?php } ?>
        </div>
    </div>
</div><?php include('../footer.php'); ?>
<script>
    $('.category').click(function() {

        var selectedCategory = this.id;

        $.ajax({
            type: 'POST',
            url: 'products.php',
            data: {
                category: selectedCategory
            }
        }).done(function() {

            $('.col-sm-9').load('products-ajax.php .col-sm-9');

        }).fail(function(xhr, status, error) {
            var errorMessage = xhr.status + ': ' + xhr.statusText
            alert('Error - ' + errorMessage);
        });
    });
</script>