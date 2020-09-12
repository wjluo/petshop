<?php
include('inc/header.php');
?>
<div>
    <form name="userLoginForm" method="post" action="<?php echo htmlspecialchars('server.php') ?>" onsubmit="return validateLoginForm()">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Login Form -->
                <input type="email" id="email" class="fadeIn first" name="email" placeholder="email" required>
                <input type="password" id="password" class="fadeIn first" name="password" placeholder="password" required>
                <input type="submit" name="login_user" class="fadeIn third" value="ΕΙΣΟΔΟΣ">
                <div id="formFooter" class="fadeIn fourth">
                    <!-- Νέος λογαριασμός -->
                    Νέος χρήστης; <a class="underlineHover" href="registration.php" id="noLinkUnderline">Δημιουργία λογαριασμού</a>
                    <!-- Υπενθύμιση κωδικού --><br>
                    <a class="underlineHover" href="#" id="noLinkUnderline">Υπενθύμιση κωδικού</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?php include('inc/footer.php'); ?>