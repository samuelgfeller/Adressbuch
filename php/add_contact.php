<?php  
    require 'dataBaseConnection.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['firstname']) && 
       isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['description']) && 
       isset($_POST['phone']) && isset($_POST['place']) && isset($_POST['plz']) && isset($_POST['date']))
    {
        $error = $message =  '';
        $firstname = $lastname = $email = $username = $description = $phone = $place = $plz = $date = '';

        // Ausgabe des gesamten $_POST Arrays
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        // vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
        if(!empty(trim($_POST['firstname'])) && strlen(trim($_POST['firstname'])) <= 30)
            $firstname = htmlspecialchars(trim($_POST['firstname']));
        else 
            $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";

        // nachname vorhanden, mindestens 1 Zeichen und maximal 30 zeichen lang
        if(!empty(trim($_POST['lastname'])) && strlen(trim($_POST['lastname'])) <= 30)
            $lastname = htmlspecialchars(trim($_POST['lastname']));
        else 
            $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";

        // emailadresse vorhanden, mindestens 1 Zeichen und maximal 100 zeichen lang
        if(!empty(trim($_POST['email'])) && strlen(trim($_POST['email'])) <= 100)
        {
            $email = htmlspecialchars(trim($_POST['email']));
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                $error .= "Geben Sie bitte eine korrekte Email-Adresse ein<br />";
        } 
        else 
            $error .= "Geben Sie bitte eine korrekte Email-Adresse ein.<br />";

        // description
        if(!empty(trim($_POST['description'])) && strlen(trim($_POST['description'])) <= 1000)
            $description = htmlspecialchars(trim($_POST['description']));
        else 
            $error .= "Geben sie eine Beschreibung ein.<br />";
        
        //phone
        if(!empty(trim($_POST['phone'])))
        {
            $phone = htmlspecialchars(trim($_POST['phone']));
            if(!preg_match('/[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/', $phone))
                $error .= "Die Telefon Nummer enspricht nicht dem Schema.<br />";
        }
        else 
            $error .= "Die Telefon Nummer enspricht nicht dem Schema.<br />";
        
        //place
        if(!empty(trim($_POST['place'])) && strlen(trim($_POST['place'])) <= 100)
                $place = htmlspecialchars(trim($_POST['place']));
            else 
                $error .= "Geben sie einen Ort ein.<br />";

        //plz
        if(!empty(trim($_POST['plz'])) && strlen(trim($_POST['plz'])) == 4)
                $plz = htmlspecialchars(trim($_POST['plz']));
            else 
                $error .= "Geben sie das PLZ ein.<br />";
        
         //plz
        if(!empty(trim($_POST['date'])))
        {
            $date = htmlspecialchars(trim($_POST['date']));
            if(!preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $date))
                $error .= "Geben sie ein Datum ein.<br />";
        }
        else 
            $error .= "Geben sie ein Datum ein.<br />";
        
        //löscht Kontakt daten aus $_POST
        if(isset($_POST['firstname']))
            unset($_POST['firstname']);
        if(isset($_POST['lastname']))
            unset($_POST['lastname']);
        if(isset($_POST['email']))
            unset($_POST['email']);
        if(isset($_POST['description']))
            unset($_POST['description']);
        if(isset($_POST['phone']))
            unset($_POST['phone']);
        if(isset($_POST['place']))
            unset($_POST['place']);
        if(isset($_POST['plz']))
            unset($_POST['plz']);
        if(isset($_POST['date']))
            unset($_POST['date']);
        
        // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
        if(empty($error))
        {
            $query = "INSERT INTO contacts (firstname, lastname, email, description, phone, place, plz, date)
            VALUES (?,?,?,?,?,?,?,?); ";

            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ssssssss', $firstname, $lastname, $email, $description, $phone, $place, $plz, $date);		
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            echo($result);

            header("Location: adressbuch.php");
        }
    }
?>