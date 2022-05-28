<?php
    if(isset($_POST['via'])&& isset($_POST['numciv'])&& isset($_POST['citta'])
    &&isset($_POST['cap'])){

        session_start();
        $conn= mysqli_connect("localhost","root","","particolari");

        $via=mysqli_real_escape_string($conn,$_POST['via']);
        $num=mysqli_real_escape_string($conn,$_POST['numciv']);
        $citta=mysqli_real_escape_string($conn,$_POST['citta']);
        $cap=mysqli_real_escape_string($conn,$_POST['cap']);
        $username= mysqli_real_escape_string($conn,$_SESSION['username']);

        $carrello=array();
        $carrello=$_SESSION['carrello'];
        $costo=0;
        for($row=0;$row<count($carrello);$row++){
            $costo+=$carrello[$row]['prezzo'];
        }
        $indirizzo= "$via $num , $citta, $cap";
        $spedizione=rand(0,100000);

        $query="insert into ordine(cliente,num_spedizione,indirizzo,costo) values ('".$username."','".$spedizione."','".$indirizzo."','".$costo."')";
        $res_2=mysqli_query($conn,$query);
        $idordine=mysqli_insert_id($conn);
        
        for($row=0;$row<count($carrello);$row++){
            $codice=mysqli_real_escape_string($conn,$carrello[$row]['codice']);
            $prezzo=mysqli_real_escape_string($conn,$carrello[$row]['prezzo']);
            $misura=mysqli_real_escape_string($conn,$carrello[$row]['misura']);
            $quantita=mysqli_real_escape_string($conn,$carrello[$row]['quantita']);
           
            $querycarrello="delete from carrello where username='".$username."' and codice='".$codice."'";
            $res=mysqli_query($conn,$querycarrello);
            $queryacquisti="insert into acquisti values('".$idordine."','".$codice."','".$misura."','".$quantita."','".$prezzo."')";
            $res1=mysqli_query($conn,$queryacquisti);
        }
        mysqli_close($conn);
        header("Location: profile_hw1.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Particolari - Ordina ora</title>
    <link rel="stylesheet" href="css/base.css"/> 
    <link rel="stylesheet" href="css/ordine_hw1.css"/> 
    <script src="js/base.js" defer="true"></script>
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
          <h1>Compila i campi per procedere all'ordine</h1>
          <form name="ordine" method="post">

            <p>Inserisci indirizzo di spedizione</p>
            <p>
              <label>Via <input type="text" name="via"></label>
            </p>
            <p>
              <label>Numero<input type=text name="numciv"></label>
            </p>
            <p>
              <label>Città<input type="text" name="citta"></label>
            </p>
            <p>
              <label> CAP<input type="text" name="cap"></label>
            </p>
            <p>
              <input type="submit" name="ordina" value="Ordina ora">
            </p>
            </form>
      </section>
      <footer>
        <p><strong>Particolari's Shop - Clothing and more</strong><br/>
        Anita Schilirò - 1000001476</p>
        <div id="weather"></div>
      </footer>
  </body>
</html>