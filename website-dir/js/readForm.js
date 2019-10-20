//testfunction
function safeProfileData() {
    let forename = readInput('inputForename');
    let surname = readInput('inputSurname');
    let email = readInput('inputEmail');
    let pw = readInput('inputPwd');
    let address = readInput('inputAddress');
    let phonenr = readInput('inputPhone');
    let city = readInput('inputCity');
    let country = readInput('inputCountry');
    let zip = readInput('inputZip');
    if(email.includes('@')) {
        console.log(forename, surname, email, pw, address, phonenr, city, country, zip);
    } else {
        console.error('Email must contain "@"');
    }
}

function linkDevice() {
    let nr = readInput('inputDeviceNo');
    let pw = readInput('inputDevicePwd');
    console.log(nr, pw);
}

function readInput(id) {
    return $('#' + id).val();
}