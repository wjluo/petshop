<?php

require_once('../header.php');

$categories = get_enums($db, 'products', 'category');

$sql = "SELECT * FROM `products`";
$result = $db->query($sql);

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

                    <?php generate_divs($row); ?>

                <?php } ?>
            </div>

            <div class="mt-4">

                <nav aria-label="Page navigation">
                
                    <ul class="pagination justify-content-center">

                        <?php

                        $sql_count = "SELECT COUNT(product_id) FROM `products`";
                        $rs_count = $db->query($sql_count);
                        $count = $rs_count->fetch_row()[0];
                        $total_pages = ceil($count / 4);

                        if (!empty($total_pages)) {
                            for ($p = 1; $p <= $total_pages; $p++) {
                                if ($p == 1) { ?>
                                    <li class="pageitem active" id="<?php echo $p; ?>"><a href="javascript:void(0);" data-id="<?php echo $p; ?>" class="page-link"><?php echo $p; ?></a></li>
                                <?php } else { ?>
                                    <li class="pageitem" id="<?php echo $p; ?>"><a href="javascript:void(0);" class="page-link" data-id="<?php echo $p; ?>"><?php echo $p; ?></a></li>
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

<script src="/scripts/js/dogs_products_filters.js"></script>