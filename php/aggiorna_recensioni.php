<?php

      $conn = mysqli_connect("localhost", "root", "", "particolari");
      $recensioni = array();

      $res = mysqli_query($conn, "SELECT * FROM recensione");
      while($row = mysqli_fetch_assoc($res))
      {
            $recensioni[] = $row;
      }
      mysqli_free_result($res);
      mysqli_close($conn);
      echo json_encode($recensioni);

?>