<?php
//checkSession(); TODO
require 'funcs.inc.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;

$u_id = "1"; //$_SESSION['u_user']->u_id; TODO

$forename = isset($_POST['forename']) ? $_POST['forename'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;

$d_key = isset($_POST['pwd']) ? $_POST['pwd'] : null;
$d_pin = isset($_POST['pwd']) ? $_POST['pwd'] : null;
switch ($action) {
    case "updateUserByID":
        updateUserByID($u_id, $forename, $surname, $email, $pwd);
        break;
    case "getDeviceByParam":
        getDeviceByParam($d_key, $d_pin, $u_id);
        break;
}

function updateUserByID($u_id, $forename, $surname, $email, $pwd)
{
    if (isset($u_id)) {
        $conn = establishDB();
        $sql = 'UPDATE u_users SET u_forename = "' . $forename . '", u_surname = "' . $surname . '", u_email = "' . $email . '", u_password = "' . $pwd . '" WHERE u_id = "'. $u_id . '";';
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
    $conn = establishDB();
    $sql = 'SELECT * FROM d_devices;';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['d_pin'] == $d_pin && $row['d_key'] == $d_key) {
                echo 'Login successful.';
                $sql = 'UPDATE d_devices SET d_u_id = "' . $u_id . '" WHERE d_id = 1;';
                if ($conn->query($sql) === TRUE) {
                    echo "\r\nUserID in device has been updated.";
                } else {
                    echo "\r\nError updating UserID in device: " . $conn->error;
                }
            } else {
                echo 'Login credentials wrong.';
            }
        }
    } else {
        echo "No device in database";
    }
    $conn->close();
}