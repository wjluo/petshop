function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validateRegistrationForm() {

    var email = document.forms["userRegistrationForm"]["email"].value;
    var inputPassword1 = document.forms["userRegistrationForm"]["password"].value;
    var inputPassword2 = document.forms["userRegistrationForm"]["password2"].value;

    if (!validateEmail(email)) {
        window.alert("Το e-mail δεν είναι σε σωστή μορφή!");
        return false;
    }

    if ((inputPassword1.length && inputPassword2.length) < 8) {
        window.alert("Ο κωδικός πρέπει να περιέχει τουλάχιστον 8 χαρακτήρες!");
        return false;
    } else if (inputPassword1 != inputPassword2) {
        window.alert("Οι κωδικοί δεν ταιριάζουν!");
        return false;
    }

    return true;
}


function validateLoginForm() {

    var email = document.forms["userLoginForm"]["email"].value;

    if (!validateEmail(email)) {
        window.alert("Το e-mail δεν είναι σε σωστή μορφή!");
        return false;
    }

    return true;
}
