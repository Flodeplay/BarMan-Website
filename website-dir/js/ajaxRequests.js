function alertSuccess(message) {
    $("body").append("<div class=\"alertSuccess alert alert-success\">\n" +
    "    <strong>Success!</strong> " + message + " \n" +
    "</div>");
    $(".alertSuccess").show();
    setTimeout(function () {
        $(".alertSuccess").remove();
    }, 4000);
}

function alertFailed(message) {
    $("body").append("<div class=\"alertFailed alert alert-danger\">\n" +
    "    <strong>Failed!</strong> " + message + "\n" +
    "</div>");
    $(".alertFailed").show();
    setTimeout(function () {
        $(".alertFailed").remove();
    }, 4000);
}

function createUserUpdate(profileData) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "updateUserByID",
            u_forename: profileData[0],
            u_surname: profileData[1],
            u_email: profileData[2],
            u_pwd: profileData[3],
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response);
            }
        }
    });
}

function createDeviceConnCheck(deviceConnData) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "checkDeviceConn",
            d_key: deviceConnData[0],
            d_pin: deviceConnData[1],
        },
        success: function (response) {
            if (response != "") {
                console.log(response);
                alertFailed("Bitte überprüfe nocheinmal deine Eingabe!");
            } else {
                alertSuccess("Dein Gerät ist jetzt mit deinem Account verbunden!")
            }
        }
    });
}

function createBeveragesByProfileRead(p_id) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "getBeveragesByProfile",
            p_id: p_id
        },
        success: function (response) {
            document.getElementById('sel-beverage').innerHTML = "<option disabled selected value> -- wähle dein Getränk --</option>";
            document.getElementById('sel-beverage').innerHTML += response;
            document.getElementById('sel-beverage-liquids').innerHTML = "<option disabled selected value> -- wähle dein Getränk --</option>";
            document.getElementById('sel-beverage-liquids').innerHTML += response;
        }
    });
}

function createProfilesByUserRead() {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "readProfilesByUser"
        },
        success: function (response) {
            document.getElementById('sel-profile').innerHTML = "<option disabled selected value> -- wähle dein Profil -- </option>";
            document.getElementById('sel-profile').innerHTML += response;
        }
    });
}

function createProfileInsert(p_title) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "insertProfile",
            p_title: p_title
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response)
            } else {
                readProfilesByUser();
                alertSuccess("Das Profil wurde erfolgreich hinzugefügt!")
            }
        }
    });
}

function createBeverageInsert(b_name, p_id) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "insertBeverage",
            b_name: b_name,
            p_id: p_id
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response);
            } else {
                readBeveragesByProfile();
                alertSuccess("Das Getränk wurde erfolgreich hinzugefügt!");
            }
        }
    });
}

function createBarmanProfileFKUpdate(d_p_id) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "updateBarmanFK",
            d_p_id: d_p_id
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response);
            } else {
                alertSuccess("Das Profil wurde erfolgreich als aktives Profil gesetzt!");
                $.ajax({
                    url: "request.php",
                    method: "POST",
                    data: {
                        action: "getSelectedProfile",
                    },
                    success: function (response) {
                        document.getElementById('selectedProfile').innerHTML = "Verbundenes Profil: "+response;
                        document.getElementById('selctedDeviceProfile').innerHTML = "Verbundenes Profil: "+response;
                    }
                });
            }
        }
    });
}

function createInsertLiquid(l_data) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "insertLiquid",
            l_data: l_data
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response);
            } else {
                alertSuccess("Die Flüssigkeiten wurden erfolgreich aktualisiert!");
                location.reload();
                createProfilesByUserRead();
            }
        }
    });
}

function createUpdateBeverageById(b_id, l_data) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "updateBeverageById",
            b_id: b_id,
            l_data: l_data
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response);
            } else {
                alertSuccess("Das Getränk wurde erfolgreich aktualisiert!");
            }
        }
    });
}

function createDeleteBeverageById(b_id) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "deleteBeverageById",
            b_id: b_id,
        },
        success: function (response) {
            if (response != "") {
                console.error(response);
                alertFailed(response);
            } else {
                $(".beverage-" + b_id).remove();
                alertSuccess("Das Getränk wurde erfolgreich gelöscht!");

            }
        }
    });
}
