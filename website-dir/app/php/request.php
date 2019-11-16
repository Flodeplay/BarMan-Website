<?php
//checkSession(); TODO
require 'funcs.inc.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;
switch ($action) {
    case "updateUserByID":
        updateUserByID();
        break;
    case "getDeviceByParam":
        getDeviceByParam();
        break;
    case "updateLiquidBy":
        updateLiquidBy();
        break;
    case "updateBeverageBy":
        updateBeverageBy();
        break;
}

function updateUserByID()
{
    echo "Update User:";
    $u_id = 1; //$_SESSION['u_user']->u_id; TODO
    if (isset($u_id)) {
        try {
            $u_forename = isset($_POST['u_forename']) ? $_POST['u_forename'] : null;
            $u_surname = isset($_POST['u_surname']) ? $_POST['u_surname'] : null;
            $u_email = isset($_POST['u_email']) ? $_POST['u_email'] : null;
            $u_pwd = isset($_POST['u_pwd']) ? $_POST['u_pwd'] : null;
            $conn = establishDB();
            $sql = 'UPDATE u_users SET u_forename = "' . $u_forename . '", u_surname = "' . $u_surname . '", u_email = "' . $u_email . '", u_password = "' . $u_pwd . '" WHERE u_id = "' . $u_id . '";';
            if ($conn->query($sql) === TRUE) {
                echo "\r\nRecord updated successfully";
            } else {
                echo "\r\nError updating record: " . $conn->error;
            }
            $conn->close();
        } catch (Exception $e) {
            throw new Exception($e);
        }
    } else {
        throw new Exception("\r\nFehler! UserID muss gegeben sein!");
    }
}

function getDeviceByParam()
{
    echo "Device Checkup:";
    try {
        $d_key = isset($_POST['d_key']) ? $_POST['d_key'] : null;
        $d_pin = isset($_POST['d_pin']) ? $_POST['d_pin'] : null;
        $conn = establishDB();
        $sql = 'SELECT * FROM d_devices;';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['d_pin'] == $d_pin && $row['d_key'] == $d_key) {
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
            echo "\r\nNo device in database";
        }
        $conn->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}

//TODO Name
function updateLiquidBy()
{
    echo "Update Liquid:";
    try {
        $conn = establishDB();
        $sql = 'UPDATE l_liquids SET u_forename = "' . $u_forename . '", u_surname = "' . $u_surname . '", u_email = "' . $u_email . '", u_password = "' . $u_pwd . '" WHERE u_id = "' . $u_id . '";';
        if ($conn->query($sql) === TRUE) {
            echo "\r\nRecord updated successfully";
        } else {
            echo "\r\nError updating record: " . $conn->error;
        }
        $conn->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}

//TODO Name
function updateBeverageBy()
{
    echo "Update Beverage:";
    try {
        $conn = establishDB();
        $sql = 'UPDATE b_beverages SET u_forename = "' . $u_forename . '", u_surname = "' . $u_surname . '", u_email = "' . $u_email . '", u_password = "' . $u_pwd . '" WHERE u_id = "' . $u_id . '";';
        if ($conn->query($sql) === TRUE) {
            echo "\r\nRecord updated successfully";
        } else {
            echo "\r\nError updating record: " . $conn->error;
        }
        $conn->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}