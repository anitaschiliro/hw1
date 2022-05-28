<html>
  <head>
    <title> Particolari - Shop </title>
    <link rel="stylesheet" href="css/base.css"/> 
    <link rel="stylesheet" href="css/shop_hw1.css"/> 
    <script src="js/base.js" defer="true"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <script src="js/shop_hw1.js" defer="true"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
      <header>
        <nav>
            <div id="logo">Particolari - Clothing shop</div>
            <div id="link">
                <a href="home_login_hw1.php">Home</a>
                <a id="carrello" href="carrello_hw1.php">Carrello</a>
                <?php
                session_start();
                  if(!isset($_SESSION['username']))
                   echo "<a id='login' href='login_hw1.php'>Login</a>";
                  else{
                    echo "<a id='user' href='profile_hw1.php'><img src='css/immagini/user.png'> ";
                    echo $_SESSION["username"] . " </a>";
                    echo "<a id='logout' href='logout_hw1.php'>Logout</a>";
                  }

                ?>
            </div>
            <div class="hidden" id="menu_ext">
                  <a href="home_login_hw1.php">Home</a>
                  <a id="carrello" href="carrello_hw1.php">Carrello</a>
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
        <h1><strong>Shop Online</strong><br/>
          <em>Spedizioni in tutta Italia in 48 ore!</em><br/>
        </h1>
        <form method="get" name="search">
          <label>
            <input type="text" name="ricerca" >
            <input type="submit" value="Cerca">
          </label>
        </form>
      </header>
      <section>
      </section>
      <footer>
        <p><strong>Particolari's Shop - Clothing and more</strong><br/>
        Anita Schilirò - 1000001476</p>
        <div id="weather"></div>
      </footer>
  </body>
</html>