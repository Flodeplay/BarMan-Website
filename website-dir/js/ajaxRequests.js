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
            console.error(response);
        }
    });
}

function createDeviceConnCheck(deviceConnData) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "getDeviceByParam",
            d_key: deviceConnData[0],
            d_pin: deviceConnData[1]
        },
        success: function (response) {
            console.error(response);
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
            console.error(response);
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
            console.error(response);
        }
    });
}

function createBarmanFKUpdate(d_p_id) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
            action: "updateBarmanFK",
            d_p_id: d_p_id
        },
        success: function (response) {
            console.error(response);
        }
    });
}