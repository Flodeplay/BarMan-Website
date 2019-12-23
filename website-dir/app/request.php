<?php
//checkSession();
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
}

function updateUserByID()
{
    try {
        $mysqli = establishDB();
        $u_id = 1; //$_SESSION['u_user']->u_id; TODO
        $u_forename = isset($_POST['u_forename']) ? $_POST['u_forename'] : null;
        $u_surname = isset($_POST['u_surname']) ? $_POST['u_surname'] : null;
        $u_email = isset($_POST['u_email']) ? $_POST['u_email'] : null;
        $u_pwd = isset($_POST['u_pwd']) ? $_POST['u_pwd'] : null;
        $sql = 'UPDATE u_users 
                    SET u_forename = ?, 
                    u_surname = ?, 
                    u_email = ?, 
                    u_password = ?, 
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
                echo "<option value=\"" . $row['b_id'] . "\">" . $row['b_name'] . "</option>";
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
        $p_u_id = 1; //$_SESSION['u_user']->u_id; TODO
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
        $sql = "INSERT INTO b_beverages (b_name) VALUES (?);";
        $sql .= "INSERT INTO pb_profilebeverages (pb_p_id, pb_b_id) VALUES (?, LAST_INSERT_ID());";

        if (!($stmt = $mysqli->prepare($sql))) {
            echo "Insert Beverage:\r\nPrepare failed: (" . $mysqli->errno . ")\r\n" . $mysqli->error;
        }

        if (!$stmt->bind_param("ss", $b_name, $p_id)) {
            echo "Insert Beverage:\r\nBinding parameters failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Insert Beverage:\r\nExecute failed: (" . $stmt->errno . ")\r\n" . $stmt->error;
        }

        $stmt->close();
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