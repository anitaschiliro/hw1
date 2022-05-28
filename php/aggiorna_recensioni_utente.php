<?php
      if(isset($_GET['articolo'])&&isset($_GET['ordine'])){
            session_start();  
            $conn = mysqli_connect("localhost", "root", "", "particolari");
            $recensioni = array();
            $ordine=mysqli_real_escape_string($conn,$_GET['ordine']);
            $articolo=mysqli_real_escape_string($conn,$_GET['articolo']);
            $user=mysqli_real_escape_string($conn,$_SESSION['username']);

            $query="SELECT * FROM recensione where username='".$user."' and articolo='".$articolo."' and ordine='".$ordine."'";
            $res = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($res))
            {
                  $recensioni[] = $row;
            }
            mysqli_free_result($res);
            mysqli_close($conn);
            echo json_encode($recensioni);
      }
?>