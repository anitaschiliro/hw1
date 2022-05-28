<?php
    if(isset($_POST['ricerca'])){
        $conn= mysqli_connect("localhost","root","","particolari");
        $ricerca=mysqli_real_escape_string($conn,$_POST['ricerca']);
        $query=" SELECT * from articoli where descrizione like '%$ricerca%' or codice like '%$ricerca%' ";
   
        $res=mysqli_query($conn,$query);
   
        $searchArray= array();
   
        while($row=mysqli_fetch_assoc($res)){
            $searchArray[]=array(
                'codice'=>$row['codice'],
                'descrizione'=>$row['descrizione'],
                'marca'=>$row['marca'],
                'prezzo'=>$row['prezzo'],
                'immagine'=>$row['image']
            );
        }
        //echo $searchArray;
        echo json_encode($searchArray);
        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>