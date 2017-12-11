<?php
function conectar()
{
	mysql_connect("localhost", "root", "@admin1.@");
	mysql_select_db("almacen");
}

function desconectar()
{
	mysql_close();
}
?>
