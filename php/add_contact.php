<?php          
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $error = $message =  '';
        $firstname = $lastname = $email = $username = $description = $place = $plz = $date = '';

        // Ausgabe des gesamten $_POST Arrays
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        // vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
        if(isset($_POST['firstname']) && !empty(trim($_POST['firstname'])) && strlen(trim($_POST['firstname'])) <= 30)
            $firstname = htmlspecialchars(trim($_POST['firstname']));
        else 
            $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";

        // nachname vorhanden, mindestens 1 Zeichen und maximal 30 zeichen lang
        if(isset($_POST['lastname']) && !empty(trim($_POST['lastname'])) && strlen(trim($_POST['lastname'])) <= 30)
            $lastname = htmlspecialchars(trim($_POST['lastname']));
        else 
            $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";

        // emailadresse vorhanden, mindestens 1 Zeichen und maximal 100 zeichen lang
        if(isset($_POST['email']) && !empty(trim($_POST['email'])) && strlen(trim($_POST['email'])) <= 100)
        {
            $email = htmlspecialchars(trim($_POST['email']));
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
                $error .= "Geben Sie bitte eine korrekte Email-Adresse ein<br />";
        } 
        else 
            $error .= "Geben Sie bitte eine korrekte Email-Adresse ein.<br />";

        // description
        if(isset($_POST['description']) && !empty(trim($_POST['description'])) && strlen(trim($_POST['description'])) <= 1000)

            $description = htmlspecialchars(trim($_POST['description']));
        else 
            $error .= "Geben sie eine Beschreibung ein.<br />";
        
        //phone
        if(isset($_POST['phone']) && !empty(trim($_POST['phone'])))
        {
            $phone = htmlspecialchars(trim($_POST['phone']));
            if(!preg_match('/[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/', $phone))
                $error .= "Die Telefon Nummer enspricht nicht dem Schema.<br />";
        }
        else 
            $error .= "Die Telefon Nummer enspricht nicht dem Schema.<br />";
        
        //place
        if(isset($_POST['place']) && !empty(trim($_POST['place'])) && strlen(trim($_POST['place'])) <= 100)

                $place = htmlspecialchars(trim($_POST['place']));
            else 
                $error .= "Geben sie einen Ort ein.<br />";

        //plz
        if(isset($_POST['plz']) && !empty(trim($_POST['plz'])) && strlen(trim($_POST['plz'])) == 4)

                $plz = htmlspecialchars(trim($_POST['plz']));
            else 
                $error .= "Geben sie ein plz ein.<br />";


        
        // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
        if(empty($error))
        {
            /*
            $password = htmlspecialchars(trim($_POST['password']));
            $firstname = htmlspecialchars(trim($_POST['firstname']));
            $lastname = htmlspecialchars(trim($_POST['lastname']));
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO contacts (email, firstname, lastname, password,username)
            VALUES (?,?,?,?,?); ";

            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sssss', $email, $firstname,$lastname,$password,$username);		
            $stmt->execute();

            $result = $stmt->get_result();
            $stmt->close();
            
            echo($result);
            */
            header("Location: login.php");
        }
    }
?>