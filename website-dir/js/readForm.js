function verifyUser(profileData) {
    let verifyBool = true;
    let reg = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    if (reg.test(profileData[2])) {
        verifyBool = false;
    }
    if (profileData[3].length < 8 && profileData[3].length != 0) {
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

function readProfilesByUser() {
    createProfilesByUserRead();
}

function readBeveragesByProfile() {
    let p_id = $("#sel-profile").val();
    createBeveragesByProfileRead(p_id);
}

function verifyWriteProfile(p_title) {
    let verifyBool = true;
    if (p_title.length < 3 || p_title.length > 255) {
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
    if (verifyWriteBeverage(b_name, p_id)) {
        createBeverageInsert(b_name, p_id);
    }
}

function updateBarmanProfileFK() {
    let d_p_id = $("#sel-profile").val();
    createBarmanProfileFKUpdate(d_p_id);
}

function insertLiquid() {
    let l_data = [];
    l_data[0] = readInput('inputFrontL');
    l_data[1] = readInput('inputFrontR');
    l_data[2] = readInput('inputBackL');
    l_data[3] = readInput('inputBackR');
    createInsertLiquid(l_data);
}

function readInput(id) {
    return encodeURIComponent($('#' + id).val());
}
