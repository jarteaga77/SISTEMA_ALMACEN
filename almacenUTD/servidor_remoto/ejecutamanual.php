<?php
session_start(); 

header('Cache-Control: no-cache');
header('Pragma: no-cache'); 

include ("conectar.php");

			 // * Redirecciona a pagina de manual

			// */
		header("location: manual.inst_servidor_remoto.php");
        exit ;        
?> 