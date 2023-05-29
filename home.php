<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        //rimanda al login ed esce dalla home nel senso che non riesce neanche ad entrare
        exit;
    }
?>

<!DOCTYPE html>
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
        <title> Home Guru's Beauty</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="home.js" defer="true"></script>
        <link rel="stylesheet" href="home.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Telugu&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,200&display=swap" rel="stylesheet">

</head>

<body>
     <header id="h">

    <div id="overlay"></div> 
    
    <nav id="n">

     <div id="logo">
        Guru's Beauty
     </div>

     <div id="collegamenti">
      
        <a href= "shop.php" > shop🛒 </a>
        <a href= "profilo.php" > profile👤</a>
        <a href= "blog.php" > blog👩🏻‍💻 </a>


</div>
 <div id="esci">
        <a href='logout.php'> LOGOUT</a>
</div>
 
        <div id="menu">
           <div></div>
           <div></div>
           <div></div>
    </div>
</nav>

<div id="testo"> Benvenuto 
  
  <?php 
  echo $userinfo['username'];
   ?>

</div>
</body>






</header>





    
<section id="s">

    <div class="s-row">
        <div class="num">1°</div> 
        <div class="items">
         
            <h1>HUDA KATTAN</h1>
         
        

          <p>Classe 1983 e origini irachene, Huda è cresciuta negli Stati Uniti. La sua passione per la bellezza è piuttosto precoce e risale agli anni in cui la sorella minore Mona partecipava ai concorsi per i bambini. Nel 2010 apre il suo blog e si trasferisce a Dubai dando così inizio alla sua carriera. Tutto è iniziato con un accessorio fondamentale per le donne mediorientali: le ciglia finta. Huda e la sorella Mona hanno cominciato a farsele da sole perché insoddisfatte dei prodotti in commercio. Il segreto di Huda è proprio nella sperimentazione. Il marchio HUDA BEAUTY conta più di 140 prodotti. La nota in più rispetto ad altri brand è anche nel fatto che la creatrice stessa dei prodotti spiega come utilizzarli al meglio per ottenere l’effetto desiderato. Huda rappresenta il perfetto mix tra le due tendenze: è una orientale cresciuta negli Stati Uniti che propone un concetto di bellezza frutto di una sapiente unione tra le due culture.</p>
          <p>HUDA BEAUTY: un brand una garanzia! </p>
          <img src="/HW1/hudabeauty.png">

        </div>

    </div>



    <div class="s-row">
        <div class="num">2°</div>
        <div class="items">
          <h1>NATASHA DENONA</h1>
        
          <p> Sinonimo di pelle perfetta e luminosa,  Natasha Denona è una delle makeup artist più apprezzate dalla scena beauty contemporanea. È di origine croate, vissuta in Germania e poi trasferita a Tel Aviv dove ha cominciato nel 1996 la sua carriera di truccatrice. Fin da ragazzina, realizzava da sola prima dei saggi di danza il makeup per se e le sue compagne. L'idea di una beauty collection tutta sua nasce dall'aver sempre trovato i trucchi disponibili sul mercato troppo pesanti per la pelle e dagli effetti innaturali. Questo l'ha portata a mettere tutta la sua professionalità e la sua esperienza al servizio di tutte le donne, creando una gamma ampissima di trucchi dalle prestazioni professionali e molto semplici da usare.

 
            </p>

            <p> Natasha Denona è: prodotti professionali anche per donne comuni</p>

          <img src="/HW1/natashadenona.jpeg">


        </div>
    </div>

    <div class="s-row">
        <div class="num">3°</div>
        <div class="items">
          <h1>ANASTASIA SOARE</h1>

         <p>Anastasia Beverly Hills è uno dei marchi americani più famosi sul mercato. 

            Anastasia Soare è la fondatrice e CEO del celebre marchio Anastasia Beverly Hill, ABH. La storia di Anastasia Beverly Hills ha avuto inizio nel 1997 quando la sua fondatrice Anastasia Soare, di origini rumene, aprì nel cuore di Beverly Hills il suo primo salone di bellezza. Nel 2000 ha lanciato la sua linea di prodotti. Il trampolino di lancio del successo di Anastasia è stata l’idea di introdurre nel mondo del makeup un metodo che permette di creare sopracciglia perfette in armonia con l’intero volto. Questo metodo ha dato il via a una vera “brow revolution”, segnando un momento cruciale nella storia beauty mondiale.Nel corso degli anni i prodotti firmati Anastasia Beverly Hills sono andati ben oltre il segmento delle sopracciglia. Complice di questa crescita anche Claudia Soare, figlia di Anastasia, Presidente del brand.  </p>
          <p>Anastasia Beverly Hill è sicuramente: ARMONIA!</p>
          <img src="/HW1/anastasiasoare.webp">

        </div>
    </div>

    <div class="s-row">
        <div class="num">4°</div>
        <div class="items">
          <h1>KYLIE JENNER</h1>

         

          <p>Classe 1997, Kylie Kristen Jenner è praticamente da sempre sotto le luci dei riflettori. Era il 2007, infatti, quando debuttò a soli 10 anni sul piccolo schermo insieme a tutta la sua grande famiglia nel reality: "Al passo con i Kardashian". Kylie inizia la sua carriera di modella. Complice il suo successo sulle passerelle, ha anche creato insieme alle sorelle, diverse capsule collection di beauty, come gli smalti O.P.I.
            Risale invece a novembre 2016 il debutto di Kylie Jenner come imprenditrice nel mondo del make-up. La modella entra nel mercato con la sua linea di cosmetici chiamata Kylie Cosmetics e lo shop online "The Kylie Shop". Nel 2019, Jenner ha fondato il suo marchio per la cura della pelle Kylie Skin.</p>
            
            <p>La fama di Kylie Jenner è davvero planetaria!</p>
          <img src="/HW1/kyliejenner.webp">

        </div>
    </div>

    <div class="s-row">
        <div class="num">5°</div>
        <div class="items">
          <h1>CHARLOTTE TILBURY</h1>


          <p>E’ Charlotte Tilbury la più grande imprenditrice del MakeUp al mondo. Charlotte Tilbury nasce a Londra nel 1973. Durante tutta l’adolescenza respira moda e arte in casa, frequenta il collegio, al quale seguirà la ‘Glauca Rossi School of Makeup‘. La vera carriera inizia come assistente di Mary Greenwell, amica di famiglia. Tuttavia non tarda a farsi notare e il suo lavoro e le sue scelte makeup finisce spesso nei reportage, sulle copertine e nei servizi. Nel frattempo nel 2012 apre il suo canale YouTube e il blog personale, intuendo il futuro ‘roseo’ dei tutorial di trucco sui social. Una vera intuizione che le cambia la vita. E’ anche questa popolarità personale insperata in altri decenni che le permette di aprire il suo primo store a Londra. Il primo di una lunga serie tra physic e digital store. Charlotte Tilbury lancia la sua linea di trucchi personale nel 2013, Charlotte Tilbury Beauty Ltd. </p>

          <p><em>Charlotte Tilbury</em>: «assieme alla cura della pelle, è lo strumento che permette a ognuno di noi, a prescindere dal sesso, dall’età e dall’etnia, di mostrare al mondo la migliore versione di noi stessi».
             </p>
          <img src="/HW1/charlottetilbury.jpeg">

        </div>
    </div>

    <div class="s-row">
        <div class="num">6°</div>
        <div class="items">
          <h1>CLIO ZAMMATTEO</h1>

        

          <p>Clio Zammatteo, in arte ClioMakeUp, ha 33 anni ed è oggi una delle più popolari truccatrici professionali. Nata in Veneto, precisamente a Belluno, ha studiato all’istituto IED e, dopo essersi trasferita negli Stati Uniti, è diventata famosa grazie ai suoi makeup tutorial. L’idea di pubblicare i primi tutorial risale all’estate 2008. In quel periodo, Clio si era da poco trasferita a New York insieme al marito Claudio. Da sempre appassionata di trucco, Clio nel tempo libero andava alla ricerca on line di consigli per il make-up. Tutti i tutorial, però, erano in inglese. E’ da qui che nasce l’idea del marito Claudio: creare tutorial in italiano. E’ nel 2008 che Clio decide di dar vita al suo canale ClioMakeUp su Youtube. Il suo sogno è quello di condividere tutto ciò che ha acquisito come esperienza professionale nel mondo del make up.
             ClioMakeUp è il suo nome professionale e oramai anche il marchio della sua azienda. Il suo è un incredibile caso mediatico e grande business dell’economia digitale. Il merito però, come lei stessa sottolinea, lo si deve anche un po’ a New York.</p>

             <p> "CREDI IN TE STESSA" è il motto che accompagna Clio e l'azienda da sempre. </p>
          <img src="/HW1/cliomakeup.jpeg">

        </div>
    </div>

</section>




    <footer>
<address>
© Anastasia Sabina 1000016083
</address>
</footer>

</body>
</html>

