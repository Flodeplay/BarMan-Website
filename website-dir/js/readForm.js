function readProfileData() {
    let profileData = [];
    profileData[0] = readInput('inputForename');
    profileData[1] = readInput('inputSurname');
    profileData[2] = readInput('inputEmail');
    profileData[3] = readInput('inputPwd');

    return profileData;
}

function verifyProfileData(profileData) {
    if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(profileData[2])) {
        return true;
    } else {
        return false;
    }
}

function updateUser() {
    let profileData = readProfileData();
    if(verifyProfileData(profileData)) {
        createUserUpdatePost(profileData);
    }
}

function linkDevice() {
    let nr = readInput('inputDeviceNo');
    let pw = readInput('inputDevicePwd');
}

function readInput(id) {
    return $('#' + id).val();
}