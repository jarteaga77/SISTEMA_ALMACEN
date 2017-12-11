<?php 

require_once('conexion.php');
include "header.php";
error_reporting(0);

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



<form ACTION="<?php echo $loginFormAction; ?>" name="formulariologin" method="POST">


<table width="300" border="0" cellpadding="5" cellspacing="">

<tr>
            <td width="50" height="50" valign="top"><div align="center"><img src="images/LogoInicio.png" width="50" height="50"></div></td>
         
          
          <td style="background: #ffffff; padding: 5px" valign="middle"><h1 style="margin-top: 0; margin-bottom: 0">Sistema Almacen </h1></td>
 </tr>
   <tr>
	<td><strong>Usuario:</strong></td>
	<td><input type="text" name="textfieldusuario" class="textfield"></td>
   </tr>
   <tr>
	<td><strong>Clave:</strong></td>
	<td><input type="password" name="textfieldclave" class="textfield"></td>
   </tr>
   <tr>
	<td>&nbsp;</td>
  	<td><input type="submit" name="login" class="submit" value="Ingresar"></td>
   </tr>
</table>

</form>




<?php include "footer.php" ?>