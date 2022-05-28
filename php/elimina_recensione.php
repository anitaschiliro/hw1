<?php

if(isset($_GET["articolo"])&&isset($_GET["ordine"]))
{     session_start();
      $conn = mysqli_connect("localhost", "root", "", "particolari");

      $articolo = mysqli_real_escape_string($conn, $_GET["articolo"]);
      $codice = mysqli_real_escape_string($conn, $_GET["ordine"]);
      $user=mysqli_real_escape_string($conn,$_SESSION['username']);

      $query="DELETE FROM recensione WHERE articolo = $articolo and ordine=$codice and username='".$user."'";
      $res=mysqli_query($conn, $query);
      
      mysqli_close($conn);
}

?>


