<!DOCTYPE html>
<html>
  <head>
    <title> Particolari - Il tuo profilo </title>
    <link rel="stylesheet" href="css/base.css"/> 
    <link rel="stylesheet" href="css/profilo_hw1.css"/> 
    <script src="js/base.js" defer="true"></script>
    <script src="js/profilo_hw11.js" defer="true"></script>
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
                <a href="home_login_hw1.php">Home</a>
                <a href="carrello_hw1.php">Carrello</a>
                <a id="shop" href="shop_hw1.php">Shop Online</a>
                <?php
                    session_start();
                    echo "<a id='user' href='profile_hw1.php'><img src='css/immagini/user.png'> ";
                    echo $_SESSION["username"] . " </a>";
                ?>
                <a id="logout" href="logout_hw1.php">Logout</a>
            </div>
            <div class="hidden" id="menu_ext">
                  <a href="home_login_hw1.php">Home</a>
                  <a id="carrello" href="carrello_hw1.php">Carrello</a>
                  <a id="shop" href="shop_hw1.php">Shop</a>
                  <?php
                    if(!isset($_SESSION['username']))
                      echo "<a id='login' href='login_hw1.php'>Login</a>";
                    else{
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
            <?php
                $conn= mysqli_connect("localhost","root","","particolari");
                $username= mysqli_real_escape_string($conn,$_SESSION['username']);
                $query=" SELECT * from cliente where username ='".$username."'";
                
                $res=mysqli_query($conn,$query);
                
                $row= mysqli_fetch_object($res);
                echo"<img src='css/immagini/user.png'>";
                echo "<h1>".$row->nome." ".$row->cognome."</h1>";
                echo "<p> $username </p>";
                mysqli_free_result($res);
                mysqli_close($conn);
            ?>
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