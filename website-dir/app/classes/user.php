<?php
class user
{
    public $u_id;
    public $u_forename;
    public $u_surname;
    public $u_email;
    public $u_pwd;
    public $u_address;
    public $u_phone;
    public $u_city;
    public $u_country;
    public $u_zip;

    /**
     * user constructor.
     * @param $u_id
     * @param $u_forename
     * @param $u_surname
     * @param $u_email
     * @param $u_pwd
     * @param $u_address
     * @param $u_phone
     * @param $u_city
     * @param $u_country
     * @param $u_zip
     */
    public function __construct($u_forename, $u_surname, $u_email, $u_pwd, $u_address, $u_phone, $u_city, $u_country, $u_zip)
    {
        $this->u_forename = $u_forename;
        $this->u_surname = $u_surname;
        $this->u_email = $u_email;
        $this->u_pwd = $u_pwd;
        $this->u_address = $u_address;
        $this->u_phone = $u_phone;
        $this->u_city = $u_city;
        $this->u_country = $u_country;
        $this->u_zip = $u_zip;
    }

    function __toString()
    {
        return "" . $this->u_id;
    }

    /*
     * INTERFACE inter_update SECTION
     *
     * All update functions are getting initialized here
     */
    //TODO PLS CHECK! -> only inter_u_email is throwing a exception and triggers the ajax error field!!
    public function inter_u_email($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $conn = establishDB();
            $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_email = '$email' WHERE u_id LIKE " . $this->u_id . ";");
            $this->u_email = $email;
            mysqli_close($conn);
        } else {
            throw new Exception("Invalid email!");
        }
    }

    public function inter_u_surname($surname)
    {
        if ($surname != null && strlen($surname) >= 2) {
            $conn = establishDB();
            $temp = mysqli_real_escape_string($conn, $surname);
            $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_surname = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
            $this->u_surname = $temp;
            mysqli_close($conn);
        } else {
            throw new Exception("Invalid surname!");
        }
    }

    public function inter_u_forename($forename)
    {
        if ($forename != null && strlen($forename) >= 2) {
            $conn = establishDB();
            $temp = mysqli_real_escape_string($conn, $forename);
            $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_forename = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
            $this->u_forename = $temp;
            mysqli_close($conn);
        } else {
            throw new Exception("Invalid forename!");
        }
    }

    public function inter_u_pwd($pwd)
    {
        if ($pwd != null && strlen($pwd) >= 8) {
            $conn = establishDB();
            $temp = hash("sha384", $pwd, FALSE);
            $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_pwd = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
            mysqli_close($conn);
        } else {
            throw new Exception("Passwort muss mindestens 8 Zeichen enthalten!");
        }
    }

    public function inter_u_zip($zipcode)
    {
        if (strlen($zipcode) > 2 && strlen($zipcode) < 11) {
            $conn = establishDB();
            $temp = mysqli_real_escape_string($conn, $zipcode);
            $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_zipcode = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
            $this->u_zipcode = $temp;
            mysqli_close($conn);
        } else {
            throw new Exception("Invalid zipcode!");
        }
    }

    public function inter_u_image($image)
    {
        $this->u_image = $image;
    }

    public function inter_u_phonenr($phonenr)
    {
        if (strlen($phonenr) > 3 && strlen($phonenr) < 20) {
            $conn = establishDB();
            $temp = mysqli_real_escape_string($conn, $phonenr);
            $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_phonenumber = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
            $this->u_phonenumber = $temp;
            mysqli_close($conn);
        } else {
            throw new Exception("Invalid phonenumber!");
        }
    }

    public function inter_u_description($description)
    {
        $conn = establishDB();
        $temp = mysqli_real_escape_string($conn, $description);
        $queryUpdate = mysqli_query($conn, "UPDATE u_users SET u_description = '$temp' WHERE u_id LIKE " . $this->u_id . ";");
        $this->u_description = $temp;
        mysqli_close($conn);
    }

    public function inter_u_birthday()
    {
        // TODO: Implement inter_u_birthday() method.
    }
}
?>