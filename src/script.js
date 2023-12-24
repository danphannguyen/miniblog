let printtextarea = "";

function validateForm() {
    var password = document.forms["register"]["passwordRegister"].value;
    var confirmPassword = document.forms["register"]["confirmPassword"].value;
    if (password != confirmPassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }
}