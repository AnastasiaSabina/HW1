<?php
    /*******************************************************
        Inserisce nel database il post da pubblicare 
    ********************************************************/
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    saveshop();

    function saveshop() {

        global $userid;
        $conn = mysqli_connect("localhost", "root") or die("impossibile connettersi al server");
    
        mysqli_select_db ($conn, "HW1") or die("impossibile connettersi al database");
    
        # Costruisco la query
        $userid = mysqli_real_escape_string($conn, $userid);
        $name= mysqli_real_escape_string($conn, $_POST['name']);
        $info = mysqli_real_escape_string($conn, $_POST['info']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $prezzo = mysqli_real_escape_string($conn, $_POST['prezzo']);
        

        $query = "SELECT * FROM shop WHERE user = '$userid' AND ID = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
       
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            exit;
        }

        # Eseguo
        $query = "INSERT INTO shop(user_id,name, info,image,prezzo) VALUES('$userid','$name','$info','$image','$prezzo')";
        error_log($query);
        # Se corretta, ritorna un JSON con {ok: true}
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }