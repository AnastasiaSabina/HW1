<?php

//iniziamo la sessione e verifichiamo l'accesso
include 'auth.php';
//verifichiamo che la sessione esiste e nel caso riportiamo alla home dopo il login 
if (checkAuth()){
    header('Location:home.php');
    exit;
}

// verifica dell'esistenza di dati POST 
if (!empty($_POST["username"]) && !empty($_POST["password"]))

{
    //se sono stati inviati connettiamo il DB
    $conn = mysqli_connect("localhost", "root") or die("impossibile connettersi al server");
    
    mysqli_select_db ($conn, "HW1") or die("impossibile connettersi al database");

    //inserendo dati provenienti dal form di una query inseriamo l'escape dei caratteri
        $username = mysqli_real_escape_string($conn, $_POST['username']);
       //ora prepariamo la query 
       $query= "SELECT * FROM utente WHERE username= '".$username."'";


       //eseguiamola 
       $res=mysqli_query($conn, $query) or die(mysqli_error($conn));
       
       //adesso leggiamo il numero di righe di un result set

       if(mysqli_num_rows($res) > 0)
{
    //ritorna una sola riga
    $row = mysqli_fetch_assoc($res);
    //verifichiamo che la password sia valida
    if(password_verify($_POST['password'], $row['password'])){

        //impostiamo una sessione per l'utente
        $_SESSION["username_session"]= $row['username'];
        $_SESSION["ID_session"]= $row['ID'];
        //allora riportami alla home
        header("Location: home.php");
        //infine liberiamo lo spazio occupato dalla query 
        mysqli_free_result($res);
        //chiudiamo la connessione
        mysqli_close($conn);
        exit;
    }

} // se l'utente non è stato trovato o la password non è stata verificata

    $error= "Username e/o password errati";

} 

//se uno solo dei due è valido 
else if (isset ($_POST["username"]) || isset($_POST["password"])) 
{
    $error="Inserisci username e password";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Guru's Beauty</title>
   
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
            <h5>Sei già registrato? Allora affrettati, effettua il login!</h5>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
            ?>
            <form name='login' method='post'>
                <!-- Seleziono il valore di ogni campo sulla base dei valori inviati al server via POST -->
                <div class="username">
                    <element for='username'>Username</element>
                    <input type='text' name='username' placeholder='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                
                </div>
                <div class="password">
                    <element for='password'>Password</element>
                    <input type='password' name='password' placeholder='password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>

                </div>
                <div class="submit-container">
                    <div class="login-btn">
                        <input type='submit' value="ACCEDI">

                    </div>
                </div>
            </form>
            <div class="signup"><h4>Non fai ancora parte della nostra community? </h4></div>
            <div class="signup-btn-container"><a class="signup-btn" href="signup.php">REGISTRATI ORA!</a></div>
        </section>
    </body>
</html>