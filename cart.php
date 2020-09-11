 <?php

    include("cart-edit.php");

    ?>

 <div class="content-wrap">

     <div class="row" style="margin-top: 50px;">

         <!--- Αριστερό μέρος -->

         <div class="col-lg-12" style="border-bottom: 1px solid orange; color: mediumpurple">

             <h5><b>Περιεχόμενα στο καλάθι</b></h5>

             <br>

             <!-- Πίνακας Περιεχομένων -->
             <div class="table-responsive">
                 <table class="table">

                     <thead style="border: 1px; color: rebeccapurple">
                         <th width="60%">Προϊόν</th>
                         <th width="10%">Τιμή</th>
                         <th width="5%">Ποσότητα</th>
                         <th width="15%">Σύνολο</th>
                         <th width="10%">Ενέργεια</th>
                     </thead>


                     <tbody style="color: rebeccapurple">

                         <?php if (!empty($_SESSION["shopping_cart"])) :
                                $total = 0;
                                foreach ($_SESSION["shopping_cart"] as $key => $value) :
                            ?>

                                 <tr id="<?php echo $value["product_id"] ?>">
                                     <td align="left">
                                         <?php echo $value["product_name"]; ?>
                                     </td>
                                     <td>
                                         <?php echo $value["product_price"]; ?>€
                                     </td>
                                     <td>
                                         <input type="number" id="<?php echo $value["product_id"] ?>" value="<?php echo $value["product_quantity"] ?>" min="1" style="width: 3em">
                                     </td>
                                     <td>
                                         <?php echo number_format($value["product_quantity"] * $value["product_price"], 2) ?>€
                                     </td>
                                     <td>
                                         <button type="button" class="btn btn-outline-success btn-sm update-product-quantity"><i class="fa fa-refresh"></i></button>
                                         <button type="button" class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-remove"></i></button>
                                 </tr>

                             <?php $total = $total + ($value["product_quantity"] * $value["product_price"]);
                                endforeach; ?>
                             <tr>
                                 <td colspan="4" align="right">Κόστος παραγγελίας:</td>
                                 <td align="center"><strong><?php echo number_format($total, 2); ?>€</strong></td>
                             </tr>

                         <?php $_SESSION['total_cost'] = number_format($total, 2);
                            endif; ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

     <!--- Κάτω μέρος -->

     <div class='row' style="margin-top: 50px">

         <div class="col-lg-12" style="color: mediumpurple">

             <div class='container'>

                 <h5><b>Αποστολή και Πληρωμή</b></h5>
                 <br>


                 <form name="userOrderForm" action="process-order.php" method="post" onsubmit="return validateOrderForm()">
                     <table>
                         <tr>
                             <td>
                                 <p>Όνομα</p>
                             </td>

                             <td>
                                 <p><?php if (!empty($_SESSION['firstname'])) : ?>
                                         <input type="text" name="firstname" placeholder="Όνομα" value="<?php echo $_SESSION['firstname'] ?>" required>
                                     <?php else : ?> <input type="text" style="font-weight:bold;" placeholder="Όνομα">
                                     <?php endif; ?>
                                 </p>
                             </td>

                             <td style="padding-left: 20px">
                                 <p>Επώνυμο</p>
                             </td>
                             <td>
                                 <p><?php if (!empty($_SESSION['lastname'])) : ?>
                                         <input type="text" name="lastname" placeholder="Επώνυμο" value="<?php echo $_SESSION['lastname'] ?>" required>
                                     <?php else : ?>
                                         <input type="text" style="font-weight:bold;" placeholder="Επώνυμο">
                                     <?php endif; ?>
                                 </p>
                             </td>
                         </tr>

                         <tr>
                             <td>
                                 <p>Κινητό</p>
                             </td>
                             <td>
                                 <p><input type="text" name="mobile_number" placeholder="Κινητό" required></p>
                             </td>
                             <td style="padding-left: 20px">
                                 <p>Email</p>
                             </td>
                             <td>
                                 <p><?php if (!empty($_SESSION['email'])) : ?>
                                         <input type="text" name="email" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" required>
                                     <?php else : ?>
                                         <input type="text" name="email" placeholder="Email">
                                     <?php endif; ?>
                                 </p>
                             </td>
                         </tr>

                         <tr>
                             <td>
                                 <p>Διεύθυνση</p>
                             </td>
                             <td>
                                 <p><?php if (!empty($_SESSION['address'])) : ?>
                                         <input type="text" name="address" placeholder="Διεύθυνση" value="<?php echo $_SESSION['address'] ?>" required>
                                     <?php else : ?>
                                         <input type="text" name="address" placeholder="Διεύθυνση">
                                     <?php endif; ?>
                                 </p>
                             </td>
                             <td style="padding-left: 20px">
                                 <p>Τ.Κ.</p>
                             </td>
                             <td>
                                 <p><input type="text" name="tk" placeholder="Τ.Κ." required></p>
                             </td>
                         </tr>

                         <tr>
                             <td>
                                 <p>Πόλη</p>
                             </td>
                             <td>
                                 <p><input type="text" name="city" placeholder="Πόλη" required></p>
                             </td>
                             <td style="padding-left: 20px">
                                 <p>Νομός</p>
                             </td>
                             <td>
                                 <p>
                                     <select name="nomos">
                                         <option value="attikis" selected>Αττικής</option>
                                         <option value="thessalonikis">Θεσσαλονίκης</option>
                                         <option value="achaias">Αχαϊας</option>
                                         <option value="larisas">Λάρισας</option>
                                     </select>
                                 </p>
                             </td>
                         </tr>
                     </table>

                     <table>
                         <tr>
                             <td valign="top">
                                 <p>Αποστολή</p>
                             </td>
                             <td style="padding-left: 10px">
                                 <p style="vertical-align: bottom">
                                     <input type="radio" name="tropos_apostolis" checked="checked"> Παραλαβή από το κατάστημα<br>
                                     <input type="radio" name="tropos_apostolis"> Παράδοση με δική μας μεταφορική ή courier<br>
                                     <input type="radio" name="tropos_apostolis"> Παράδοση με μεταφορική ή courier της επιλογής σας
                                 </p>
                             </td>
                         </tr>
                         <tr>
                             <td valign="top">
                                 <p>Πληρωμή</p>
                             </td>
                             <td style="padding-left: 10px">
                                 <p style="vertical-align: bottom">
                                     <input type="radio" name="tropos_plhrwmhs" checked="checked"> Πιστωτική, Χρεωστική ή Προπληρωμένη Κάρτα Online<br>
                                     <input type="radio" name="tropos_plhrwmhs"> Τραπεζική κατάθεση<br>
                                 </p>
                             </td>
                         </tr>
                         <tr>
                             <td valign="top">
                                 <p>Σχόλια</p>
                             </td>
                             <td style="padding-left: 10px">
                                 <p><textarea name="sxolia" rows="2" cols="60" maxlength="255" style="resize: none" placeholder="Πληκτρολογήστε σχόλια εδώ"></textarea></p>
                             </td>
                         </tr>
                     </table>


                     <table>
                         <tr>
                             <td style="padding-left: 85px">
                                 <p><input type="checkbox" id="myCheck" required></p>
                             </td>
                             <td style="padding-left: 5px">
                                 <p style="font-size: 15px">
                                     Συμφωνώ με τους όρους χρήσης και την πολιτική απορρήτου
                                 </p>
                             </td>
                         </tr>
                     </table>

                     <table style="margin-left: 85px">
                         <tr>
                             <td style="padding-left: 100px">
                                 <input type="submit" value="Υποβολή" name="submit-order">
                             </td>
                             <td style="padding-left: 50px">
                                 <input type="submit" value="Αρχικοποίηση" name="arxikopoihsh">
                             </td>
                         </tr>
                     </table>
                 </form>
             </div>
         </div>
     </div>
 </div>


 <br>
 <br>
 <br>

 <?php include('footer.php'); ?>

 <script>
     //αλλάζει ποσότητα με τα βελάκια
     //  $('tr input[type=number]').click(function() {

     //      var product_id = $(this).closest('tr').attr('id');
     //      var new_quantity = $(this).val();

     //      console.log("Product ID: " + product_id);
     //      console.log("New Quantity: " + new_quantity);

     //      $.ajax({
     //          method: "POST",
     //          url: "cart-edit.php",
     //          data: {
     //              action: "update",
     //              product_id: product_id * 1,
     //              product_quantity: new_quantity * 1
     //          },
     //          success: function(result) { },
     //          error: function(xhr, status, error) {
     //              var errorMessage = xhr.status + ': ' + xhr.statusText
     //              alert('Error - ' + errorMessage);
     //          }
     //      });


     //      if (new_quantity > 0) {
     //          window.location = 'index.php?dashboard=cart&action=update&product_id=' + product_id + '&new_quantity=' + new_quantity;

     //      } else {
     //          window.location = 'index.php?dashboard=cart&action=delete&product_id=' + product_id;
     //      }
     //  });



     //αλλάζει ποσότητα με το κουμπί ανανέωσης
     $('.update-product-quantity').click(function() {

         var product_id = $(this).closest('tr').attr('id');
         var new_quantity = $(this).closest('tr').find('input[type=number]').val();

         if (new_quantity > 0) {
             $.post("cart-edit.php", {
                 action: "update",
                 product_id: product_id,
                 product_quantity: new_quantity
             }, function(data, status) {
                 window.location.reload();
             });
         }
     });

     $(".delete-product").click(function() {

         var product_id = $(this).closest('tr').attr('id');

         $.post("cart-edit.php", {
             action: "delete",
             product_id: product_id,
         }, function(data, status) {
             window.location.reload();
         });
     });



     function validateOrderForm() {

         var firstname = document.forms["userOrderForm"]["firstname"].value;
         var lastname = document.forms["userOrderForm"]["lastname"].value;
         var mobile_number = document.forms["userOrderForm"]["mobile_number"].value;
         var email = document.forms["userOrderForm"]["email"].value;
         var tk = document.forms["userOrderForm"]["tk"].value;
         var city = document.forms["userOrderForm"]["city"].value;
         var sxolia = document.forms["userOrderForm"]["sxolia"].value;

         var regExName = /^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώ]+$/;

         if (!regExName.test(firstname)) {
             window.alert("Εσφαλμένο όνομα");
             document.forms["userOrderForm"]["firstname"].focus;
             return false;
         }

         if (!regExName.test(lastname)) {
             window.alert("Εσφαλμένο επώνυμο");
             document.forms["userOrderForm"]["lastname"].focus;
             return false;
         }

         if (isNaN(mobile_number) || mobile_number.length != 10) {
             window.alert("Εσφαλμένος αριθμός τηλεφώνου");
             document.forms["userOrderForm"]["mobile_number"].focus;
             return false;
         }

         if (!validateEmail(email)) {
             window.alert("Το e-mail δεν είναι σε σωστή μορφή!");
             document.forms["userOrderForm"]["email"].focus;
             return false;
         }

         if (isNaN(tk) || tk.length != 5) {
             window.alert("Εσφαλμένος ταχυδρομικός κώδικας");
             document.forms["userOrderForm"]["tk"].focus;
             return false;
         }

         if (!regExName.test(city)) {
             window.alert("Εσφαλμένο όνομα πόλης");
             document.forms["userOrderForm"]["city"].focus;
             return false;
         }

         if (sxolia.length > 255) {
             window.alert("Παρακαλώ γράψτε λιγότερα σχόλια!");
             document.forms["userOrderForm"]["sxolia"].focus;
             return false;
         }
     }
 </script>