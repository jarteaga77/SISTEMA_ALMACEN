<?php 
	require_once('conexion.php'); 
	include ('header.php')
	//error_reporting(0);
?>


<?php 
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['textfieldusuario'])) {
  $loginUsername=$_POST['textfieldusuario'];
  $password=$_POST['textfieldclave'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "Menu.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion, $conexion);
  
  $LoginRS__query=sprintf("SELECT uname, passwd FROM authuser WHERE uname='%s' AND passwd='%s'", 
						get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), 
						get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

 
  $permiso = "SELECT id,level FROM authuser WHERE uname='$loginUsername'";

  $permisoLogin = mysql_query($permiso, $conexion) or die(mysql_error());
  $permisoUser = mysql_fetch_row($permisoLogin);
  $idusu =  intval($permisoUser[0]);
  $id_level=intval($permisoUser[1]);
    
    
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
   // declare two session variables and assign them
 
    $_SESSION['id_User'] = $idusu;
	$_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	
	$_SESSION['level'] = $id_level;      
	
   if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
	$_SESSION['autenticado'] = "1";
  }
  else {
    	$login="1";
	header("Location: ". $MM_redirectLoginFailed );
  }
}
?>




<!DOCTYPE html>
<html>
    <head> 
        <link rel="SHORTCUT"  href="/img/favicon.png"/>
        <title>Sistema Almacen</title>
          

        
        <style type="text/css">
<!--
.Estilo2 {color: #000000; font-weight: bold; font-size: 24px; }
.Estilo5 {color: #000000; font-weight: bold; }
-->
        </style>
</head>
   
    <body bgcolor="#FFFFFF" background="images/fondo.jpg">
	<table width="800 px" height="600 px" border="0" cellpadding="0" cellspacing="0" align="center" ">  
    <!--DWLayoutTable-->
      <tr>
        <td width="22" height="16"></td>
        <td width="170"></td>
        <td width="359"></td>
        <td width="80"></td>
        <td width="141"></td>
        <td width="28"></td>
      </tr>
      <tr>
        <td height="89"></td>
        <td colspan="4" valign="top"><table width="50%" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="200" height="50" valign="top"><div align="center"><img src="images/Logo.png" width="670" height="96"></div></td>
          </tr>
   
        </table>        </td>
        <td></td>
      </tr>
      <tr>
        <td height="86"></td>
        <td>&nbsp;</td>
        
        
        <td>&nbsp;</td>
        <td></td>
      </tr>
      <tr>
        <td height="50"></td>
        <td>&nbsp;</td>
        <td valign="top"><table width="10%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="10" height="30">&nbsp;</td>
            <td width="50" valign="top"><div align="center">
              <p class="Estilo2"></p>
              <p><?php 
			  	if (isset($login)){
      				echo "Datos Incorrectos";
					}else {
    				echo "Introduce tu usuario y clave";
					//header("Location: ". $MM_redirectLoginFailed );
  				}
				/*if ($_GET['PrevUrl']==1){
			  		echo "Datos Incorrectos"; 
				}else{
					echo "Introduce tu usuario y clave";
			  	}*/
			  	
			  ?>&nbsp;</p>
            </div></td>
            <td width="5">&nbsp;</td>
          </tr>
          <tr>
            <td height="5">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="112">&nbsp;</td>
            <td valign="top">
            <form ACTION="<?php echo $loginFormAction; ?>" name="formulariologin" method="POST">
              <table width="249" height="77" border="1" align="center">
                <tr>
                  <td width="77"><span class="Estilo5">Usuario</span></td>
                  <td width="156"><label>
                    <input name="textfieldusuario" type="text">
                  </label></td>
                </tr>
                <tr>
                  <td><span class="Estilo5">Clave</span></td>
                  <td><label>
                    <input name="textfieldclave" type="password">
                  </label></td>
                </tr>
              </table>
                        <p>
                          <label>
                          <div align="center">
                            <div align="center">
                              <input type="submit" name="Submit" value="Enviar">
              </div>
                            
  </label>
            </form>            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="5">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
      </tr>
      <tr>
        <td height="0"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
      </tr>
      
       
      <tr>
        <td height="55"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <?php 
		/* Mostrar Hora del sistema
		<td valign="top" align="center"><strong>Hora Actual:</strong> 
		<body onload="mueveReloj()">  
		  <form name="form_reloj"> 
		<input type="text" name="reloj" size="15" style="background-color : Black; color : White; font-family : 
		Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onFocus="window.document.form_reloj.reloj.blur()"> 
		    </form></td>
		*/
		include ('footer.php')?>			
        <td></td>
      </tr>
      <tr>
        <td height="50"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
      </tr>
    </table>
</body>
</html>
