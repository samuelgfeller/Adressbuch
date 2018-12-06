<?php
    require 'dataBaseConnection.php';
    session_start();
    
    header('Location: ../html/adressbuch.html');

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
    {
        $massage = "Erfolgreich eingeloggt!";
        echo "<script type='text/javascript'>alert('$massage');</script>";
        header('Location: ../html/adressbuch.html');
    } 
    else 
    {
        $error_massage = "Einloggen fehlgeschlagen, session wurde nicht gefunden!";
        echo "<script type='text/javascript'>alert('$error_massage');</script>";
        header('Location: login.php');
    }
?>


