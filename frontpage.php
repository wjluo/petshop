<?php

include('inc/header.php');


?>

<!--- WEBSITE DATA -->

<div class="content-wrapper">

    <!-- AD -->

    <div class="mx-auto mt-3 mb-3" align="center">
        <a href="https://www.petshop.demo">
            <img src="images/ad.png">
        </a>
    </div>

    <!-- LATEST ARRIVALS -->

    <h4 style="color: rebeccapurple; margin-top:20px; margin-bottom:10px;"><b>Τελευταίες Αφίξεις</b></h4>

    <div class="row">
        <?php $sql = "SELECT * FROM `products` ORDER BY `product_id` DESC LIMIT 4";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>

                <div class="col-md-3">

                    <div class="card h-100">

                        <div>
                            <img src="<?php echo $row['image'] ?>" style="align-self:center; padding: 10px; width: 125px; height: 125px">
                        </div>

                        <div style="min-height:100px; padding: 10px">
                            <h5><?php echo $row['name'] ?></h5>
                        </div>


                        <p class="price"><?php echo $row['price'] ?> €</p>
                        <p class="p-3" style="text-align: justify;"><?php echo $row['description'] ?></p>

                        <button class='btn btn-outline-warning btn-sm'>Add to Cart <i class='fa fa-shopping-cart'></i></button>

                    </div>

                </div>

        <?php }
        } ?>

    </div>


    <!-- POPULAR PRODUCTS -->


    <h4 style="color: rebeccapurple; margin-top: 20px; margin-bottom: 10px"><b>Δημοφιλή Προϊόντα</b></h4>

    <div class="row">

        <?php $sql2 = "SELECT *, sum(product_quantity) as product_total_sell_quantity 
                FROM orders_products op JOIN products p on op.product_id = p.product_id 
                GROUP BY op.product_id ORDER BY product_total_sell_quantity DESC LIMIT 4";

        $result2 = $db->query($sql2);

        if ($result->num_rows > 0) {

            while ($row2 = $result2->fetch_assoc()) { ?>

                <div class="col-md-3">

                    <div class="card h-100">

                        <div>
                            <img src="<?php echo $row2['image'] ?>" style="align-self:center; padding: 10px; width: 125px; height: 125px">
                        </div>

                        <div style="min-height: 100px; padding: 10px">
                            <h5><?php echo $row2['name'] ?></h5>
                        </div>


                        <p class="price"><?php echo $row2['price'] ?> €</p>
                        <p class="p-3" style="text-align: justify;"><?php echo $row2['description'] ?></p>

                        <button class='btn btn-outline-warning btn-sm'>Add to Cart <i class='fa fa-shopping-cart'></i></button>

                    </div>

                </div>

        <?php }
        } ?>
    </div>

</div>



<?php include('inc/footer.php'); ?>