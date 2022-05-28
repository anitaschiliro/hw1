<?php

if(isset($_GET["art"]))
{
    session_start();
      $conn = mysqli_connect("localhost", "root", "", "particolari");
      $art = $_GET["art"];
      $user=mysqli_real_escape_string($conn,$_SESSION['username']);
      mysqli_query($conn, "DELETE FROM carrello WHERE codice = $art and username ='".$user."'");
      mysqli_close($conn);
}

?>
