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
                <img src="../img/nav-bar-icon.svg" width="35" height="35" class="d-inline-block align-middle" alt=""> Adressbuch Pro</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ">
                    
                        <?php
                        if(empty($error))
                        {

                            $query = "SELECT * FROM users WHERE username = ?";
                            
                            $stmt = $mysqli->prepare($query);
                            $stmt->bind_param('s', $_SESSION['username']);		
                            $stmt->execute();
                            
                            $result = $stmt->get_result();
                    
                            while($user = $result->fetch_assoc())
                            {
                                if($user['username'] === $_SESSION['username'])
                                {
                                    $lastname = $user['lastname'];
                                    $firstname = $user['firstname'];
                                    $email = $user['email'];
                                		
                                }
                                else
                                {
                                    $error = '  Benutzername oder Password falsch!';
                                }
                            }
                        }
                    
                    
                    
                            //handle navigation items for user and guests
                            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
                                echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="sr-only">(current)</span></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="adressbuch.php">Home</a>
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
            <br>
            <br>
            <div class="container">
                <form method="post" id="sub" action="">
                    

                        <a>Nachname</a> 
                        <input type="text" class="form-control" id="nchnm" disabled=true name="change_lastname" value="<?php echo $lastname;?>" aria-label="Kontaktinformation" aria-describedby="button-addon2"><br />
                        <a>Vorname</a>
                        <input type="text" class="form-control" id="vornm" disabled=true name="change_firstname" value="<?php echo $firstname?>" aria-label="Kontaktinformation" aria-describedby="button-addon2"><br />
                        <a>e-Mail</a>
                        <input type="text" class="form-control" id="mail" disabled=true name="search_mail" value="<?php echo $email?>" aria-label="Kontaktinformation" aria-describedby="button-addon2"><br />
                        <a>Passwort</a>
                        <input type="password" class="form-control" id="psw" disabled=true name="search_text" value="Passwort" aria-label="Kontaktinformation" aria-describedby="button-addon2"><br />


                        <div class="input-group-append">
                            <input type="submit" class="btn btn-dark" name="Suchen" value="Daten ändern" id="button-change"></button>
                        </div>

                    
                </form>
                <script>
                    $("#sub").on("submit",function(){
                        $("#nchnm").prop('disabled', false);
                        $("#vornm").prop('disabled', false);
                        $("#mail").prop('disabled', false);
                        $("#psw").prop('disabled', false);
                    })
                </script> 
                <br>
                <br>
                <?php
                    //search contact             
                    if(isset($_POST['search_text']))
                    {
                      /*  $search_text = htmlspecialchars(trim($_POST['search_text']));
                        if(isset($search_text) && $search_text === "")
                            exit;
                        $query = "SELECT * FROM contacts";
		                $stmt = $mysqli->prepare($query);
		                $stmt->execute();
                        $result = $stmt->get_result();
                        
                        echo '<table class="table"><thead class="text-white bg-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Vorname</th>
                                                <th scope="col">Nachname</th>
                                                <th scope="col">E-Mail</th>
                                                <th scope="col">Beschreibung</th>
                                                <th scope="col">Tel.</th>
                                                <th scope="col">Ort</th>
                                                <th scope="col">PLZ</th>
                                                <th scope="col">Datum</th>
                                            </tr>
                                          </thead><tbody>';

                        $match = false;
                        while($contact = $result->fetch_assoc())
                        {
                            foreach($contact as $contact_info)
		                    {
                                if(stristr(trim($contact_info), $search_text))
                                {
                                    echo '<tr>';
                                    foreach($contact as $contact_info)
                                        echo '<td>'. $contact_info . '</td>';
                                    echo '</tr>';
                                    $match = true;
                                    break;
                                }                                
                            }
                        }
                        if($match === false)
                            echo '<td>'.$search_text.' konnte nicht gefunden werden!</td>';
                        echo '</tbody></table>';
                        if(isset($_POST['search_text']))
                            $_POST['search_text'] = ""; */
                    }
                ?>
            </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>

