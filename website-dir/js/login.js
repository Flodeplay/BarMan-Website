var login = true;
$(".register-input").toggle();
/*
   prüft die login felder
   @param: none
   @return: gibt zurück (true/false) ob die eingaben richtig waren
 */
function checkLogin() {
    try {
        resetlogin();
        var ret = true;
        var errorstr = "";
        if(document.login.email.value.length === 0){
            errorstr += "Email darf nicht unter 8 Zeichen sein!";
            document.login.email.classList.add("input-wrong");
            document.getElementById("inputPwd").classList.add("input-wrong-text");
            ret = false;
        }
        if (document.login.pwd.value.length < 8) {
            errorstr += "Passwort darf nicht unter 8 Zeichen sein!";
            document.login.pwd.classList.add("input-wrong");
            document.getElementById("inputPwd").classList.add("input-wrong-text");
            ret = false;
        }
        if (!login) {
            if (document.login.forename.value.length === 0) {
                errorstr += "Vorname darf nicht leer sein!";
                document.login.forename.classList.add("input-wrong");
                document.getElementById("inputForename").classList.add("input-wrong-text");
                ret = false;
            }
            if (document.login.surname.value.length === 0) {
                errorstr += "Nachname darf nicht leer sein!";
                document.login.surname.classList.add("input-wrong");
                document.getElementById("inputSurname").classList.add("input-wrong-text");
                ret = false;
            }
        }
        if (!ret) {
            $("#error-message").text(errorstr);
        }
        return ret;
    }
    catch (e){
        console.log(e);
        return false;
    }

}

function resetlogin() {
    try {
        var c = document.login.children;
        for (let i = 0; i < 4; i++) {
            if (c[i].children[1].classList.contains("input-wrong") || c[i].children[0].classList.contains("input-wrong-text")) {
                c[i].classList.remove("input-wrong");
                c[i].classList.remove("input-wrong-text");
            }
        }
        $("#error-message").text("");
    }
    catch (e) {
        console.log(e);
    }
}

$(".change-login").click(function () {
    login = !login;
    resetlogin();
    console.log(login);
    if(!login){
        $("span").text = "Doch lieber Anmelden";
    }
    else{
        $("span").text = "Brauchst du ein Konto";
    }
    $(".register-input").toggle();
    $(".login-input").toggle();
});
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}