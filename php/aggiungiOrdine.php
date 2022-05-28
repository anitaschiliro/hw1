<?php
    if(isset($_POST['via'])&& isset($_POST['numciv'])&& isset($_POST['citta'])
    &&isset($_POST['cap'])){

        session_start();
        $conn= mysqli_connect("localhost","root","","particolari");

        $via=mysqli_real_escape_string($conn,$_POST['via']);
        $num=mysqli_real_escape_string($conn,$_POST['numciv']);
        $citta=mysqli_real_escape_string($conn,$_POST['citta']);
        $cap=mysqli_real_escape_string($conn,$_POST['cap']);
        $username= mysqli_real_escape_string($conn,$_SESSION['username']);

        $carrello=array();
        $carrello=$_SESSION['carrello'];
        $costo=0;
        for($row=0;$row<count($carrello);$row++){
            $costo+=$carrello[$row]['prezzo'];
        }
        $indirizzo= "$via $num , $citta, $cap";
        $spedizione=rand(0,100000);

        $query="insert into ordine(cliente,num_spedizione,indirizzo,costo) values ('".$username."','".$spedizione."','".$indirizzo."','".$costo."')";
        $res_2=mysqli_query($conn,$query);
        $idordine=mysqli_insert_id($conn);
        for($row=0;$row<count($carrello);$row++){
            $codice=mysqli_real_escape_string($conn,$carrello[$row]['codice']);
            $prezzo=mysqli_real_escape_string($conn,$carrello[$row]['prezzo']);
            $misura=mysqli_real_escape_string($conn,$carrello[$row]['misura']);
            $quantita=mysqli_real_escape_string($conn,$carrello[$row]['quantita']);
           
            $querycarrello="delete from carrello where username='".$username."' and codice='".$codice."'";
            $res=mysqli_query($conn,$querycarrello);
            $queryacquisti="insert into acquisti values('".$idordine."','".$codice."','".$misura."','".$quantita."','".$prezzo."')";
            $res1=mysqli_query($conn,$queryacquisti);
        }
        $res_2=mysqli_query($conn,$query);
        mysqli_close($conn);
        header("Location: http://localhost/HW1/profile_hw1.php");
        exit;
    }
?>