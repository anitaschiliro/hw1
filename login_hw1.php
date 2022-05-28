
<?php

session_start();

if(isset($_SESSION["username"])){
    header("Location: home_login_hw1.php");
    exit();
}
else{
    if(isset($_POST["username"])&&isset($_POST["password"])){

        $conn= mysqli_connect("localhost","root","","particolari");
        $username= mysqli_real_escape_string($conn,$_POST['username']);
        $query=" SELECT * from cliente where username ='".$username."'";

        $res=mysqli_query($conn,$query);

        if(mysqli_num_rows($res)>0){
            $entry=mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'],$entry['pwd'])){
                $_SESSION["username"]=$_POST["username"];
                header("Location: home_login_hw1.php");
                exit();
                mysqli_free_result($res);
                mysqli_close($conn);
            }
        }
    }
}
?>
<html>
  <head>
    <title> Particolari - Login </title>
    <link rel="stylesheet" href="css/login_hw1.css"/> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <script src="js/login_hw1.js" defer="true"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
       <header>
       <div id="logo">Particolari</div>
        <form name="login" method="post">
                <h1> Effettua il Login</h1>
                <p>
                    <label>Username<input type="text" name="username"></label>
                </p>
                <p>
                    <label>Password<input type="password" name="password"></label>
                </p>
                <p>
                    <label><input id="accesso" type='submit' value="Accedi"></label>
                </p>
                <p>Non hai un account? <a href="signin_hw1.php">Registrati</a></p>
         </form>
         <?php
            if(isset($errore)){
                echo "<p>";
                echo "Credenziali errate!";
                echo "</p>";
            }
        ?>
        </header>
  </body>
</html>