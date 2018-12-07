<?php
    require 'dataBaseConnection.php';
    session_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>Adressbuch Pro | Home</title>
        </head>
    <body>
        <div class="container">  
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand align-middle" href="adressbuch.php">
                <img src="../img/nav-bar-icon.svg" width="40" height="40" class="d-inline-block align-middle" alt=""> Adressbuch Pro</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item active">
                            <a class="nav-link" href="">Kontakte</a>
                        </li>
                        <?php
                            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
                                echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="sr-only">(current)</span></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="user_info.php">Account Übersicht</a>
                                    <a class="dropdown-item" href="logout.php">Abmelden</a>
                                </div>
                                </li>
                                <li class="nav-item active ">
                                    <a class="nav-link align-middle" >Angemeldet als '.$_SESSION['username'].' <span class="sr-only">(current)</span></a>
                                </li>';
                            else
                                echo '<li class="nav-item active">
                                        <a class="nav-link" align="right" href="login.php">Anmelden <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="register.php">Registrieren <span class="sr-only">(current)</span></a>
                                    </li>';
                        ?>
                    </ul>    
                </div>
            </nav>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>

