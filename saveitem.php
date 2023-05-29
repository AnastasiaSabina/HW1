<?php 
    /*******************************************************
        Preleva gli ultimi 10 post o tutti, se ce ne sono 
        meno di 10
    ********************************************************/
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

savedi();
    function savedi(){

        global $userid;
    $conn = mysqli_connect("localhost", "root") or die("impossibile connettersi al server");
    
    mysqli_select_db ($conn, "HW1") or die("impossibile connettersi al database");

    $userid = mysqli_real_escape_string($conn, $userid);

    $query= "SELECT * FROM shop WHERE user_id='$userid'";
    $resquery=mysqli_query($conn,$query) or die(mysqli_error($conn));

    $item= array();
    while ($row = mysqli_fetch_assoc($resquery))
    { $item[]=$row;}

    mysqli_close($conn);

    echo json_encode($item);
    
    exit;
    
    }

?>