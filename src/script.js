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

$("#adminButtonUsers").click(function () {

    $("#adminWrapperUsers").removeClass("d-none");
    $("#adminWrapperComments").addClass("d-none");
    $("#adminWrapperPosts").addClass("d-none");

});

$("#adminButtonComments").click(function () {

    $("#adminWrapperComments").removeClass("d-none");
    $("#adminWrapperUsers").addClass("d-none");
    $("#adminWrapperPosts").addClass("d-none");

});

$("#adminButtonPosts").click(function () {

    $("#adminWrapperPosts").removeClass("d-none");
    $("#adminWrapperComments").addClass("d-none");
    $("#adminWrapperUsers").addClass("d-none");

});