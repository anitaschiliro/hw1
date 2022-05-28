<?php
    if(isset($_GET['art'])){

        $conn= mysqli_connect("localhost","root","","particolari");
        $art=mysqli_real_escape_string($conn,$_GET['art']);
        $query=" SELECT * from recensione where articolo='".$art."'";

        $res=mysqli_query($conn,$query);

        $recArray= array();

        while($row=mysqli_fetch_assoc($res)){
            $recArray[]=array(
                'codice'=>$row['ordine'],
                'articolo'=>$row['articolo'],
                'username'=>$row['username'],
                'recensione'=>$row['recensione']
            );
        }
        echo json_encode($recArray);
        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>