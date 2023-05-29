<?php

    require_once 'auth.php';
    if (checkAuth()) {
        header("Location: home.php");
        exit;
    } 

    // Verifica l'esistenza dei dati POST
    if (!empty($_POST["name"])&& !empty($_POST["lastname"])&& !empty($_POST["username"]) && !empty($_POST["password"]) &&
        !empty($_POST["email"]) && !empty($_POST["conferma_password"]) && !empty($_POST["allow"]))
    {

        $error = array();
        $conn = mysqli_connect("localhost", "root") or die(mysqli_error($error));

        mysqli_select_db($conn, "HW1") or die("impossibile connettersi al database");
        
        #USERNAME
        // Controlla che l'username rispetti il pattern specificato
        //preg_match ha come parametri il pattern e l'oggetto
        if(!preg_match('/^[a-z0-9_-]{3,15}$/', $_POST['username'])){ //Pattern
            $error[] = "Username non valido";
        }else{
            $username = mysqli_real_escape_string($conn,$_POST['username']);
            $query = "SELECT username FROM utente WHERE username = '".$username."'";
                echo "dddd";
           $res = mysqli_query($conn, $query); //risultato
            if (mysqli_num_rows($res) > 0) { //numero righe risultato
                $error[] = "Username già utilizzato";
            }
        }

        # PASSWORD
        if (strlen($_POST["password"]) < 8) { //calcola la lunghezza della stringa
            $error[] = "La password non rispetta il numero di caratteri richiesti";
        } 

        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["conferma_password"]) != 0) {
            $error[] = "Errore password";
        }

        # EMAIL
        //Controlla se è un indirizzo email valido
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $error[] = "Email non valida";
        }else{
            //strtolower converte tutti i caratteri in minuscolo
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $query = "SELECT email FROM utente WHERE email = '".$email."'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        # UPLOAD DELL'IMMAGINE DEL PROFILO  
        if (count($error) == 0) { 
            if ($_FILES['profile']['size'] != 0) {
                $file = $_FILES['profile'];
                //exif_imagetype è una funziona integrata in PHP che viene utilizzata per determinare il tipo di un'immagine 
                $type = exif_imagetype($file['tmp_name']);//tmp_name è il nome temporaneo del file caricato che è generato automaticamente da php
                //confronta il tipo di immagine che ha caricato con i tipi a seguire nella funzione cioè la foto deve combaciare con i formati seguenti
                $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
                if (isset($allowedExt[$type])) {
                    if ($file['error'] === 0) {
                        if ($file['size'] < 7000000) {
                            $fileNameNew = uniqid('', true).".".$allowedExt[$type];//uniqId è una funzione che genera un Id unico basato sull'ora corrente in microsecondi
                            $fileDestination = 'uploadphotos/'.$fileNameNew;
                            move_uploaded_file($file['tmp_name'], $fileDestination);// move_uploaded_file sposta un file caricato in una nuova destinazione.
                        } else {

                            $error[] = "L'immagine non deve avere dimensioni maggiori di 7MB";
                        }
                    } else {
                        $error[] = "Errore nel carimento del file";
                    }
                } else {
                    $error[] = "I formati consentiti sono .png, .jpeg, .jpg e .gif";
                }
            }else{
                echo "Non hai caricato nessuna immagine";
            }
        }
        
         # REGISTRAZIONE NEL DATABASE
         if (count($error) == 0){
            $name=mysqli_real_escape_string($conn, $_POST['name']);
            $lastname=mysqli_real_escape_string($conn, $_POST['lastname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);//crea un nuovo hash della password utilizzando un forte algoritmo di hashing unidirezionale
            //password_bcrypt carattere standard del metodo password_hash che crea una nuovo password hash
            $query = "INSERT INTO utente (name, lastname, username, email, password, img) VALUES('$name', '$lastname', '$username', '$email','$password','$fileDestination')";

             if (mysqli_query($conn, $query)) {
                $_SESSION["username_session"] = $_POST["username"];
                $_SESSION["ID_session"] = mysqli_insert_id($conn);//Ritorna il valore generato dall'ultima query per una colonna auto_increment
                mysqli_close($conn);
                header("Location: home.php");
                exit;
                } else {
                  $error[] = "Errore di connessione al Database";
                 }
             }
                  mysqli_close($conn);
             }
         else if(isset($_POST["username"])){
              $error = array("Riempi tutti i campi");
             }
    
?>

<html>
    <head>
        <link rel='stylesheet' href='signup.css'>
        <script src='signup.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="beauty.jpeg">
        <meta charset="utf-8">

        <title>Sign up Guru's Beauty</title>
       
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    </head>
    <body>
        <div id="logo">
            Guru's Beauty
        </div>
        <section class="main">
            <h1>Registrati gratuitamente così da non perdere i tuoi prodotti!</h1>
            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
            <div class="names">

                    <div class="name">
                        <label for='name'>Name</label>

                        <!-- Se il submit non va a buon fine, il server reindirizza su questa stessa pagina, quindi va ricaricata con 
                            i valori precedentemente inseriti -->
                        <input type='text'  placeholder='name' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?> >
                        <div><img src="close.jpeg"/><span></span></div>
                    </div>


                    <div class="lastname">
                        <label for='lastname'>Lastname</label>
                        <input type='text'  placeholder='lastname' name='lastname' <?php if(isset($_POST["lastname"])){echo "value=".$_POST["lastname"];} ?> >
                        <div><img src="close.jpeg"/><span></span></div>
                    </div>
                </div>
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' placeholder='username'  name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <div><img src="close.jpeg"/><span></span></div>
                </div>
                <div class="email">

                    <label for='email'>Email</label>
                    <input type='text'  placeholder='email' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <div><img src="close.jpeg"/><span></span></div>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password'  placeholder='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    <div><img src="close.jpeg"/><span></span></div>
                </div>
                <div class="conferma_password">
                    <label for='conferma_password'>Conferma Password</label>
                    <input type='password'  placeholder='conferma password' name='conferma_password' <?php if(isset($_POST["conferma_password"])){echo "value=".$_POST["conferma_password"];} ?>>
                    <div><img src="close.jpeg"/><span></span></div>
                </div>
                <div class="fileupload">

                    <label for='profile'>Seleziona un file come immagine del profilo</label>
                        <input type='file' name='profile' accept='.jpg, .jpeg, image/gif, image/png' id="upload_original">
                        <div id="upload"><div class="file_name"></div><div class="file_size"></div></div>
                    <span></span>
                </div>
                <div class="allow"> 
                    <input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                    <label for='allow'>Accetto i termini e condizioni d'uso di Guru's Beauty.</label>
                </div>
                
                <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errore'><img src='close.jpeg'/><span>".$err."</span></div>";
                    }
                }
                 ?>

                <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
                </div>
            </form>

            <div class="signup">Hai già un account? <a href="login.php">Accedi</a></div>
        </section>
    </body>
</html>
    
    
    
    
    
    
    
    
    