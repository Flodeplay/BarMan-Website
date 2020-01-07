<?php
error_reporting(5);
include_once "classes/user.php";
session_start();
//checkSession();
require 'funcs.inc.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;
switch ($action) {
    case "updateUserByID":
        updateUserByID();
        break;
    case "checkDeviceConn":
        checkDeviceConn();
        break;
    case "updateLiquidBy":
        updateLiquidBy();
        break;
    case "readBeveragesByProfile":
        readBeveragesByProfile();
        break;
    case "getProfiles":
        getProfiles();
        break;
    case "insertProfile":
        insertProfile();
        break;
    case "insertBeverage":
        insertBeverage();
        break;
    case "updateBarmanFK":
        updateBarmanFK();
        break;
    case "readProfilesByUser":
        readProfilesByUser();
        break;
}

function updateUserByID()
{
    try {
        $mysqli = establishDB();
        $u_id = $_SESSION['u_user']->u_id;
        $u_forename = isset($_POST['u_forename']) ? $_POST['u_forename'] : null;
        $u_surname = isset($_POST['u_surname']) ? $_POST['u_surname'] : null;
        $u_email = isset($_POST['u_email']) ? $_POST['u_email'] : null;
        $u_pwd = isset($_POST['u_pwd']) ? $_POST['u_pwd'] : null;
        $sql = 'UPDATE u_users 
                    SET u_forename = ?, 
                    u_surname = ?, 
                    u_email = ?, 
                    u_password = ?
                    WHERE u_id = ?;';

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Update User:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("sssss", $u_forename, $u_surname, $u_email, $u_pwd, $u_id)) {
            echo "Update User:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Update User:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}

function checkDeviceConn()
{
    try {
        $mysqli = establishDB();
        $d_key = isset($_POST['d_key']) ? $_POST['d_key'] : null;
        $d_pin = isset($_POST['d_pin']) ? $_POST['d_pin'] : null;
        $sql = 'SELECT * FROM d_devices
                WHERE d_key = ?
                AND d_pin = ?;';
        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Fetching Device Data:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("ss", $d_key, $d_pin)) {
            echo "Fetching Device Data:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Fetching Device Data:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $result = mysqli_stmt_get_result($stmt);
        $stmt->close();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $delete_p = NULL;
                $u_id = $_SESSION['u_user']->u_id;
                $sql = 'UPDATE d_devices SET d_u_id = ?, d_p_id = ? WHERE d_id = ?;';
                if (!($stmt = $mysqli->prepare($sql))) {
                    echo "Updating UserID as FK:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
                }

                if (!$stmt->bind_param("sss", $u_id, $delete_p, $row['d_id'])) {
                    echo "Updating UserID as FK:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
                }

                if (!$stmt->execute()) {
                    echo "Updating UserID as FK:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
                }
                $stmt->close();
            }
        } else {
            echo "no result while fetching device data for device. Device key or pin incorrect.";
        }
    } catch
    (Exception $e) {
        echo $e;
    }
}

function readBeveragesByProfile()
{
    try {
        $mysqli = establishDB();
        $p_id = isset($_POST['p_id']) ? $_POST['p_id'] : null;
        $sql = 'SELECT b_id, b_name FROM b_beverages
                INNER JOIN pb_profilebeverages pb on b_beverages.b_id = pb.pb_b_id
                INNER JOIN p_profiles pp on pb.pb_p_id = pp.p_id
                WHERE pb.pb_p_id = ?;';
        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Async Reading Beverages:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("s", $p_id)) {
            echo "Async Reading Beverages:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Async Reading Beverages:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"" . urldecode($row['b_id']) . "\">" . urldecode($row['b_name']) . "</option>";
            }
        } else {
            echo "no result while fetching beverages for profile " . $p_id;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo $e;
    }
}

function insertProfile()
{
    try {
        $mysqli = establishDB();
        $p_title = isset($_POST['p_title']) ? $_POST['p_title'] : null;
        $p_u_id = $_SESSION['u_user']->u_id;
        $sql = "INSERT INTO p_profiles (p_title, p_u_id) VALUES (?, ?);";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Insert Profile:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("ss", $p_title, $p_u_id)) {
            echo "Insert Profile:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Insert Profile:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}

function insertBeverage()
{
    try {
        $mysqli = establishDB();
        $b_name = isset($_POST['b_name']) ? $_POST['b_name'] : null;
        $p_id = isset($_POST['p_id']) ? $_POST['p_id'] : null;
        $sqlBeverages = "INSERT INTO b_beverages (b_name) VALUES (?);";
        $sqlLookup = "INSERT INTO pb_profilebeverages (pb_p_id, pb_b_id) VALUES (?, ?);";

        if (!($stmtBeverages = $mysqli->prepare($sqlBeverages))) {
            echo "Insert Beverage:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }
        if (!$stmtBeverages->bind_param("s", $b_name)) {
            echo "Insert Beverage:\r\nBinding parameters failed: (" . $stmtBeverages->errno . ")\r\n" . $stmtBeverages->error;
        }
        if (!$stmtBeverages->execute()) {
            echo "Insert Beverage:\r\nExecute failed: (" . $stmtBeverages->errno . ")\r\n" . $stmtBeverages->error;
        }

        $new_id = $mysqli->insert_id;
        if (!($stmtLookup = $mysqli->prepare($sqlLookup))) {
            echo "Insert Beverage Lookup:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }
        if (!$stmtLookup->bind_param("ss", $p_id, $new_id)) {
            echo "Insert Beverage Lookup:\r\nBinding parameters failed: (" . $stmtLookup->errno . ")\r\n" . $stmtLookup->error;
        }
        if (!$stmtLookup->execute()) {
            echo "Insert Beverage Lookup:\r\nExecute failed: (" . $stmtLookup->errno . ")\r\n" . $stmtLookup->error;
        }

        $stmtBeverages->close();
        $stmtLookup->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}

function updateBarmanFK()
{
    try {
        $mysqli = establishDB();
        $d_p_id = isset($_POST['d_p_id']) ? $_POST['d_p_id'] : null;
        $sql = "UPDATE d_devices SET d_p_id = ? WHERE d_id = '1'";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Update BarmanFK:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("s", $d_p_id)) {
            echo "Update BarmanFK:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Update BarmanFK:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        throw new Exception($e);
    }
}

function readProfilesByUser()
{
    try {
        $mysqli = establishDB();
        $u_id = $_SESSION['u_user']->u_id;
        $sql = 'SELECT * FROM p_profiles WHERE p_u_id = ?;';

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Read Profiles:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("s", $u_id)) {
            echo "Read Profiles:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Read Profiles:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"" . urldecode($row['p_id']) . "\">" . urldecode($row['p_title']) . "</option>";
            }
        } else {
            echo "no result while fetching profiles for user " . $u_id;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo $e;
    }
}