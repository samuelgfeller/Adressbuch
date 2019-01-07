<?php
require 'dataBaseConnection.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['contact_id']) &&
	(isset($_POST['firstname']) || isset($_POST['lastname']) || isset($_POST['email']) || isset($_POST['description']) ||
		isset($_POST['phone']) || isset($_POST['place']) || isset($_POST['plz']) || isset($_POST['date'])))
{
	$error = '';
	$firstname = $lastname = $email = $username = $description = $phone = $place = $plz = $date = '';
	
	$contactValues = []; // Initialising array
	
	
	
	
	
	// vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
	if(!empty(trim($_POST['contact_id'])) && strlen(trim($_POST['contact_id'])) <= 6)
		$id = htmlspecialchars(trim($_POST['contact_id'])); // Adding the id to the array
	else
		$error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
	
	// vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
	if(!empty(trim($_POST['firstname'])) && strlen(trim($_POST['firstname'])) <= 30)
		$contactValues[]['firstname'] = htmlspecialchars(trim($_POST['firstname'])); // Adding the firstname to the array
	else
		$error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
	
	// nachname vorhanden, mindestens 1 Zeichen und maximal 30 zeichen lang
	if(!empty(trim($_POST['lastname'])) && strlen(trim($_POST['lastname'])) <= 30)
		$contactValues[]['lastname'] = htmlspecialchars(trim($_POST['lastname'])); // Adding the lastname to the array
	else
		$error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";
	
	// emailadresse vorhanden, mindestens 1 Zeichen und maximal 100 zeichen lang
	if(!empty(trim($_POST['email'])) && strlen(trim($_POST['email'])) <= 100)
	{
		$contactValues[]['email'] = htmlspecialchars(trim($_POST['email']));
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			$error .= "Geben Sie bitte eine korrekte Email-Adresse ein<br />";
	}
	else
		$error .= "Geben Sie bitte eine korrekte Email-Adresse ein.<br />";
	
	// description
	if(!empty(trim($_POST['description'])) && strlen(trim($_POST['description'])) <= 1000)
		$contactValues[]['description'] = htmlspecialchars(trim($_POST['description'])); // Adding the description to the array
	else
		$error .= "Geben sie eine Beschreibung ein.<br />";
	
	//phone
	if(!empty(trim($_POST['phone'])))
	{
		$contactValues[]['phone'] = htmlspecialchars(trim($_POST['phone'])); // Adding the phone to the array
		if(!preg_match('/[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}/', $phone))
			$error .= "Die Telefon Nummer enspricht nicht dem Schema.<br />";
	}
	else
		$error .= "Die Telefon Nummer enspricht nicht dem Schema.<br />";
	
	//place
	if(!empty(trim($_POST['place'])) && strlen(trim($_POST['place'])) <= 100)
		$contactValues[]['place'] = htmlspecialchars(trim($_POST['place'])); // Adding the place to the array
	else
		$error .= "Geben sie einen Ort ein.<br />";
	
	//plz
	if(!empty(trim($_POST['plz'])) && strlen(trim($_POST['plz'])) == 4)
		$contactValues[]['plz'] = htmlspecialchars(trim($_POST['plz'])); // Adding the NPA to the array
	else
		$error .= "Geben sie das PLZ ein.<br />";
	
	//plz
	if(!empty(trim($_POST['date'])))
	{
		$contactValues[]['date'] = htmlspecialchars(trim($_POST['date'])); // Adding the date to the array
		if(!preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $date))
			$error .= "Geben sie ein Datum ein.<br />";
	}
	else
		$error .= "Geben sie ein Datum ein.<br />";
	
	//löscht Kontakt daten aus $_POST
	if(isset($_POST['contact_id']))
		unset($_POST['contact_id']);
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
		$updArgs = [];
		foreach ($contactValues as $key => $val){
			if(!empty($contactValues[$key])){
				$updArgs[] = $key.'= ?';
			}
		}
		
		$query = 'UPDATE contacts SET '.implode(',',$updArgs).' WHERE id=(?) LIMIT 1';
		
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param('sssssssss', $firstname, $lastname, $email, $description, $phone, $place, $plz, $date, $contact_id);
		$stmt->execute();
		
		$result = $stmt->get_result();
		$stmt->close();
	}
}

header("Location: adressbuch.php");

?>