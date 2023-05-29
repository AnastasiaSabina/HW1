<?php
    /********************************************************
       Controlla che l'utente sia già autenticato, per non 
       dover chiedere il login ad ogni volta               
    *********************************************************/
    
    session_start();

    function checkAuth() {
        
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['ID_session'])) {
            return $_SESSION['ID_session'];
        } else 
            return 0;
    }
    
?>