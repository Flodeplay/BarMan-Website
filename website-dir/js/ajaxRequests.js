function createUserUpdate(profileData) {
    $.ajax({
        url: "php/request.php",
        method: "POST",
        data: {
            action: "updateUserByID",
            forename: profileData[0],
            surname: profileData[1],
            email: profileData[2],
            pwd: profileData[3],
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
            forename: deviceConnData[0],
            surname: deviceConnData[1]
        },
        success: function (response) {
            return response;
        },
        error: function (response) {
            console.error(response);
        }
    });
}