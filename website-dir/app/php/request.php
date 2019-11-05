<?php
public user;

$conn = establishDB();
$temp = mysqli_real_escape_string($conn, $description);
$queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_description = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
$this->u_description = $temp;
mysqli_close($conn);

function update(data)
{
        $conn = establishDB();
        mysqli_query($conn, "UPDATE u_users SET u_'data' = 'data' WHERE u_id LIKE " . $this->u_id . ";");
        $this->data = $email;
        mysqli_close($conn);
    } else {
        throw new Exception("Invalid email!");
    }
}
?>