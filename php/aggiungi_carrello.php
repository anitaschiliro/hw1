<?php
 if(isset($_GET['articolo'])&&isset($_GET['misura'])){

    session_start();
    $conn= mysqli_connect("localhost","root","","particolari");

    $codice_articolo=mysqli_real_escape_string($conn,$_GET['articolo']);
    $username= mysqli_real_escape_string($conn,$_SESSION['username']);
    $misura=mysqli_real_escape_string($conn,$_GET['misura']);
    $query="SELECT * from articoli join disponibilità where articoli.codice='".$codice_articolo."' and 
    articoli.codice=disponibilità.codice and disponibilità.misura='".$misura."'";
    $res=mysqli_query($conn,$query);
    $entry=mysqli_fetch_assoc($res);
    
    $descrizione= mysqli_real_escape_string($conn,$entry['descrizione']);
    $marca= mysqli_real_escape_string($conn,$entry['marca']);
    $prezzo= mysqli_real_escape_string($conn,$entry['prezzo']);
    $image= mysqli_real_escape_string($conn,$entry['image']);
    $misura= mysqli_real_escape_string($conn,$entry['misura']);
    $quantita= mysqli_real_escape_string($conn,$entry['quantita']);

    $querypresente="SELECT * from carrello where codice='".$codice_articolo."'and misura='".$misura."'";

    $res_1=mysqli_query($conn,$querypresente);

    if(mysqli_num_rows($res_1)>0){
        $querycarrello="UPDATE carrello SET quantita=quantita+1 where codice=$codice_articolo";

    }else{
        $querycarrello="INSERT INTO carrello VALUES ('".$username."','".$codice_articolo."',
        '".$descrizione."','".$marca."','".$prezzo."','".$image."',
        '".$misura."','".$quantita."')";
    }
    
    $res_2=mysqli_query($conn,$querycarrello) or die(mysqli_error($conn));
    if($res_2==true)
        echo json_encode($entry);

    mysqli_free_result($res);
    mysqli_free_result($res_1);
    mysqli_close($conn);
}      
?>