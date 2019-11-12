function createUserUpdatePost(profileData) {
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
