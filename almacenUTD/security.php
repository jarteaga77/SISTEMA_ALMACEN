<?
session_start();
if($_SESSION['autenticado']!="1"){

    header("Location:http://192.168.1.128/almacenUTD/index.php");
	exit();
	
	  $inactivo = 900;
 
    if(isset($_SESSION['tiempo']) ) {
    $vida_session = time() - $_SESSION['tiempo'];
        if($vida_session > $inactivo)
        {
            session_destroy();
            header("Location:http://192.168.1.128/almacenUTD/index.php"); 
        }
    }
 
    $_SESSION['tiempo'] = time();
	
      
        }    
?>