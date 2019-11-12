<?php
//checkSession(); TODO
require 'funcs.inc.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;

$u_id = "1"; //$_SESSION['u_user']->u_id; TODO

$forename = isset($_POST['forename']) ? $_POST['forename'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
switch ($action) {
    case "updateUserByID":
        updateUserByID($u_id, $forename, $surname, $email, $pwd);
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
        //"UPDATE u_users SET u_forename = " . $forename . ", u_surname = " . $surname . ", u_email = " . $email . ", u_password = " . $pwd . " WHERE u_id = " . $u_id . ";";
        //UPDATE u_users SET  u_forename = {$forename}, u_surname = {$surname}, u_email = {$email}, u_password = {$pwd} WHERE u_id = {$u_id};
        $conn->close();
    } else {
        throw new Exception("Fehler! UserID muss gegeben sein!");
    }
}