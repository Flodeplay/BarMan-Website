<?php
$action = isset($_POST['action']) ? $_POST['action'] : null;

$u_id = isset($_POST['u_id']) ? $_POST['u_id'] : null;

$forename = isset($_POST['forename']) ? $_POST['forename'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
$address = isset($_POST['address']) ? $_POST['address'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$city = isset($_POST['city']) ? $_POST['city'] : null;
$country = isset($_POST['country']) ? $_POST['country'] : null;
$zip = isset($_POST['zip']) ? $_POST['zip'] : null;
switch ($action) {
    case "requestUserByID":
        requestUserByID($u_id);
        break;
}
function requestUserByID($u_id)
{
    try {
        $conn = establishDB();
        $query = mysqli_query($conn, "SELECT * FROM u_users WHERE u_id LIKE " + $u_id + ";");
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            return new user($row["u_id"], $row["u_email"], $row["u_password"], $row["u_forename"], $row["u_surname"], $row["u_phonenr"], $row["u_address"], $row["u_zip"], $row["u_city"], $row["u_country"]);
        } else {
            throw new Exception("Kein User vorhanden!");
        }
        mysqli_close($conn);
    }
    catch (Exception $e) {
        throw new Exception($e);
    }
}