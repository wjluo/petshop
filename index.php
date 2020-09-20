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

    <h3>ΤΕΛΕΥΤΑΙΕΣ <b>ΑΦΙΞΕΙΣ</b></h3>

    <div class="row mb-5">

        <div class="owl-carousel owl-theme" id="latest-arrivals">

            <?php $sql = "SELECT * FROM `products` ORDER BY `product_id` DESC";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {



                while ($row = $result->fetch_assoc()) { ?>

                    <div class="card h-100">

                        <div>
                            <img src="<?php echo $row['image'] ?>">
                        </div>

                        <div style="min-height:100px; padding: 10px">
                            <h5><?php echo $row['name'] ?></h5>
                        </div>


                        <h4 style="color:rebeccapurple; font-weight:bold">
                            <?php echo nf($row["price"]); ?> €</h4>

                        <button class='btn'>Προσθήκη στο <i class='fa fa-shopping-cart'></i></button>

                    </div>

            <?php }
            } ?>

        </div>
    </div>


    <!-- POPULAR PRODUCTS -->

    <h3>ΔΗΜΟΦΙΛΗ <b>ΠΡΟΪΟΝΤΑ</b></h3>


    <div class="row mb-5">

        <div class="owl-carousel owl-theme" id="popular-products">

            <?php

            $sql2 = "SELECT *, sum(product_quantity) as product_total_sell_quantity 
                FROM orders_products op JOIN products p on op.product_id = p.product_id 
                GROUP BY op.product_id ORDER BY product_total_sell_quantity DESC";

            $result2 = $db->query($sql2);



            while ($row2 = $result2->fetch_assoc()) { ?>


                <div class="card">

                    <div>
                        <img src="<?php echo $row2['image'] ?>">
                    </div>

                    <div style="min-height: 100px; padding: 10px">
                        <h5><?php echo $row2['name'] ?></h5>
                    </div>


                    <h4 style="color:rebeccapurple; font-weight:bold">
                        <?php echo nf($row2["price"]); ?> €</h4>


                    <button class='btn'>Προσθήκη στο <i class='fa fa-shopping-cart'></i></button>

                </div>

            <?php } ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $("#latest-arrivals").owlCarousel({
            autoplay: 3000,
            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],


        });
        $("#popular-products").owlCarousel({
            autoplay: 3000,
            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3]
        });

    });
</script>

<?php include('footer.php'); ?>