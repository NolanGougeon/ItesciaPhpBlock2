<?php
session_start();

require_once('Controler/AccesControler.php');
?>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Identification </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">

                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>Identification <span> - Mon Application</span></h1>

            </header>
            <section>
                <div id="container_demo" >
                    <?php
                    if (array_key_exists('username', $_GET) and isset($_GET['username']) and trim($_GET['username'])!=''
                              and array_key_exists('password', $_GET) and isset($_GET['password']) and trim($_GET['password'])!='') {
                        $user = AccesControler::connectionDataAreValid($_GET['username'], $_GET['password']);
                        if ($user) {
                            echo "Vous êtes connectés";
                            $_SESSION['prenom'] =$user[0]['prenom'];
                            $_SESSION['connecte'] = 'YES';
                            header('location: liste.php');
                        } else {
                            header('location: login.php?message=Erreur');
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
    </body>
</html>
<?php

?>
