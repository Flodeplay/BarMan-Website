function verifyUser(profileData) {
    //[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*
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

function readProfilesByUser() {
    createProfilesByUserRead();
}

function readBeveragesByProfile() {
    let p_id;
    if (document.getElementsByClassName("active-profile")[0] != undefined) {
        p_id = document.getElementsByClassName("active-profile")[0].getAttribute('id');
    }
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

function updateBeverageById() {
    let b_id = $("#sel-beverage-liquids").val();
    let liquidArr = [];
    let combinedAmount = 0;
    for (let i = 0; i < 4; i++) {
        if (document.getElementById('tick-' + (i + 1)).checked) {
            let amount = parseInt($('#input-' + (i + 1)).val());
            combinedAmount += amount;
            let id = document.getElementsByClassName("liq-id")[i].getAttribute('id');
            liquidArr[i] = {"Amount": amount, "ID": id};
        }
    }
    if (combinedAmount >= 20 && combinedAmount <= 400) {
        createUpdateBeverageById(b_id, liquidArr);
    } else {
        if (combinedAmount < 20) {
            alertFailed("Das Getränk muss mindestens 20ml beinhalten. " + combinedAmount + "ml sind nicht genug!");
        }
        if (combinedAmount > 400) {
            alertFailed("Das Getränk darf maximal 400ml beinhalten. " + combinedAmount + "ml sind zu viel!");
        }
    }
}

function deleteBeverageById() {
    let b_id = $("#sel-beverage").val();
    createDeleteBeverageById(b_id);
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
