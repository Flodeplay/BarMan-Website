function createProfilePost(profileData) {
    $.ajax({
        url: "request.php",
        method: "POST",
        data: {
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
        success: function (data) {

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
            }
        }
    });
}
