function readProfileData() {
    let profileData = [];
    profileData[0] = readInput('inputForename');
    profileData[1] = readInput('inputSurname');
    profileData[2] = readInput('inputEmail');
    profileData[3] = readInput('inputPwd');
    profileData[4] = readInput('inputAddress');
    profileData[5] = readInput('inputPhone');
    profileData[6] = readInput('inputCity');
    profileData[7] = readInput('inputCountry');
    profileData[8] = readInput('inputZip');

    return profileData;
}

function verifyProfileData() {
    let profileData = readProfileData();
    if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(profileData[2])) {
        return true;
    } else {
        return false;
    }
}

function writeProfileData() {
    
}

function linkDevice() {
    let nr = readInput('inputDeviceNo');
    let pw = readInput('inputDevicePwd');
    console.log(nr, pw);
}

function readInput(id) {
    return $('#' + id).val();
}