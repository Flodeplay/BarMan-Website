<?php
class user
{
    public $u_id;
    public $u_forename;
    public $u_surname;
    public $u_email;
    public $u_pwd;

    /**
     * user constructor.
     * @param $u_forename
     * @param $u_surname
     * @param $u_email
     * @param $u_pwd
     */
    public function __construct($u_forename, $u_surname, $u_email, $u_pwd)
    {
        $this->u_forename = $u_forename;
        $this->u_surname = $u_surname;
        $this->u_email = $u_email;
        $this->u_pwd = $u_pwd;
    }

    function __toString()
    {
        return "" . $this->u_id;
    }
}
?>