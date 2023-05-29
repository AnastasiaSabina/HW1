<?php 
    /*******************************************************
        Controlla che l'username sia unico
    ********************************************************/
    

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

//serve a trasformare i dati che otteniamo dalla fetch php in dati json che devono essere restituiti
    header('Content-Type: application/json');
    
    $conn = mysqli_connect("localhost", "root") or die("impossibile connettersi al server");

    mysqli_select_db ($conn, "HW1") or die("impossibile connettersi al database");

    $username = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM utente WHERE username = '".$username."'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    //json_encode codifica un valore dato ad una stringa usando la sintassi JSON 
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>