<?php
     $conn= mysqli_connect("localhost","root","","particolari");
     $query=" SELECT * from articoli";

     $res=mysqli_query($conn,$query);

     $shopArray= array();

     while($row=mysqli_fetch_assoc($res)){
         $shopArray[]=array(
             'codice'=>$row['codice'],
             'descrizione'=>$row['descrizione'],
             'marca'=>$row['marca'],
             'prezzo'=>$row['prezzo'],
             'immagine'=>$row['image'],
             'num_recensioni'=>$row['num_recensioni']
         );
     }
     echo json_encode($shopArray);
     mysqli_free_result($res);
     mysqli_close($conn);
?>