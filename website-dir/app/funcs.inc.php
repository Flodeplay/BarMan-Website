<?php
require 'class/post.php';
require 'class/user.php';
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
        require_once 'config-local.php';
        $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        if ($conn) {
            return $conn;
        } else {
            throw new Exception("Connection with Database could not be accomplished!");
        }

}

// TODO remove useless functions from thrifter!

/**
 * gibt die Posts von einem user zurück
 * @param user->u_id, wenn gefüllt dann wird der besagte user gesucht und seine beiträge zurückgegeben
 * @return bool
 * @author: Florian Parfuss
 * @date: 19.11.2018
 *
 * @throws Exception
 */
function getPostsbyUser($user_id, $count = 10)
{
    if (isset($user_id)) {
        $posts = array();
        $query = mysqli_query(establishDB(), "select p_post.p_id,p_post.p_title,p_post.p_price, p_post.p_image,p_post.p_description,p_post.p_createtime, p_post.p_u_user,col_colors.col_name as p_col_color, b_brands.b_name as p_b_brand,g_genders.g_name as p_g_gender,con_conditions.con_description as p_con_condition,ca_categories.ca_name as p_ca_category,s_sizes.s_unittype as p_s_size_type,s_sizes.s_value as p_s_size_value, u_zipcode from p_post
                                                    inner join u_users on p_u_user = u_id
                                                    inner join col_colors on p_post.p_col_color = col_colors.col_id
                                                    inner join b_brands on p_post.p_b_brand = b_brands.b_id
                                                    inner join g_genders on p_post.p_g_gender = g_genders.g_id
                                                    inner join con_conditions on p_post.p_con_condition = con_conditions.con_id
                                                    inner join ca_categories on p_post.p_ca_category = ca_categories.ca_id
                                                    inner join s_sizes on p_post.p_s_size = s_sizes.s_id
                                                    WHERE p_u_user = " . $user_id . " LIMIT " . $count . ";");
        if (mysqli_num_rows($query) > 0) {
            $index = 0;
            while ($row = mysqli_fetch_assoc($query)) {
                $posts[$index] = new post($row["p_id"], $row["p_title"], $row["p_price"], $row["p_image"], $row["p_description"], $row["p_createtime"], $row["p_u_user"], $row["p_col_color"], $row["p_b_brand"], $row["p_g_gender"], $row["p_con_condition"], $row["p_ca_category"], ($row["p_s_size_value"] . " (" . $row["p_s_size_type"] . ")"), $row["u_zipcode"]);
                $index++;
            }
            printProduct($posts);
            return true;
        } else {
            echo "Keine Produke vorhanden";
            return false;
        }

    } else {
        echo "Fehler! User nicht richtig";
        return false;
    }
}

/**
 * Gibt EINEN user
 * @param $user_id user id
 * @Exception wirft eine Exception falls die User_ID Null ist
 * @author: florian
 * @Date 19.11.2018
 * @throws Exception
 */
function getUserbyID($user_id)
{
    if (isset($user_id)) {
        $query = mysqli_query(establishDB(), "SELECT * FROM u_users WHERE u_id = '$user_id ';");
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            return new user($row["u_id"],$row["u_username"],$row["u_forename"], $row["u_surname"],$row["u_email"],$row["u_createtime"], $row["u_description"], $row["u_image"], $row["u_phonenumber"], $row["u_zipcode"]);
        } else {
            return false;
        }
    } else {
        throw new Exception("Fehler! User darf nicht 0 sein");
    }
}

/**
 * Gibt EINEN user zurück
 * @Exception wirft eine Exception falls die User_ID Null ist
 * @author: florian
 * @Date 19.11.2018
 * @param $u_username
 * @return user
 * @throws Exception
 */
function getUserbyName($u_username)
{
    if (isset($u_username)) {
        $query = mysqli_query(establishDB(), "SELECT * FROM u_users WHERE u_username = '$u_username ';");
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            return new user($row["u_id"],$row["u_username"],$row["u_forename"], $row["u_surname"],$row["u_email"],$row["u_createtime"], $row["u_description"], $row["u_image"], $row["u_phonenumber"], $row["u_zipcode"]);
        } else {
            throw new Exception("Kein User vorhanden!");
        }
    } else {
        throw new Exception("Eingabe ist falsch!");
    }
}

/**
 * Gibt zurück ob ein User vorhanden ist
 * @param user ID
 * @Exception wirft eine Exception falls die User_ID Null ist
 * @author: florian
 * @Date 19.11.2018
 * @throws Exception
 */
function isUserbyName($username)
{
    $username = mysqli_real_escape_string(establishDB(), $username);
    if (isset($username) || !isEmpty($username)) {
        $query = mysqli_query(establishDB(), "SELECT * FROM u_users WHERE u_username = '$username';");
        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        throw new Exception("Felher! Parameter Falsch!");
    }
}

/**
 * Gibt zurück ob ein user vorhanden ist
 * @param user ID
 * @Exception wirft eine Exception falls die User_ID Null ist
 * @author: florian
 * @Date 19.11.2018
 * @throws Exception
 */
function isUserbyEmail($email)
{
    $email = mysqli_real_escape_string(establishDB(), $email);
    if (isset($email)) {
        $query = mysqli_query(establishDB(), "SELECT * FROM u_users WHERE u_email = '$email';");
        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        throw new Exception("Fehler! Parameter Falsch");
    }
}

/**
 * Gibt zurück ob ein user existiert
 * @param: user ID
 * @Exception: Wird geworfen falls
 * @Author: Florian Parfuss
 * @Date: 19.11.2018
 * @throws Exception
 */
function isUserbyID($user_id)
{
    if (isset($user_id) || !isEmpty()) {
        $query = mysqli_query(establishDB(), "SELECT * FROM u_users WHERE u_id = '$user_id';");
        if (mysqli_num_rows($query) > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        throw new Exception("Fehler! Parameter Falsch");
    }
}

/**
 * Gibt zurück ob ein Betrag von dem eingeloggten user geliked ist
 * @param $p_id post id
 * @param $u_id user id
 * @return bool
 * @throws Exception
 * @var $_Session["u_user"] user
 */
function checkPostLiked($p_id){
    $user = $_SESSION["u_user"]->u_id;
    if(isset($p_id)){
        $query = mysqli_query(establishDB(), "SELECT * FROM f_favorites where f_u_user = $user && f_p_post = $p_id;");
        if(mysqli_num_rows($query) == 1){
            return true;
        }
        else{
            return false;
        }
    }
    else {
        throw new Exception("Parameter darf nicht 0 sein");
    }
}

/**
 * gibt einen Post zurück
 * @param $post_id
 * @throws Exception
 */
function getPostbyID($post_id){
    if(isset($post_id) || !isEmpty($post_id)){
        $query = mysqli_query(establishDB(), "select p_post.p_id,p_post.p_title,p_post.p_price, p_post.p_image,p_post.p_description,p_post.p_createtime, p_post.p_u_user,col_colors.col_name as p_col_color, b_brands.b_name as p_b_brand,g_genders.g_name as p_g_gender,con_conditions.con_description as p_con_condition,ca_categories.ca_name as p_ca_category,s_sizes.s_unittype as p_s_size_type,s_sizes.s_value as p_s_size_value, u_zipcode from p_post
                                                    inner join u_users on p_u_user = u_id
                                                    inner join col_colors on p_post.p_col_color = col_colors.col_id
                                                    inner join b_brands on p_post.p_b_brand = b_brands.b_id
                                                    inner join g_genders on p_post.p_g_gender = g_genders.g_id
                                                    inner join con_conditions on p_post.p_con_condition = con_conditions.con_id
                                                    inner join ca_categories on p_post.p_ca_category = ca_categories.ca_id
                                                    inner join s_sizes on p_post.p_s_size = s_sizes.s_id
                                                    where p_id = ' $post_id';");
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            return new post($row["p_id"],$row["p_title"],$row["p_price"],$row["p_image"],$row["p_description"],$row["p_createtime"],$row["p_u_user"],$row["p_col_color"],$row["p_b_brand"],$row["p_g_gender"],$row["p_con_condition"], $row["p_ca_category"], ($row["p_s_size_value"] . " (" . $row["p_s_size_type"] . ")" ),$row["u_zipcode"]);
        }
        else{
            throw new Exception("Fehler!");
        }
    }
    else {
        throw new Exception("Parameter darf nicht 0 sein");
    }
}
/** @var post[] $posts */
function printProduct($posts)
{
    echo "<div class=\"row\">";
    foreach ($posts as $key => $post){
        echo $post->__toString();
    }
    echo "</div>";
}
