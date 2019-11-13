function readUser() {
    let profileData = [];
    profileData[0] = readInput('inputForename');
    profileData[1] = readInput('inputSurname');
    profileData[2] = readInput('inputEmail');
    profileData[3] = readInput('inputPwd');

    return profileData;
}

function verifyUser(profileData) {
    let verifyBool = true;
    if (!(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(profileData[2]))) {
        verifyBool = false;
    }
    if(!profileData[0] || profileData[0].trim().length === 0) {
        verifyBool = false;
    }
    if(!profileData[1] || profileData[1].trim().length === 0) {
        verifyBool = false;
    }
    if(profileData[3].length < 8) {
        verifyBool = false;
    }
    return verifyBool;
}

function updateUser() {
    let profileData = readUser();
    if(verifyUser(profileData)) {
        createUserUpdate(profileData);
    }
}

function readDeviceConn() {
    let deviceConnData = [];
    deviceConnData[0] = readInput('inputDeviceNo');
    deviceConnData[1] = readInput('inputDevicePwd');

    return deviceConnData;
}

function verifyDeviceConn(deviceConnData) {
    let verifyBool = true;
    if(deviceConnData[1].length < 8) {
        verifyBool = false;
    }
    return verifyBool;
}

function checkDeviceConn() {
    let deviceConnData = readDeviceConn();
    if(verifyDeviceConn(deviceConnData)) {
        createDeviceConnCheck(deviceConnData);
    }
}

function readInput(id) {
    return $('#' + id).val();
}