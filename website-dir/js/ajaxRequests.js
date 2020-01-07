function alertProfile() {
    $(".alertSuccess.profile").show();
    setTimeout(function () {
        $(".alertSuccess.profile").hide();
    }, 2000);
}

function alertBeverage() {
    $(".alertSuccess.beverage").show();
    setTimeout(function () {
        $(".alertSuccess.beverage").hide();
    }, 2000);
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
                console.error(response);
            }
        }
    });
}

function createBeveragesByProfileRead(p_id) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "readBeveragesByProfile",
            p_id: p_id
        },
        success: function (response) {
            document.getElementById('sel-beverage').innerHTML = "<option disabled selected value> -- wähle dein Getränk --</option>";
            document.getElementById('sel-beverage').innerHTML += response;
            document.getElementById('sel-beverageLiquid').innerHTML = "<option disabled selected value> -- wähle dein Getränk --</option>";
            document.getElementById('sel-beverageLiquid').innerHTML += response;
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
            } else {
                readProfilesByUser();
                alertProfile();
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
            } else {
                readBeveragesByProfile();
                alertBeverage();
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
            }
        }
    });
}