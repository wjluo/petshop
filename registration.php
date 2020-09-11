 <?php include('style/css/style_registration.css') ?>


 <form name="userRegistrationForm" method="post" action="<?php echo htmlspecialchars('server.php') ?>" onsubmit="return validateRegistrationForm()">
     <div class="wrapper fadeInDown" text="Εγγραφή νέου χρήστη">
         <div id="formContent">
             <!-- Registration Form -->
             <form>
                 <input type="text" id="firstname" class="fadeIn first" name="firstname" placeholder="Όνομα" required>
                 <input type="text" id="lastname" class="fadeIn first" name="lastname" placeholder="Επώνυμο" required>
                 <input type="text" id="email" class="fadeIn first" name="email" placeholder="E-mail" required>
                 <input type="password" id="password" class="fadeIn first" name="password" placeholder="Κωδικός πρόσβασης" required>
                 <input type="password" id="password2" class="fadeIn first" name="password2" placeholder="Επιβεβαίωση κωδικού" required>
                 <input type="text" id="address" class="fadeIn second" name="address" placeholder="Διεύθυνση">
                 <input type="date" id="birthdate" class="fadeIn second" name="date_of_birth" placeholder="Ημερομηνία Γεννήσεως">
                 <input type="submit" name="register_user" class="fadeIn third" value="ΕΓΓΡΑΦΗ">
             </form>
             <div id="formFooter" class="fadeIn fourth">
                 Δημιουργώντας λογαριασμό αποδέχεστε τη συμφωνία με τους <a href="#">Όρους Χρήσης</a> και <a href="#">Πολιτική Απορρήτου</a>.
             </div>
         </div>
     </div>
 </form>

 <br>
 <br>

 <?php include('footer.php') ?>