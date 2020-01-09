<?php
error_reporting(5);
include_once "request.php";
include_once "funcs.inc.php";
include_once "classes/user.php";
session_start();
checkSession();
/** @var user $user */
$user = $_SESSION['u_user'];
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
    <script src="../js/readForm.js"></script>
    <script src="../js/ajaxRequests.js"></script>
    <!-- favicons -->
    <!-- tba -->
    <title>Mein Barman</title>
    <script>
        $(document).ready(function () {
            //Prevents the page from reloading when jQuery buttons are pressed! Author: Jasper
            $("button").click(function (event) {
                event.preventDefault();
            });
        });
    </script>
</head>
<body>
<header>
    <!--
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="../assets/bar.png" height="30px" class="d-inline-block align-center" alt="">
            Barman
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
    -->
    <nav class="navbar navbar-expand-lg">
        <span class="navbar-brand mb-0 h1">Barman</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Geräte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Getränke</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
            </ul>
                    <a class="btn btnContainer d-flex" href="logout.php">
                        <p class="m-0 mr-2 w-100 p-0 align-self-center" style="padding-left: 2px !important">Logout</p>
                        <div class="align-self-center flex-shrink-1">
                            <span class="fa-stack fa-sm">
                                <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                <i class="fas fa-sign-out-alt fa-stack-1x"></i>
                            </span>
                        </div>
                    </a>
        </div>
    </nav>
    <script>
        $(window).scroll(function () {
            $('nav a').toggleClass('scrolled', $(this).scrollTop() > 300);
            $('ul').toggleClass('ulScrolled', $(this).scrollTop() > 465);
        });
    </script>
    <div class="jumbotron jumbotron-fluid m-0 bg-transparent text-light sec">
        <div class="pl-5 pr-5 d-flex bd-highlight">
            <div class="align-self-center p-2 w-100 bd-highlight">
                <h1>Hallo <?php echo $user->u_forename ?>,<br> Willkommen bei deinem Barman</h1>
                <blockquote>Mix dir deine Getränke wie nie zuvor! Stelle all deine Lieblingsgetränke nach Belieben
                    zusammen und lass sie dir ohne weiteren Stress von einem <u>BarMan</u> zusammenmischen!
                </blockquote>
            </div>
            <!--<div class="align-self-center p-2 flex-shrink-1 bd-highlight">
                <img style="border-radius: 20px; float: right" src="../assets/users/Manuel.jpg" height="100px"/>
            </div>-->
        </div>
        <br>
        <div class="wave"></div>
    </div>
    <!-- to be deleted -->
    <div class="waveBox"></div>
</header>
<main>
    <!--
    <section class="mw-100 p-0 bg-dark text-light">
        <div class="p-5">
            <h1>Willkommen bei deinem Barman, XY</h1>
            <blockquote>Whatever text ...</blockquote>
        </div>
    </section>
    -->
    <section class="horizontal-list">
        <ul>
            <li id="infoSite" class="active">
                <!-- tba: daily message -->
                <div class="section-content">
                    <div class="container">
                        <h2>Info Seite</h2>
                        <h3>1. Gerät Koppeln</h3>
                        <p>als erstes solltest du deinen BarMan mit deinem Konto koppeln. <br> Dies kannst du im Tab "Geräte Verwaltung" machen.</p>
                        <h3>2. Profil Erstellen</h3>
                        <p>als erstes solltest du deinen BarMan mit deinem Konto koppeln. <br> Dies kannst du im Tab "Geräte Verwaltung" machen.</p>
                        <h3>3. Getränke hinzufügen</h3>
                        <p>als erstes solltest du deinen BarMan mit deinem Konto koppeln. <br> Dies kannst du im Tab "Geräte Verwaltung" machen.</p>
                        <h3>4. Flüssigkeiten verwalten</h3>
                        <p>als erstes solltest du deinen BarMan mit deinem Konto koppeln. <br> Dies kannst du im Tab "Geräte Verwaltung" machen.</p>
                        <h3>5. Getränke zu Flüssigkeiten hinzufügen</h3>
                        <p>als erstes solltest du deinen BarMan mit deinem Konto koppeln. <br> Dies kannst du im Tab "Geräte Verwaltung" machen.</p>

                    </div>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2 class="">Geräte Verwaltung</h2>
                </div>
                <div class="section-content">
                    <div class="container">
                        <h2>Geräte-Verwaltung</h2>
                        <blockquote>
                            <i>
                                Um dich mit einem Barman zu verbinden, sind hier die notwendigen Felder auszufüllen. Du
                                kannst aber auch, mit deinem Smartphone oder deinem Tablet, den QR-Code direkt von einem
                                Barman scannen, um die Felder automatisch auszufüllen.
                                Solltest du Probleme beim Verbinden mit dem Barman haben, dann wende dich bitte an unser
                                Support-Team!
                            </i>
                        </blockquote>
                        <br>
                        <?php
                        try {
                            $mysqli = establishDB();
                            $sql = 'SELECT d_key,p_title FROM d_devices
                                    left outer join p_profiles pp on d_devices.d_p_id = pp.p_id
                                    WHERE d_u_id = ' . $user->u_id . ';';
                            $result = $mysqli->query($sql);
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo "<h2>Verbundenes Gerät</h2>";
                                echo "<blockquote>Key: " . $row['d_key'] . "<br>";
                                if(!empty($row['p_title'])){
                                    echo "Verbundenes Profil: " . $row['p_title'] . "</blockquote><br>";
                                }
                                else{
                                    echo "Verbundenes Profil: Du musst noch ein Profil festlegen</blockquote><br>";
                                }

                            }
                        } catch (Exception $e) {
                            echo $e;
                        }
                        ?>
                        <h2>Neues Gerät verbinden</h2>
                        <form>
                            <div class="pl-5 pr-5 w-75 m-auto">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputForename">Geräte-Nummer</label>
                                        <input type="text" class="form-control" id="inputDeviceNo"
                                               data-inputmask="'mask': '9999-9999-9999'" placeholder="1292-1203-1306"
                                               value="193101163196">
                                        <script>
                                            $(":input").inputmask();
                                        </script>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputSurname">Geräte-Passwort</label>
                                        <input type="password" class="form-control" id="inputDevicePwd"
                                               placeholder="devicePassword" value="123456">
                                    </div>
                                </div>
                                <br>
                                <button type="button" class="btn btn-block btnContainer d-flex"
                                        onclick="checkDeviceConn()">
                                    <p class="m-0 w-100 align-self-center">Verbinden/Koppeln</p>
                                    <div class="align-self-center flex-shrink-1">
                                    <span class="fa-stack fa-md">
                                        <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                        <i class="fas fa-link fa-stack-1x"></i>
                                    </span>
                                    </div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2 class="">Getränkeprofile</h2>
                </div>
                <div class="section-content">
                    <div class="container">
                        <h2>Getränkeprofile</h2>
                        <blockquote>
                            <i>Hier kannst du Profile mit Getränken anlegen, welche du dann dem Barman zuweisen
                                kannst.</i>
                        </blockquote>
                        <h3>Profile</h3>
                        <script>
                            readProfilesByUser();
                        </script>
                        <form>
                            <div class="pl-5 pr-5">
                                <h4>Aktives Profil am BarMan:</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="sel-profile">Wähle aktives Profil für deinen BarMan:</label>
                                        <select id="sel-profile" name="profile" class="form-control"
                                                onchange="readBeveragesByProfile()">
                                            <option disabled selected value> -- wähle dein Profil --</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 my-auto">
                                        <button class="btn btn-block btnContainer d-flex"
                                                onclick="updateBarmanProfileFK()">
                                            <p class="m-0 w-100 align-self-center">Profil festlegen</p>
                                            <div class="align-self-center flex-shrink-1">
                                                <span class="fa-stack fa-md">
                                                    <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                                </span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <h4 class="mt-4">Erstelle ein neues Profil:</h4>
                                <div class="form-row">

                                    <div class="form-group col-md-8">
                                        <label for="sel-profile">Neues Profil anlegen</label>
                                        <input type="text" class="form-control" id="inputProfileName"
                                               placeholder="Profil-Name">
                                    </div>
                                    <div class="form-group col-md-4 my-auto">
                                        <button class="btn btn-block btnContainer d-flex" onclick="writeProfile()">
                                            <p class="m-0 w-100 align-self-center">Neues Profil</p>
                                            <div class="align-self-center flex-shrink-1">
                                                <span class="fa-stack fa-md">
                                                    <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                                </span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>
                        <h3>Getränke</h3>
                        <form>
                            <div class="pl-5 pr-5">
                                <div class="form-row">
                                    <label for="sel-beverage">Wähle dein Getränk:</label>
                                    <select id="sel-beverage" name="beverage" class="form-control">
                                        <option disabled selected value> -- wähle dein Getränk --</option>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="sel-beverage">Neues Getränk erstellen</label>
                                        <input type="text" class="form-control" id="inputBeverageName"
                                               placeholder="Getränk-Name">
                                    </div>
                                    <div class="form-group col-md-4 my-auto">
                                        <button class="btn btn-block btnContainer d-flex" onclick="writeBeverage()">
                                            <p class="m-0 w-100 align-self-center">Getränk erstellen</p>
                                            <div class="align-self-center flex-shrink-1">
                                                <span class="fa-stack fa-md">
                                                    <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                                </span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2 class="">Flüssigkeiten</h2>
                </div>
                <div class="section-content">
                    <div class="container">
                        <h2>Flüssigkeiten</h2>
                        <blockquote>
                            <i>Hier kannst du dem BarMan mitteilen, welche Flüssigkeiten du ihm für das Mischen von
                                Getränken bereit stellst und allen erstellten Getränken die verwendeten Flüssigkeiten
                                zuweisen.</i>
                        </blockquote>
                        <h3>Behälter</h3>
                        <div class="row">
                            <div class="col">
                                <label>vorne links</label>
                                <input type="text" class="form-control" id="inputFrontL"
                                       placeholder="Flüssigkeit">
                            </div>
                            <div class="col">
                                <label>vorne rechts</label>
                                <input type="text" class="form-control" id="inputFrontR"
                                       placeholder="Flüssigkeit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>hinten links</label>
                                <input type="text" class="form-control" id="inputBackL"
                                       placeholder="Flüssigkeit">
                            </div>
                            <div class="col">
                                <label>hinten rechts</label>
                                <input type="text" class="form-control" id="inputBackR"
                                       placeholder="Flüssigkeit">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-md-4 my-auto">
                                <button class="btn btn-block btnContainer d-flex"
                                        onclick="insertLiquid()">
                                    <p class="m-0 w-100 align-self-center">Flüssigkeiten aktualisieren</p>
                                    <div class="align-self-center flex-shrink-1">
                                                <span class="fa-stack fa-md">
                                                    <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                                    <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                                </span>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <br>
                        <h3>Getränkeinhalt</h3>
                        <?php
                             $liquids = getliquidsbyUser();
                        ?>
                        <form>
                            <div class="row">
                                <div class="col">
                                    <label for="sel-beverage">Wähle dein Getränk:</label>
                                    <select id="sel-beverage" name="beverage" class="form-control">
                                        <option disabled selected value> -- wähle dein Getränk --</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-check form-check-inline w-100">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="checkbox" aria-label="Checkbox for following text input">
                                                </div>
                                                <div class="input-group-text">
                                                    <label class="form-check-label" for="inlineCheckbox1"><?php echo $liquids[1] ?></label>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" placeholder="100" aria-label="Text input with checkbox">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ml</span>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-check form-check-inline w-100">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </div>
                                            <div class="input-group-text">
                                                <label class="form-check-label" for="inlineCheckbox1"><?php echo $liquids[2] ?></label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="100" aria-label="Text input with checkbox">
                                        <div class="input-group-append">
                                            <span class="input-group-text">ml</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline w-100">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </div>
                                            <div class="input-group-text">
                                                <label class="form-check-label" for="inlineCheckbox1"><?php echo $liquids[3] ?></label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="100" aria-label="Text input with checkbox">
                                        <div class="input-group-append">
                                            <span class="input-group-text">ml</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-inline w-100">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input">
                                            </div>
                                            <div class="input-group-text">
                                                <label class="form-check-label" for="inlineCheckbox1"><?php echo $liquids[4] ?></label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="100" aria-label="Text input with checkbox">
                                        <div class="input-group-append">
                                            <span class="input-group-text">ml</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2 class="">Profilverwaltung</h2>
                </div>
                <div class="section-content">
                    <div class="container">
                        <h2>Profilverwaltung</h2>
                        <blockquote>
                            <i>Hier kannst du deine persönlichen Daten ändern, erweitern oder auch löschen. Außerdem
                                kannst du hier sehen, was wir über dich wissen, falls du Fragen dazu hast, kannst du
                                weiter unten ein Kontakformular ausfüllen und uns dein Anliegen mitteilen :)</i>
                        </blockquote>
                        <form>
                            <div class="pl-5 pr-5">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputForename">Vorname</label>
                                        <input type="text" class="form-control" id="inputForename"
                                               placeholder="<?php echo $user->u_forename ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputSurname">Nachname</label>
                                        <input type="text" class="form-control" id="inputSurname"
                                               placeholder="<?php echo $user->u_surname ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail">E-Mail</label>
                                        <input type="email" class="form-control" id="inputEmail"
                                               placeholder="<?php echo $user->u_email ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPwd">Passwort</label>
                                        <input type="password" class="form-control" id="inputPwd" pattern=".{6,}"
                                               placeholder="your password">
                                    </div>
                                </div>
                                <!--
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputAddress">Adresse</label>
                                        <input type="text" class="form-control" id="inputAddress" placeholder="Musterstrasse 10">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPhone">Telefon <span style="font-family:arial;font-weight:lighter;font-size:95%;">&numero;</span></label>
                                        <input type="tel" pattern="[\+]\d{2}[\ ]\d{3}[\ ]\d{3}[\ ]\d{4}" class="form-control" id="inputPhone" placeholder="+43 676 123 1234">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputZip">PLZ</label>
                                        <input type="number" pattern="[0-9]{4}" class="form-control" id="inputZip" placeholder="1050">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputCity">Stadt</label>
                                        <input type="text" class="form-control" id="inputCity" placeholder="Wien">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="inputCountry">Land</label>
                                        <input type="text" class="form-control" id="inputCountry" placeholder="Österreich">
                                    </div>
                                </div>
                                -->
                                <br>
                                <button type="button" class="btn btn-block btnContainer d-flex" onclick="updateUser()">
                                    <p class="m-0 w-100 align-self-center">Änderungen speichern?</p>
                                    <div class="align-self-center flex-shrink-1">
                                        <span class="fa-stack fa-md">
                                            <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fas fa-check fa-stack-1x"></i>
                                        </span>
                                    </div>
                                </button>
                                <!-- FIXME: Modal-saveChanges -->
                                <div class="modal fade" id="saveChangesModal" tabindex="-1" role="dialog"
                                     aria-labelledby="saveChangesModalTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="saveChangesModalTitle">Änderungen
                                                    speichern</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Abbrechen
                                                </button>
                                                <button type="button" class="btn btn-primary">Speichern</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <br>
                            <div>
                                <h4>Anliegen und Fragen</h4>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <blockquote>
                                                <i>Hast du eine konkrete Frage oder ein Problem mit deinem Profil, dem
                                                    Barman oder hast du sogar einen Fehler auf unserer Website gefunden,
                                                    dann würden wir uns sehr darüber freuen, wenn du uns eine Nachricht
                                                    schreibst, damit wir dir weiterhelfen können. Wenn du denkst, dass
                                                    es sich bei deiner Frage um eine allgemeine Frage handelt, dann
                                                    würden wir dir empfehlen einen kurzen Blick in unser FAQ zu
                                                    werfen!</i>
                                            </blockquote>
                                        </div>
                                        <div class="col-md-4 my-auto">
                                            <button class="btn btn-block btnContainer d-flex">
                                                <p class="m-0 w-100 align-self-center">Kontaktformular</p>
                                                <div class="align-self-center flex-shrink-1">
                                                    <span class="fa-stack fa-md">
                                                        <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                                        <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                                    </span>
                                                </div>
                                            </button>
                                            <button class="btn btn-block btnContainer d-flex">
                                                <p class="m-0 w-100 align-self-center">FAQ</p>
                                                <div class="align-self-center flex-shrink-1">
                                                    <span class="fa-stack fa-md">
                                                        <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                                        <i class="fas fa-book-open fa-stack-1x"></i>
                                                    </span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- TODO: open CONTACTFORM in Modal/PopUp -->
                            <!-- TODO: integrate input-group to contactform-modal
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="contactform-wrapping">Betreff</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Fragen zu meinem Profil" aria-label="Subject" aria-describedby="contactform-wrapping">
                            </div>
                        -->
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <!--suppress ES6ConvertVarToLetConst -->
        <script>
            var section = $('li');

            function toggleAccordion() {
                var x = document.getElementById('infoSite');
                if (window.getComputedStyle(x).display != 'none') {
                    x.style.display = 'none';
                }
                section.removeClass('active');
                $(this).addClass('active');
            }

            section.on('click', toggleAccordion);
        </script>
    </section>
</main>
</body>
</html>
