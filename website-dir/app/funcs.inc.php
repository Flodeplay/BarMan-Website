<?php
/**
 * Checks if user is logged in
 * @param void
 * @Author: Manuel Köllner
 * @Date: 20.11.2018
 */
function checkSession()
{
    if (!isset($_SESSION["u_user"])) {
        header("Location: login.php");
    }

}

/*
 * Checks if user is logged in
 * @param: none
 * @Author: Florian Parfuss
 * @date: 13.12.2018
 * @return: Boolean (true;false)
 */
function isSession()
{
    if (isset($_SESSION["u_user"])) {
        return true;
    } else {
        return false;
    }
}

/**
 * Establishes Database connection
 * @praram none
 * @return mysqli
 * @Exception: throws exeption wenn verbindung nicht hergestellt werden konnte.
 * @Author: Manuel Köllner
 * @Date: 20.11.2018
 * @throws Exception
 */
function establishDB()
{
    require_once 'config/config-server.php';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    mysqli_query($conn,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($conn) {
        return $conn;
    } else {
        throw new Exception("Connection with Database could not be accomplished!");
    }
}
