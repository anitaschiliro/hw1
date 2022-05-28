<?php

      if(isset($_GET["articolo"])&&isset($_GET['ordine'])&&isset($_GET['recensione']))
      if(!empty($_GET['recensione']))
      {
          session_start();

            $conn = mysqli_connect("localhost", "root", "", "particolari");

            $ordine= mysqli_real_escape_string($conn,$_GET['ordine']);
            $articolo = mysqli_real_escape_string($conn, $_GET["articolo"]);
            $recensione = mysqli_real_escape_string($conn, $_GET["recensione"]);
            $user=mysqli_real_escape_string($conn,$_SESSION['username']);

            $verifica="SELECT * FROM recensione where ordine=$ordine and articolo=$articolo and username='".$user."'";
            $res=mysqli_query($conn,$verifica);
            if(mysqli_num_rows($res)>0){
                  $result=false;
            }else{
                  $query="INSERT INTO recensione VALUES (".$ordine.",".$articolo.",'".$user."','".$recensione."')"; 
                  mysqli_query($conn,$query);
                  $result=true;
            }

            mysqli_close($conn);
            $array=array('success'=>$result,'ordine'=>$ordine,'articolo'=>$articolo);
            echo json_encode($array);
      }

?>