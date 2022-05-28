<?php
    session_start();
     $conn= mysqli_connect("localhost","root","","particolari");
     $username=mysqli_real_escape_string($conn,$_SESSION['username']);
     $query=" SELECT * from carrello where username='".$username."'";

     $res=mysqli_query($conn,$query);

     $carrArray= array();


     while($row=mysqli_fetch_assoc($res)){
         $carrArray[]=array(
             'username'=>$row['username'],
             'codice'=>$row['codice'],
             'descrizione'=>$row['descrizione'],
             'marca'=>$row['marca'],
             'prezzo'=>$row['prezzo'],
             'immagine'=>$row['image'],
             'misura'=>$row['misura'],
             'quantita'=>$row['quantita']
         );
         
     }
     
    $_SESSION['carrello'] = $carrArray;
     echo json_encode($carrArray);
     mysqli_free_result($res);
     mysqli_close($conn);
?>