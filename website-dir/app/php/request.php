<?php
//checkSession(); TODO
require 'funcs.inc.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;

$u_id = "1"; //$_SESSION['u_user']->u_id; TODO

$forename = isset($_POST['u_forename']) ? $_POST['u_forename'] : null;
$surname = isset($_POST['u_surname']) ? $_POST['u_surname'] : null;
$email = isset($_POST['u_email']) ? $_POST['u_email'] : null;
$pwd = isset($_POST['u_pwd']) ? $_POST['u_pwd'] : null;

$d_key = isset($_POST['d_key']) ? $_POST['d_key'] : null;
$d_pin = isset($_POST['d_pin']) ? $_POST['d_pin'] : null;
switch ($action) {
    case "updateUserByID":
        updateUserByID($u_id, $forename, $surname, $email, $pwd);
        break;
    case "getDeviceByParam":
        getDeviceByParam($d_key, $d_pin, $u_id);
        break;
}

function updateUserByID($u_id, $u_forename, $u_surname, $u_email, $u_pwd)
{
    if (isset($u_id)) {
        $conn = establishDB();
        $sql = 'UPDATE u_users SET u_forename = "' . $u_forename . '", u_surname = "' . $u_surname . '", u_email = "' . $u_email . '", u_password = "' . $u_pwd . '" WHERE u_id = "'. $u_id . '";';
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
    } else {
        throw new Exception("Fehler! UserID muss gegeben sein!");
    }
}

function getDeviceByParam($d_key, $d_pin, $u_id) {
    echo "Device Checkup:";
    $conn = establishDB();
    $sql = 'SELECT * FROM d_devices;';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['d_pin'] == $d_pin && $row['d_key'] == $d_key) {
                echo "\r\nLogin successful.";
                $sql = 'UPDATE d_devices SET d_u_id = "' . $u_id . '" WHERE d_id = 1;';
                if ($conn->query($sql) === TRUE) {
                    echo "\r\nUserID in device has been updated.";
                } else {
                    echo "\r\nError updating UserID in device: " . $conn->error;
                }
            } else {
                echo "\r\nLogin credentials wrong.";
            }
        }
    } else {
        echo "No device in database";
    }
    $conn->close();
}