<?php  
    require 'dataBaseConnection.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['contact_id']))
    {
        $error = '';
        $contact_id = '';

        // vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
        if(!empty(trim($_POST['contact_id'])) && strlen(trim($_POST['contact_id'])) <= 6)
            $contact_id = htmlspecialchars(trim($_POST['contact_id']));
        else 
            $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";

        //löscht Kontakt daten aus $_POST
        if(isset($_POST['contact_id']))
            unset($_POST['contact_id']);
        
        // 
        if(empty($error))
        {
            $query = "DELETE FROM contacts WHERE id=(?)";

            $stmt = $mysqli->prepare($query);	
            $stmt->bind_param('i', $contact_id);
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
        }
    }

    header("Location: adressbuch.php");
?>