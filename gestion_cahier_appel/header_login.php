<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Navigation -->
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
                background: linear-gradient(45deg, rgb(27, 173, 40) 48%, #1b1e21 48%);
            }
        </style>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
        <div class="container">
            <a class="navbar-brand" href="" style="text-transform: uppercase;">MY TRACK NOTE</a>
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
                            <a class="dropdown-item" href="connexion."><i class="fa fa-user"></i> Mon Profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="index.php"><i class="fa fa-sign-out"></i> Déconnexion</a>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</div>
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