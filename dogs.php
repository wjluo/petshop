<?php
global $db;
require('functions.php');
if (isset($_POST["add_to_cart"])) {

    if (isset($_SESSION["shopping_cart"])) {

        $product_id_array = array_column($_SESSION["shopping_cart"], "product_id");

        if (!in_array($_GET["product_id"], $product_id_array)) {
            $count = count($_SESSION["shopping_cart"]);
            $product_array = array(
                "product_id" => $_GET["product_id"],
                "product_name" => $_POST["hidden_name"],
                "product_price" => $_POST["hidden_price"],
                "product_quantity" => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $product_array;
            echo "<script>window.location='index.php?dashboard=dogs'</script>";
        } else {
            echo "<script>alert('Το προϊόν υπάρχει ήδη στο καλάθι!')</script>";
        }
    } else if (empty($_SESSION["shopping_cart"])) {
        $product_array = array(
            "product_id" => $_GET["product_id"],
            "product_name" => $_POST["hidden_name"],
            "product_price" => $_POST["hidden_price"],
            "product_quantity" => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $product_array;
    }
}

$categories = get_enum($db, 'product', 'category');

$sql = "SELECT * FROM product WHERE category = 'Τροφή'";
$result = mysqli_query($db, $sql);


?>

<br>

<!--- WEBSITE DATA -->

<div class="container">

    <div class="row">

        <!--- Αριστερή πλευρά -->

        <div class="col-sm-3">

            <h5 style=" color: rebeccapurple"><b>Κατηγορίες (Φίλτρα)</b></h5>

            <table class="table table-hover" style="color: rebeccapurple">

                <tbody>

                    <?php foreach ($categories as $category) : ?>

                        <tr>
                            <td class="category" id="<?php echo $category ?>">
                                <?php echo $category ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <!--- Δεξιά πλευρά -->

        <div class="col-sm-9">

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <form method="post" action="index.php?dashboard=dogs&action=add&product_id=<?php echo $row['product_id'] ?>">
                    <div class="row" style="border:1px rebeccapurple solid; margin: 0px 0px 10px 0px">
                        <h4 style="color:purple ;margin: 10px 0px 10px 10px"><?php echo $row['name'] ?></h4>
                        <table class="table">
                            <tr>
                                <td>
                                    <a href="<?php echo $row['image'] ?>">
                                        <img src="<?php echo $row['image'] ?>" width="100" height="100" style="margin: 10px; border: 1px solid orange">
                                    </a>
                                </td>
                                <td style="vertical-align: top;">
                                    <p style="margin-top: 10px">
                                        <?php echo $row['description'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">
                                    <h4 class="text-danger">
                                        <?php echo $row["price"]; ?>€</h4>
                                </td>
                                <td style="text-align:left">
                                    <input type="number" name="quantity" style="width: 3em" value="1" min="1" max="<?php echo $row['stock'] ?>">
                                    <button type="submit" name="add_to_cart" class='btn btn-outline-warning btn-sm'><i class="fa fa-shopping-cart"></i></button>
                                    <input type="hidden" name="hidden_name" value="<?php echo $row['name'] ?>">
                                    <input type="hidden" name="hidden_price" value="<?php echo $row['price'] ?>">
                                </td>
                            </tr>
                        </table>


                    </div>
                </form>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<br>
<br>

<?php include('footer.php'); ?>

<script>
    $('.category').click(function() {

        var id = this.id;
        switch (id) {
            case 'Τροφή':
                window.location = 'index.php?dashboard=dogs-trofi';
                break;
            case 'Λιχουδιές':
                window.location = 'index.php?dashboard=dogs-lichoudies';
                break;
            case 'Κολάρα':
                window.location = 'index.php?dashboard=dogs-kolara';
                break;
            case 'Ρούχα':
                window.location = 'index.php?dashboard=dogs-rouxa';
                break;
            case 'Παιχνίδια':
                window.location = 'index.php?dashboard=dogs-paixnidia';
                break;
            default:
                window.location = 'index.php?dashboard=dogs';
        }



    });
</script>