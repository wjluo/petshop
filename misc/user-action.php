<?php include('style/css/style_edit.css');

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user WHERE user_id={$user_id}";
$result = mysqli_query($db,$query);

if ($result->num_rows > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $_SESSION['password'] = $row['password'];
        // $address = $row['address'];
        // $date_of_birth = $row['date_of_birth'];
    }
}
?>

<form name="userEditForm" method="post" action="<?php echo htmlspecialchars('user-action-check.php') ?>">
    <div class="wrapper fadeInDown" text="Τροποποίηση Στοιχείων" style="margin-top: 10px">
        <h3 style="text-align: center; color:orange">Τροποποίηση Λογαριασμού</h3>
        <div id="formContent">
            <input type="text" id="firstname" class="fadeIn first" name="firstname" placeholder="Όνομα" value="<?php echo $firstname ?>" required>
            <input type="text" id="lastname" class="fadeIn first" name="lastname" placeholder="Επώνυμο" value="<?php echo $lastname ?>" required>
            <input type="text" id="email" class="fadeIn first" name="email" placeholder="E-mail" value="<?php echo $email ?>" required>
            <input type="password" id="new_password" class="fadeIn first" name="new_password" placeholder="Νέος κωδικός πρόσβασης">
            <input type="password" id="new_password2" class="fadeIn first" name="new_password2" placeholder="Επιβεβαίωση νέου κωδικού">
            <!-- <input type="text" id="address" class="fadeIn second" name="address" value="<?//php echo $address ?>" placeholder="Διεύθυνση">
            <input type="date" id="birthdate" class="fadeIn second" name="date_of_birth" value="<?//php echo $date_of_birth ?>" placeholder="Ημερομηνία Γεννήσεως"> -->
            <button name="edit_user" class="btn btn-primary fadeIn third">Τροποποίηση</button>
        </div>
    </div>
</form>
<div style="text-align:center">
    <button class="btn btn-danger btn-sm fadeIn third" onclick="delete_user()">Διαγραφή</button>
</div>


<script>
    function delete_user() {

        var confirmation = confirm('Θέλετε σίγουρα να διαγράψετε τον λογαριασμό σας;');
        if (confirmation) {
           
            $.ajax({
                type: 'POST',
                url: 'user-action-check.php',
                data: {
                    action: 'delete'
                },
                success: function(response) {

                    alert("Επιτυχής διαγραφή λογαριασμού.");
                    window.location.replace("logout.php");

                },
                fail: function(jqXHR, textStatus, errorThrown) {
                    
                    alert("Κάτι πήγε στραβά κατά τη διαγραφή");
                    console.log(jqXHR.responseText);
                    window.location.replace("index.php?dashboard=user-action");
                }
            });
        }
    }
</script>

<?php include('footer.php'); ?>