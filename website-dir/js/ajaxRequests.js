function createProfilePost(profileData) {
    $.ajax({
        url: "php/request.php",
        method: "GET",
        data: {
            action: "",
            forename: profileData[0],
            surname: profileData[1],
            email: profileData[2],
            pwd: profileData[3],
            address: profileData[4],
            phone: profileData[5],
            city: profileData[6],
            country: profileData[7],
            zip: profileData[8]
        },
        success: function (response) {
            console.log("Success", response);
            /*
            if (data !== 'success') {
                $('#error_message').html(data);
            } else {
                $('form').trigger('reset');

                //TODO find better way to update the placeholders w/ SESSION-data
                window.location.reload();

                $('#success_message').fadeIn().html('Änderungen vorgenommen');
                setTimeout(function () {
                    $('#success_message').fadeOut('Slow');
                }, 20000);
            }*/
        },
        error: function (response) {
            console.log("Error", response)
        }
    });
}

function createRequestUserByID(u_id) {
    $.ajax({
        url: "php/request.php",
        method: "GET",
        data: {
            action: "requestUserByID",
            u_id: u_id
        },
        success: function (response) {
            console.log("Success", response);
        },
        error: function (response) {
            console.log("Error", response);
        }
    });
}
