<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect("localhost", "root") or die("impossibile connettersi al server");
    
    mysqli_select_db ($conn, "HW1") or die("impossibile connettersi al database");

        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM utente WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   

    ?>

    <head>
        <link rel='stylesheet' href='profilo.css'>

        <script src='profilo.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>Guru's Beauty <?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>

    <body>

    <div id="overlay">
    </div>
        <header>
            <nav>
                <div class="nav-container">
                    
                    <div id="links">
                    <a href= "home.php" > home🏡 </a>
                        <a href= "shop.php" > shop🛒 </a>
                        <a href= "blog.php" > blog👩🏻‍💻 </a>
                        

                        <div id="separator"></div>
                        <a href='logout.php' class='button'>logout</a>
                    </div>
                    <div id="menu">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="userinfo">
                    <div class="avatar" style="background-image: url(<?php echo $userinfo['img'] == null ? "uploadphotos.png" : $userinfo['img'] ?>)">
                    </div>
                    <h1><?php echo $userinfo['name']." ".$userinfo['surname'] ?></h1>
                </div>               
            </nav>
        </header>

        <section class="container">

            <div id="results">
                
            </div>
    </section>

    </body>
</html>

<?php mysqli_close($conn); ?>