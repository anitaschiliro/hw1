<?php
         session_start();
          $conn= mysqli_connect("localhost","root","","particolari");
          $username= mysqli_real_escape_string($conn,$_SESSION['username']);
          $query=" SELECT * from ordine where cliente ='".$username."' ORDER BY codice DESC LIMIT 10";
  
          $res=mysqli_query($conn,$query);
  
          $ordiniArray= array();

          while($row=mysqli_fetch_assoc($res)){
              $ordiniArray[]=array(
                'id'=>$row['codice'],
                'spedizione'=>$row['num_spedizione'],
                'indirizzo'=>$row['indirizzo'],
                'costo'=>$row['costo']
              );
            }
          echo json_encode($ordiniArray);
          mysqli_free_result($res);
          mysqli_close($conn);
        ?>