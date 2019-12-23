function verifyUser(profileData) {
    let verifyBool = true;
    let reg = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    if (reg.test(profileData[2])) {
        console.log("Email")
        verifyBool = false;
    }
    if (profileData[3].length < 8 && profileData[3].length != 0) {
        console.log("pw")
        verifyBool = false;
    }
    return verifyBool;
}

function updateUser() {
    let profileData = [];
    profileData[0] = readInput('inputForename');
    profileData[1] = readInput('inputSurname');
    profileData[2] = readInput('inputEmail');
    profileData[3] = readInput('inputPwd');

    if (verifyUser(profileData)) {
        createUserUpdate(profileData);
    }
}

function verifyDeviceConn(deviceConnData) {
    let verifyBool = true;
    if (deviceConnData[0].length < 12) {
        verifyBool = false;
    }
    if (deviceConnData[1].length < 6) {
        verifyBool = false;
    }
    return verifyBool;
}

function checkDeviceConn() {
    let deviceConnData = [];
    deviceConnData[0] = readInput('inputDeviceNo').replace(new RegExp("-", "g"), '');
    deviceConnData[1] = readInput('inputDevicePwd');

    if (verifyDeviceConn(deviceConnData)) {
        createDeviceConnCheck(deviceConnData);
    }
}

/*
function updateLiquids() {
    let liquidData = readLiquids();
    if (verifyDeviceConn(liquidData)) {
        createLiquidUpdate(liquidData);
    }
}
*/

function readBeveragesByProfile(p_id) {
    createBeveragesByProfileRead(p_id)
}

function verifyWriteProfile(p_title) {
    let verifyBool = true;
    if (p_title.length < 3 && p_title.length > 255) {
        verifyBool = false;
    }
    return verifyBool;
}

function writeProfile() {
    let p_title = readInput('inputProfileName');
    if (verifyWriteProfile(p_title)) {
        createProfileInsert(p_title);
    }
}

function verifyWriteBeverage(b_name, p_id) {
    let verifyBool = true;
    if (b_name.length < 3 && b_name.length > 255) {
        verifyBool = false;
    }
    if (p_id === undefined) {
        verifyBool = false;
    }
    return verifyBool;
}

function writeBeverage() {
    let b_name = readInput('inputBeverageName');
    let p_id = $("#sel-profile").val();
    if (verifyWriteBeverage(b_name)) {
        createBeverageInsert(b_name, p_id);
    }
}

function updateBarmanFK() {
    let d_p_id = $("#sel-profile").val();
    createBarmanFKUpdate(d_p_id);
}

function updateBeverages() {

}

function readInput(id) {
    return encodeURIComponent($('#' + id).val());
}

function calculatePercentage(fullVolume, splitVolume) {
    return (splitVolume * 100) / fullVolume;
}

function calculateVolume(fullVolume, splitPercentage) {
    return (fullVolume * splitPercentage) / 100;
}