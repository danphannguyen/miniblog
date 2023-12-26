let printtextarea = "";

function validateForm() {
    let password = document.forms["register"]["passwordRegister"].value;
    let confirmPassword = document.forms["register"]["confirmPassword"].value;
    if (password != confirmPassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }
}

$("#commentSeeMore").click(function () { 

    $("#commentsWrap").toggleClass("heightAuto");

});