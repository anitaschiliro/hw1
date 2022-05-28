<?php
    if(isset($_GET['articolo'])){
        $conn= mysqli_connect("localhost","root","","particolari");
        $codice=mysqli_real_escape_string($conn,$_GET['articolo']);
        $query=" SELECT * from disponibilità where codice='".$codice."' and quantita>0";

        $res=mysqli_query($conn,$query);

        $misureArray= array();

        while($row=mysqli_fetch_assoc($res)){
            $misureArray[]=$row;
        }
        echo json_encode($misureArray);
        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>
