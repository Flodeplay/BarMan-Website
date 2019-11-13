<?php
class user
{
    public $u_id;
    public $u_forename;
    public $u_surname;
    public $u_email;
    public $u_image;

    /**
     * user constructor.
     * @param $u_id
     * @param $u_forename
     * @param $u_surname
     * @param $u_email
     * @param $u_image
     */
    public function __construct($u_id, $u_forename, $u_surname, $u_email, $u_image)
    {
        $this->u_id = $u_id;
        $this->u_forename = $u_forename;
        $this->u_surname = $u_surname;
        $this->u_email = $u_email;
        $this->u_image = $u_image;
    }


    function __toString()
    {
        return "" . $this->u_id;
    }
}
?>