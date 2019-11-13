function createUserUpdate(profileData) {
    $.ajax({
        url: "php/request.php",
        method: "POST",
        data: {
            action: "updateUserByID",
            u_forename: profileData[0],
            u_surname: profileData[1],
            u_email: profileData[2],
            u_pwd: profileData[3],
        },
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function createDeviceConnCheck(deviceConnData) {
    $.ajax({
        url: "php/request.php",
        method: "POST",
        data: {
            action: "getDeviceByParam",
            d_key: deviceConnData[0],
            d_pin: deviceConnData[1]
        },
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            console.error(response);
        }
    });
}