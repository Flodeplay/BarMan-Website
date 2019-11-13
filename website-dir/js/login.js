var login = true;
$(".register-input").toggle();
/*
   prüft die login felder
   @param: none
   @return: gibt zurück (true/false) ob die eingaben richtig waren
 */
function checkLogin() {
    resetlogin();
    var ret = true;
    var errorstr = "";
    if (document.login.username.value.length === 0) {
        errorstr += "Username darf nicht leer sein!";
        document.login.username.classList.add("input-wrong");
        document.getElementById("username_text").classList.add("input-wrong-text");
        ret = false;
    }
    if (document.login.pwd.value.length < 8) {
        errorstr += "Passwort darf nicht unter 8 Zeichen sein!";
        document.login.pwd.classList.add("input-wrong");
        document.getElementById("password_text").classList.add("input-wrong-text");
        ret = false;
    }
    if (!login) {
        if (document.login.email.value.length > 8) {
            if (!validateEmail(document.login.email.value)) {
                errorstr += "Bitte Richtiges Email-Format eingeben";
                document.login.email.classList.add("input-wrong");
                document.getElementById("email_text").classList.add("input-wrong-text");
                ret = false;
            }
        }
        else {
            document.login.email.classList.add("input-wrong");
            document.getElementById("email_text").classList.add("input-wrong-text");
            errorstr += "Email darf nicht leer sein!";
            ret = false;
        }
        }
    if (!ret) {
        $("#error-message").text(errorstr);
    }

    return ret;
}

function resetlogin() {
    try {
        var c = document.login.children;
        for (let i = 0; i < 6; i++) {
            if (c[i].classList.contains("input-wrong") || c[i].classList.contains("input-wrong-text")) {
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
    if(login){
        $(".change-login span").text = "Doch lieber Anmelden";
    }
    else{
        $(".change-login span").text = "Brauchst du ein Konto";
    }
    $(".register-input").toggle();
    $(".login-input").toggle();
});
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}