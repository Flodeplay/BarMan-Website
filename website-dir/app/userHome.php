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
    <link rel="stylesheet" href="../css/custom/home-accordion.css">
    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- favicon -->
    <!-- tba -->
    <title>Mein Barman</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="assets/path/example.png" width="30" height="30" class="d-inline-block align-top" alt="logo">
            Navbar
        </a>
        <button class="navbar-toggle" type="button" data-toggle="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder"Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <script>
        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 1060);
        });
    </script>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Jumbo</h1>
            <p class="lead">Lorem ipsum sit dolor ...</p>
        </div>
    </div>
</header>
<main>
    <section class="mw-100 p-0 bg-dark text-light" style="height: calc(100vh - 70vh)">
        <div class="p-5">
            <h1>Willkommen bei deinem Barman, XY</h1>
            <blockquote>Whatever text ...</blockquote>
        </div>
    </section>
    <section>
        <ul>
            <li>
                <div class="section-title">
                    <h2>Geräte Verwaltung</h2>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit voluptatum temporibus dicta reprehenderit tempore quisquam consequuntur porro omnis laboriosam praesentium at et sapiente, provident sit! Suscipit recusandae, ab ratione dignissimos.</p>
                </div>
            </li>
            <li class="active">
                <div class="section-title">
                    <h2>Flüssigkeiten</h2>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora totam delectus, eius nostrum aspernatur voluptas enim fugit ipsa magni voluptatem, odio sit accusamus vel id, commodi consequuntur possimus repellat necessitatibus!</p>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2>Getränke</h2>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur saepe vel facilis quae nihil ad aspernatur ex delectus. Tenetur nulla voluptates similique quos, quia possimus, magnam esse natus quis ipsa.</p>
                </div>
            </li>
            <li>
                <div class="section-title">
                    <h2>Profilverwaltung</h2>
                </div>
                <div class="section-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, optio illo, delectus deleniti animi accusamus. Laboriosam maiores totam provident aliquam. Unde, incidunt amet officia a obcaecati, ducimus at molestiae nemo.</p>
                </div>
            </li>
        </ul>
        <!--suppress ES6ConvertVarToLetConst -->
        <script>
            var section = $('li');
            function toggleAccordion() {
                section.removeClass('active');
                $(this).addClass('active');
            }
            section.on('click', toggleAccordion);
        </script>
    </section>
</main>
</body>
</html>
