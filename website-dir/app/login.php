<?php
error_reporting(5);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
<body style="height: 100vh; overflow: hidden;">
<nav class="navbar navbar-expand-lg ">
    <a class="navbar-brand" href="#">
        <img src="../assets/bar.png" height="30px" class="d-inline-block align-center" alt=""> Barman
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Features</a>
        </div>
    </div>
</nav>
<script>
    $(window).scroll(function() {
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
                                    $user_local = new user($data["u_id"], $data["u_forename"], $data["u_surname"], $data["u_email"], $data["u_image"]);
                                    $_SESSION["u_user"] = $user_local;
                                    echo "<div class='w-100 d-flex flex-column align-items-center justify-content-center'>";
                                    echo "<div class='mx-auto my-3'><i class=\"fas fa-spinner fa-spin fa-4x\"></i></div>";
                                    echo "<div>Sie werden gleich weitergeleitet</div>";
                                    echo
                                    "<script type='text/javascript'>
                                window.location.href = 'userHome.php';
                                </script></div>";
                                } else {
                                    echo "<h4 class='mb-3 text-danger'>Passwort Oder Benutzername ist Falsch!</h4>";
                                    exit(file_get_contents('../html/login.html'));
                                }
                                break;
                            case "reg":
                                try {
                                    $email = filter_var(mysqli_real_escape_string($conn, $_POST["email"]), FILTER_VALIDATE_EMAIL);
                                    $forename = mysqli_real_escape_string($conn, $_POST["forename"]);
                                    $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
                                    $pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
                                    $pwd = hash("sha384", $_POST["pwd"], FALSE);
                                    ///Testet Ob Username vorhanden
                                        if (isset($email)) {
                                            $query = mysqli_query($conn, "SELECT * FROM u_users WHERE u_email = '$email';");
                                            if (mysqli_num_rows($query) == 1) {
                                                throw new Exception("Email existiert bereits");
                                            }
                                        } else {
                                            throw new Exception("Fehler! Parameter Falsch");
                                        }

                                    mysqli_query($conn, "INSERT INTO u_users (u_forename, u_surname, u_email, u_password) VALUES ('$forename','$forename','$email','$pwd');");
                                    $query = mysqli_query($conn, "SELECT * FROM u_users WHERE u_email = '$email' AND u_password LIKE '$pwd';");
                                    if (mysqli_num_rows($query) == 1) {
                                        $data = mysqli_fetch_assoc($query);
                                        $user_local = new user($data["u_id"], $data["u_forename"], $data["u_surname"], $data["u_email"], $data["u_image"]);
                                        $_SESSION["u_user"] = $user_local;
                                        echo "<div class='w-100 d-flex flex-column align-items-center justify-content-center'>";
                                        echo "<div class='mx-auto my-3'><i class=\"fas fa-spinner fa-spin fa-4x\"></i></div>";
                                        echo "<div>Sie werden gleich weitergeleitet</div>";
                                        echo
                                        "<script type='text/javascript'>
                                window.location.href = 'userHome.php';
                                </script></div>";
                                    }
                                } catch (Exception $e) {
                                    echo "<h4 class='mb-3 text-danger'>" . $e->getMessage() . " Please register again!</h4>";
                                    exit(file_get_contents('../html/login.html'));
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
                }catch (Exception $e){
                    echo "<h4 class='mb-3 text-danger'>" . $e->getMessage() . " Please register again!</h4>";
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