<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth());
    
    
?>


<!DOCTYPE html>

<html lang="it">
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Guru's Beauty</title>
    <link rel="stylesheet" href="shop.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Telugu&display=swap" rel="stylesheet">

<script src="shop.js" defer="true"></script>

</head>

<body>
   <header id="h">

    <div id="overlay"></div> 
    
    <nav id="n">

     <div id="logo">
        Guru's Beauty
     </div>

     <div id="collegamenti">
        <a href= "home.php" > home🏡 </a>
        <a href= "profilo.php" > profile👤</a>
        <a href= "blog.php" > blog👩🏻‍💻 </a>
</div>

<div id="esci">
        <a href='logout.php'> LOGOUT</a>
</div>

        <div type="button" id="menu">
           <div></div>
           <div></div>
           <div></div>
    </div>

   
    
    </nav>


    <em id="titolo">Divertiti svuotando la tua CreditCard!😜</em><br/>
    </header>

    <section id="generale">

  <div>Ricerca il tuo brand preferito:</div>


    <section id="search">
      <form id="form" autocomplete="off">
        <div class="search">
          <label for='search'>Cerca</label>
          <input type='text' name="search" class="searchBar">
          <input type="submit" value="Cerca">
        </div>
      </form>
   
    
        <div id="results">

   </div>
 </section>
</section>
    <footer>
<address>
© Anastasia Sabina 1000016083
</address>
</footer>

</body>
</html>
