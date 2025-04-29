<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil - Application Cahier de Texte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f7f7;
        }

        .navbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 5px;
        }

        .topbar {
            background-color: #212529;
            padding: 0;
        }

        .topbar .container .row {
            margin: -7px;
            padding: 0;
        }

        .topbar p {
            margin: 0;
            display: inline-block;
            font-size: 13px;
            color: #f1f6ff;
        }

        .topbar ul.info li {
            float: right;
            padding-left: 30px;
            color: #ffffff;
            font-size: 13px;
            line-height: 44px;
        }

        ul.social-network {
            border: none;
            margin: 0;
            padding: 0;
            float: right;
        }

        ul.social-network li {
            display: inline;
            margin: 0 5px;
            padding: 5px 0 0;
            width: 32px;
            text-align: center;
            height: 32px;
            vertical-align: baseline;
            color: #fff;
        }

        .waves-effect {
            position: relative;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            user-select: none;
            vertical-align: middle;
            transition: .3s ease-out;
            color: #fff;
        }

        .mx-background-top-linear {
            background: linear-gradient(45deg, rgb(28, 140, 45) 48%, #1b1e21 48%);
        }

        /* Banner */
        .hero-banner {
            background: url("img/banner.jpg") center center / cover no-repeat;
            height: 80vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .hero-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-banner .content {
            position: relative;
            z-index: 2;
        }

        .hero-banner h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-banner p {
            font-size: 1.5rem;
        }

        /* Footer */
        footer {
            background: #212529;
            color: white;
            padding: 30px 0;
        }

        footer a {
            color: #bbb;
        }

        footer a:hover {
            color: white;
            text-decoration: none;
        }

        .social-icons a {
            margin: 0 10px;
            color: white;
        }

        .social-icons a:hover {
            color: #17a2b8;
        }
    </style>
</head>

<body>

    <div class="fixed-top">
        <header class="topbar">
            <div class="container">
                <div class="row">
                    <!-- social icon-->
                    <div class="col-sm-12">
                        <!-- <ul class="social-network">
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
            <br>
            <style>
                body {
                    margin: 0;
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #212529;
                    background-color: #f7f7f7;
                }

                .navbar {
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                    justify-content: space-between;
                    padding: 5px;
                }

                .topbar {
                    background-color: #212529;
                    padding: 0;
                }

                .topbar .container .row {
                    margin: -7px;
                    padding: 0;
                }

                .topbar p {
                    margin: 0;
                    display: inline-block;
                    font-size: 13px;
                    color: #f1f6ff;
                }

                .topbar ul.info li {
                    float: right;
                    padding-left: 30px;
                    color: #ffffff;
                    font-size: 13px;
                    line-height: 44px;
                }

                ul.social-network {
                    border: none;
                    margin: 0;
                    padding: 0;
                    float: right;
                }

                ul.social-network li {
                    display: inline;
                    margin: 0 5px;
                    padding: 5px 0 0;
                    width: 32px;
                    text-align: center;
                    height: 32px;
                    vertical-align: baseline;
                    color: #fff;
                }

                .waves-effect {
                    position: relative;
                    cursor: pointer;
                    display: inline-block;
                    overflow: hidden;
                    user-select: none;
                    vertical-align: middle;
                    transition: .3s ease-out;
                    color: #fff;
                }

                .mx-background-top-linear {
                    background: linear-gradient(45deg, rgb(33, 150, 54) 48%, #1b1e21 48%);
                }
            </style>
        </header>

        <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
            <div class="container">
                <a class="navbar-brand" href="" style="text-transform: uppercase;">LACODEID.COM</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                        </li>

                        <!-- Langue avec Google Translate -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="langDropdown" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Traduire
                            </a>
                            <div class="dropdown-menu" aria-labelledby="langDropdown">
                                <div id="google_translate_element" style="padding-left: 10px;"></div>
                            </div>
                        </li>

                        <!-- Bienvenue Utilisateur -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> Bienvenue
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="connexion.php"><i class="fa fa-user"></i> Mon Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php"><i class="fa fa-sign-out"></i> Déconnexion</a>
                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- Bannière principale -->
    <section class="hero-banner">
        <div class="content">
            <h1>Bienvenue sur la plateforme</h1>
            <p>Gestion numérique des cahiers de texte et des fiches d’appel</p>
            <a href="connexion.php" class="btn btn-success btn-lg mt-4">Commencer</a>
        </div>
    </section>

    <!-- Section d’introduction -->
    <section class="py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Simplifiez la vie scolaire</h2>
            <p class="lead">Notre application permet aux enseignants, parents et élèves de suivre facilement le cahier de texte, l'appel et les activités pédagogiques depuis n'importe où.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>LACODEID.COM</h5>
                    <p>Plateforme intelligente pour la gestion des cahiers de texte et de l’appel scolaire.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liens utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="connexion.php">connexion</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Suivez-nous</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                        <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                        <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                        <a href="#"><i class="fa fa-envelope fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr style="background: white;">
            <p class="text-center">&copy; 2025 MY TRACK NOTE - Tous droits réservés</p>
        </div>
    </footer>

    <!-- Google Translate -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'fr',
                includedLanguages: 'fr,en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
</body>

</html>