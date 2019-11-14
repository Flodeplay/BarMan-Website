<?php
error_reporting(0);
session_start();
//checkSession();
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
    <!-- links -->
    <!-- TODO: tba -->
    <link rel="author" href="humans.txt">
    <link rel="license" href="copyright.html">
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
    <!-- tba -->
    <title>Mein Barman</title>
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <button class="btnContainer">
                <i class="fas fa-sign-out-alt"></i>
            </button>
            <button class="btn btn-block btnContainer d-flex">
                <p class="m-0 w-100 align-self-center">Logout</p>
                <div class="align-self-center flex-shrink-1">
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x icon-background"></i>
                        <i class="fas fa-sign-out-alt fa-stack-1x"></i>
                    </span>
                </div>
            </button>
        </div>
    </nav>
    <script>
        $(window).scroll(function() {
            $('nav a').toggleClass('scrolled', $(this).scrollTop() > 300);
            $('ul').toggleClass('ulScrolled', $(this).scrollTop() > 465);
        });
    </script>
    <div class="jumbotron jumbotron-fluid m-0 bg-transparent text-light sec">
        <div class="pl-5 pr-5 d-flex bd-highlight">
            <div class="align-self-center p-2 w-100 bd-highlight">
                <h1>Willkommen bei deinem Barman, <i>XY</i></h1>
                <blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora totam delectus, eius nostrum aspernatur voluptas enim fugit ipsa magni voluptatem, odio sit accusamus vel id, commodi consequuntur possimus repellat necessitatibus!</blockquote>
            </div>
            <div class="align-self-center p-2 flex-shrink-1 bd-highlight">
                <img style="border-radius: 20px; float: right" src="../assets/users/Manuel.jpg" height="100px"/>
            </div>
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
                        <br>
                        <blockquote>Hier stehen Informationen ...</blockquote>
                        <p>TODO/IDEA: add a flow diagram which describes the settings to the user</p>
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
                                Um dich mit einem Barman zu verbinden, sind hier die notwendigen Felder auszufüllen. Du kannst aber auch, mit deinem Smartphone oder deinem Tablet, den QR-Code direkt von einem Barman scannen, um die Felder automatisch auszufüllen.
                                Solltest du Probleme beim Verbinden mit dem Barman haben, dann wende dich bitte an unser Support-Team!
                            </i>
                        </blockquote>
                        <br>
                        <form>
                            <div class="pl-5 pr-5 w-75 m-auto">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputForename">Geräte-Nummer</label>
                                        <input type="text" class="form-control" id="inputDeviceNo" data-inputmask="'mask': '9999-9999-9999'" placeholder="1291-1201-1301">
                                        <script>
                                            $(":input").inputmask();
                                        </script>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputSurname">Geräte-Passwort</label>
                                        <input type="password" class="form-control" id="inputDevicePwd" placeholder="devicePassword">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-block btnContainer d-flex">
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
                    <h2 class="">Flüssigkeiten</h2>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora totam delectus, eius nostrum aspernatur voluptas enim fugit ipsa magni voluptatem, odio sit accusamus vel id, commodi consequuntur possimus repellat necessitatibus!</p>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2 class="">Getränke</h2>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur saepe vel facilis quae nihil ad aspernatur ex delectus. Tenetur nulla voluptates similique quos, quia possimus, magnam esse natus quis ipsa.</p>
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
                            <i>Hier kannst du deine persönlichen Daten ändern, erweitern oder auch löschen. Außerdem kannst du hier sehen, was wir über dich wissen, falls du Fragen dazu hast, kannst du weiter unten ein Kontakformular ausfüllen und uns dein Anliegen mitteilen :)</i>
                        </blockquote>
                        <form>
                            <div class="pl-5 pr-5">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputForename">Vorname</label>
                                        <input type="text" class="form-control" id="inputForename" placeholder="Max">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputSurname">Nachname</label>
                                        <input type="text" class="form-control" id="inputSurname" placeholder="Mustermann">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail">E-Mail</label>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="example@gmail.com">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPwd">Passwort</label>
                                        <input type="password" class="form-control" id="inputPwd" pattern=".{6,}" placeholder="your password">
                                    </div>
                                </div>
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
                                <!--
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
                                <button class="btn btn-block btnContainer d-flex">
                                    <p class="m-0 w-100 align-self-center">Änderungen speichern?</p>
                                    <div class="align-self-center flex-shrink-1">
                                        <span class="fa-stack fa-md">
                                            <i class="fas fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fas fa-check fa-stack-1x"></i>
                                        </span>
                                    </div>
                                </button>
                                <!-- FIXME: Modal-saveChanges -->
                                <div class="modal fade" id="saveChangesModal" tabindex="-1" role="dialog" aria-labelledby="saveChangesModalTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="saveChangesModalTitle">Änderungen speichern</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <button type="button" class="btn btn-primary">Speichern</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><hr><br>
                            <div>
                                <h4>Anliegen und Fragen</h4>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <blockquote>
                                                <i>Hast du eine konkrete Frage oder ein Problem mit deinem Profil, dem Barman oder hast du sogar einen Fehler auf unserer Website gefunden, dann würden wir uns sehr darüber freuen, wenn du uns eine Nachricht schreibst, damit wir dir weiterhelfen können. Wenn du denkst, dass es sich bei deiner Frage um eine allgemeine Frage handelt, dann würden wir dir empfehlen einen kurzen Blick in unser FAQ zu werfen!</i>
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
