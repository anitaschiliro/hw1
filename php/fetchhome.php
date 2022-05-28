<?php
     $conn= mysqli_connect("localhost","root","","particolari");
     $query=" SELECT * from home";

     $res=mysqli_query($conn,$query);

     $homeArray= array();

     while($row=mysqli_fetch_assoc($res)){
         $homeArray[]=array(
             'titolo'=>$row['titolo'],
             'descrizione'=>$row['descrizione'],
             'immagine'=>$row['img']
         );
     }
     echo json_encode($homeArray);
     mysqli_free_result($res);
     mysqli_close($conn);
?>