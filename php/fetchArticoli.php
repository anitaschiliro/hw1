<?php
    session_start();
    if(isset($_GET['id'])){

        $conn= mysqli_connect("localhost","root","","particolari");
        $id=mysqli_real_escape_string($conn,$_GET['id']);
        $query_1="SELECT * from acquisti join articoli where acquisti.articolo=articoli.codice and
        ordine='".$id."'";
        $res_1=mysqli_query($conn,$query_1);

        $artArray=Array();
        while($row1= mysqli_fetch_assoc($res_1)){
            $artArray[]=array(
                'ordine'=>$row1['ordine'],
                'articolo'=>$row1['articolo'],
                'descrizione'=>$row1['descrizione'],
                'immagine'=>$row1['image'],
                'misura'=>$row1['misura'],
                'quantita'=>$row1['quantita'],
                'prezzo'=>$row1['costo'],
                'user'=>$_SESSION['username']
              );
        }
        echo json_encode($artArray);
        mysqli_free_result($res_1);
        mysqli_close($conn);
    }
?>