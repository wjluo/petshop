<?php include('header.php'); ?>

<!--- WEBSITE DATA -->

<div class="container">

    <!-- AD -->

    <div class="mx-auto mt-4 mb-3" align="center">
        <a href="https://www.petshop.demo">
            <img src="images/ad.png">
        </a>
    </div>

    <!-- LATEST ARRIVALS -->

    <h5 class="mb-3" style="color: rebeccapurple; font-weight: bold">Τελευταίες Αφίξεις</h5>

    <div class="row mb-5">

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


                        <h4 style="color:rebeccapurple; font-weight:bold">
                                        <?php echo nf($row["price"]); ?> €</h4>

                        <button class='btn'>Προσθήκη στο <i class='fa fa-shopping-cart'></i></button>

                    </div>

                </div>

        <?php }
        } ?>

    </div>


    <!-- POPULAR PRODUCTS -->

    <h5 class="mb-3" style="color: rebeccapurple; font-weight: bold">Δημοφιλή Προϊόντα</h5>


    <div class="row mb-5">

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


                        <h4 style="color:rebeccapurple; font-weight:bold">
                                        <?php echo nf($row2["price"]); ?> €</h4>


                        <button class='btn'>Προσθήκη στο <i class='fa fa-shopping-cart'></i></button>

                    </div>

                </div>

        <?php }
        } ?>

    </div>
</div>

<?php include('footer.php'); ?>