<?php

require_once('../header.php');
// require_once('../session-cart.php');

$categories = get_enums($db, 'products', 'category');

// $category = isset($_GET['category']) ? htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8') : "";

// if (!empty($_GET['page']) && !empty($category)) {

//     $sql = "SELECT * FROM `products` WHERE `category_slang` = ? ORDER BY `price` ASC LIMIT $start_from, $limit";
//     $stmt = $db->prepare($sql);
//     $stmt->bind_param("s", $category);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $stmt->close();
// } else {

$limit = 4;

$sql = "SELECT * FROM `products` ORDER BY `price` ASC LIMIT 0, $limit";
$result = $db->query($sql);
// }

?>


<!--- WEBSITE DATA -->

<div class="container mt-5">

    <div class="row">

        <!--- LEFT SIDEPART -->

        <div class="col-sm-3">

            <div class="text-center" style="margin: 15px 0px 23px">
                <h5 style=" color: rebeccapurple"><strong>ΚΑΤΗΓΟΡΙΕΣ</strong></h5>
            </div>

            <table class="table table-hover" style="color: rebeccapurple">

                <tbody>

                    <?php foreach ($categories as $category) { ?>

                        <tr>
                            <td class="category text-center" id="<?php echo $category; ?>">
                                <?php echo $category; ?>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

        <!--- RIGHT SIDEPART -->


        <div class="col-sm-9">

            <div class="text-right mb-4">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ταξινόμηση
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item order-products" id="asc">Αύξουσα τιμή</button>
                        <button class="dropdown-item order-products" id="desc">Φθίνουσα τιμή</button>
                    </div>
                </div>
            </div>

            <div id="products-div">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="row" style="background-color:white; border:1px rebeccapurple solid; margin: 0px 0px 10px 0px">

                        <h4 style="color:rebeccapurple; margin: 10px 23px"><?php echo $row['name']; ?></h4>
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
                                    <h4 style="color:rebeccapurple; font-weight:bold">
                                        <?php echo nf($row["price"]); ?> €</h4>
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

            <div class="mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">

                        <?php

                        $sql_count = "SELECT COUNT(product_id) FROM `products`";
                        $rs_count = $db->query($sql_count);
                        $count = $rs_count->fetch_row()[0];

                        $total_pages = ceil($count / $limit);

                        if (!empty($total_pages)) {
                            for ($page = 1; $page <= $total_pages; $page++) {
                                if ($page == 1) { ?>
                                    <li class="pageitem active" id="<?php echo $page; ?>"><a href="javascript:void(0);" data-id="<?php echo $page; ?>" class="page-link"><?php echo $page; ?></a></li>
                                <?php } else { ?>
                                    <li class="pageitem" id="<?php echo $page; ?>"><a href="javascript:void(0);" class="page-link" data-id="<?php echo $page; ?>"><?php echo $page; ?></a></li>
                        <?php }
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>


        </div>
    </div>
</div>

<?php include('../footer.php'); ?>
<script>
    $(document).ready(function() {

        $(".page-link").click(function() {
            var id = $(this).attr("data-id");
            var select_id = $(this).parent().attr("id");

            $.get('filter.php', {
                    page: id
                })
                .done(function(dataResult) {

                    $("#products-div").html(dataResult);
                    $(".pageitem").removeClass("active");
                    $("#" + select_id).addClass("active");

                });
        });
    });
</script>
<script src="/scripts/js/dogs_products_filter.js"></script>