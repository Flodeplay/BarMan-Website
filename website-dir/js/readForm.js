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
    deviceConnData[0] = readInput('inputDeviceNo').replace(new RegExp("-", "g"), '');
    deviceConnData[1] = readInput('inputDevicePwd');

    return deviceConnData;
}

function verifyDeviceConn(deviceConnData) {
    let verifyBool = true;
    if(deviceConnData[0].length < 12) {
        verifyBool = false;
    }
    if(deviceConnData[1].length < 6) {
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

function readLiquids() {
    let liquidData = [];
    liquidData[0] = readInput('');

    return liquidData;
}

function verifyLiquids(liquidData) {
    let verifyBool = true;
    if(false) {
        verifyBool = false;
    }
    return verifyBool;
}

function updateLiquids() {
    let liquidData = readLiquids();
    if(verifyDeviceConn(liquidData)) {
        createLiquidUpdate(liquidData);
    }
}

function readBeverages() {
    let beverageData = [];
    beverageData[0] = readInput('');

    return beverageData;
}

function verifyBeverages(beverageData) {
    let verifyBool = true;
    if(false) {
        verifyBool = false;
    }
    return verifyBool;
}

function updateBeverages() {
    let beverageData = readBeverages();
    if(verifyDeviceConn(beverageData)) {
        createLiquidUpdate(beverageData);
    }
}

function readInput(id) {
    return $('#' + id).val();
}