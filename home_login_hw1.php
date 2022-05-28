<!DOCTYPE html>
<html>
  <head>
    <title> Particolari - Home </title>
    <link rel="stylesheet" href="css/base.css"/> 
    <script src="js/base.js" defer="true"></script>
    <script src="js/home_login_hw1.js" defer="true"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
      <header>
        <nav>
            <div id="logo">Particolari - Clothing shop</div>
            <div id="link">
                <a href="home_hw1.php">Home</a>
                <a id="shop" href="shop_hw1.php">Shop Online</a>
                <?php
                session_start();
                  if(!isset($_SESSION['username']))
                   echo "<a id='login' href='login_hw1.php'>Login</a>";
                  else{
                    echo "<a id='user' href='profile_hw1.php'><img src='css/immagini/user.png'> ";
                    echo $_SESSION["username"] . " </a>";
                    echo"<a id='carrello' href='carrello_hw1.php'>Carrello</a>";
                    echo "<a id='logout' href='logout_hw1.php'>Logout</a>";
                  }

                ?>
            </div>
            <div class="hidden" id="menu_ext">
                  <a href="carrello_hw1.php">Carrello</a>
                  <a id="shop" href="shop_hw1.php">Shop</a>
                  <?php
                    if(!isset($_SESSION['username']))
                      echo "<a id='login' href='login_hw1.php'>Login</a>";
                    else{
                      echo "<a id='user' href='profile_hw1.php'> ";
                      echo $_SESSION["username"] . " </a>";
                      echo "<a id='logout' href='logout_hw1.php'>Logout</a>";
                    }
                  ?>
            </div>
            <div id="menu">
                  <div></div>
                  <div></div>
                  <div></div>
            </div>
        </nav>
        <h1><strong>
        <?php
            if(isset($_SESSION['username'])){
            echo "Benvenuto ";
            echo $_SESSION["username"];
            echo " !";
            }else{
                echo "La moda a casa tua!";
            }
        ?>
        </strong></br>
          <em>Scopri l'abbigliamento adatto al tuo bambino.</em><br/>
          <a class="button" href="shop_hw1.php">Scopri di più</a>
        </h1>
      </header>


      <section>
        <div id="main">
            <h1>Tutto di cui hai bisogno lo trovi da noi.</h1>
            <p >
            10 anni di esperienza nel settore dell'abbigliamento. <br>
            Marchi 100% designed and made in Italy.
            </p>
        </div>
        <div id="dettagli">
         
        </div>
      </section>
      <footer>
        <p><strong>Particolari's Shop - Clothing and more</strong><br/>
        Anita Schilirò - 1000001476</p>
        <div id="weather"></div>
      </footer>
  </body>
</html>