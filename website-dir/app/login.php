<?php
error_reporting(0);
session_start();
//checkSession();
include_once "funcs.inc.php";
include "classes/user.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="description" content="The barman website">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="barman drinks mixing bartender bar alcohol">
    <meta name="author" content="Manuel Koellner">
    <!-- extern stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <!-- costume stylesheets -->
    <link rel="stylesheet" href="../css/custom/base.css">
    <link rel="stylesheet" href="../css/custom/nav.css">
    <link rel="stylesheet" href="../css/custom/wave.css">
    <link rel="stylesheet" href="../css/custom/user-home.css">
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/inputmask/jquery.inputmask.js"></script>
    <!-- favicons -->
    <title>Login</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <span class="navbar-brand mb-0 h1">Barman</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<script>
    $(window).scroll(function () {
        $('nav a').toggleClass('scrolled', $(this).scrollTop() > 300);
        $('ul').toggleClass('ulScrolled', $(this).scrollTop() > 465);
    });
</script>

<div class="jumbotron jumbotron-fluid m-0 bg-transparent sec" style="height: 100vh;">
    <div class="row  justify-content-center">
        <div class="col-md-4">
            <div class="align-self-center p-2 w-100 bd-highlight text-light">
                <h1>Willkommen bei BarMan!</h1>
                <blockquote>Hier kannst du dich anmelden und Registrieren</blockquote>
            </div>
        </div>
        <div class="col-md-4 bg-white shadow-lg">
            <?php
            if (isset($_POST["submit"])) {
                try {
                    $conn = establishDB();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                try {
                    if ($conn) {
                        switch ($_POST["submit"]) {
                            case "login":
                                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                                $pwd = hash("sha384", $_POST["pwd"], FALSE);
                                $query = mysqli_query($conn, "SELECT * FROM u_users WHERE u_email = '$email' AND u_password LIKE '$pwd';");
                                if (mysqli_num_rows($query) == 1) {
                                    $data = mysqli_fetch_assoc($query);
                                    $user_local = new user(urldecode($data["u_id"]), urldecode($data["u_forename"]), urldecode($data["u_surname"]), urldecode($data["u_email"]));
                                    $_SESSION["u_user"] = $user_local;
                                    echo "<div class='w-100 d-flex flex-column align-items-center justify-content-center'>";
                                    echo "<div class='mx-auto my-3'><i class=\"fas fa-spinner fa-spin fa-4x\"></i></div>";
                                    echo "<div>Sie werden gleich weitergeleitet</div>";
                                    echo
                                    "<script type='text/javascript'>
                                window.location.href = 'userHome.php';
                                </script></div>";
                                } else {
                                    throw new Exception("Passwort Oder E-Mail ist Falsch!");
                                }
                                break;
                            case "reg":
                                $email = filter_var(mysqli_real_escape_string($conn, $_POST["email"]), FILTER_VALIDATE_EMAIL);
                                $forename = mysqli_real_escape_string($conn, $_POST["forename"]);
                                $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
                                $pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
                                $pwd = hash("sha384", $_POST["pwd"], FALSE);
                                ///Testet Ob Username vorhanden
                                if (isset($email)) {
                                    $query = mysqli_query($conn, "SELECT * FROM u_users WHERE u_email = '$email';");
                                    if (mysqli_num_rows($query) == 1) {
                                        throw new Exception("Email existiert bereits!");
                                    }
                                } else {
                                    throw new Exception("Fehler! Parameter Falsch!");
                                }
                                mysqli_query($conn, "INSERT INTO u_users (u_forename, u_surname, u_email, u_password) VALUES ('$forename','$surname','$email','$pwd');");
                                $query = mysqli_query($conn, "SELECT * FROM u_users WHERE u_email = '$email' AND u_password LIKE '$pwd';");
                                if (mysqli_num_rows($query) == 1) {
                                    $data = mysqli_fetch_assoc($query);
                                    $user_local = new user(urldecode($data["u_id"]), urldecode($data["u_forename"]), urldecode($data["u_surname"]), urldecode($data["u_email"]));
                                    $_SESSION["u_user"] = $user_local;
                                    echo "<div class='w-100 d-flex flex-column align-items-center justify-content-center'>";
                                    echo "<div class='mx-auto my-3'><i class=\"fas fa-spinner fa-spin fa-4x\"></i></div>";
                                    echo "<div>Sie werden gleich weitergeleitet</div>";
                                    echo
                                    "<script type='text/javascript'>
                                window.location.href = 'userHome.php';
                                </script></div>";
                                }
                                break;
                            default:
                                throw new Exception("Formular malformed");
                        }
                        mysqli_close($conn);
                        $conn = null;
                    } else {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                } catch (Exception $e) {
                    echo(file_get_contents('../html/login.html'));
                    echo "<script type='text/javascript'>$(\"#error-message\").text('" . $e->getMessage() . " Bitte erneut Anmelden!');</script>";
                }
            } else {
                echo file_get_contents('../html/login.html');
            }
            ?>
        </div>
    </div>
    <div class="wave"></div>
</div>
</body>
</html>