<?php 
include ("security.php");
error_reporting(0);

//$idlevel = $_SESSION['id_User'];

    /*  
  
    Este es un programa desarrollado bajo el concepto de Software Libre y Uds.,
	pueden modificarlo y redistribuirlo bajo los terminos de la GNU General 
	Public License como ha sido publicado por Free Software Foundation;
	ya sea bajo la Licencia version 2 o cualquier Licencia posterior.

    	
	Autores: Ignacio Albacete
			 Pedro Obreg�n Mej�as
			 Rub�n D. Mancera Mor�n
	
	Fecha Liberaci�n del c�digo: 15/10/2007
	Codeka 2007 -- Murcia	
	
	Este codigo ha sido modificado parcialmente por
	
	Fecha Liberaci�n del c�digo: 28/08/2010
	Grupo  CodeKa Mx --- Mexico , Chile
	                     Manuel Avalos
	                     Arturo Fertilio
						 Helio Trincado 
     * 
     * 
     * 
     * 
     * SE MODIFICO EL SOFTWARE INICIAL PARA ADAPTARLO A LAS NECESIDADES DEL ALMACEN DE LA EMPRESA
     * UNION TEMPORAL DE DESARROLLO VIAL DEL VALLE DEL CAUCA Y CAUCA
     * 
     * AUTOR: JONATHAN ARTEAGA	 
     * TECNOLOGO DE SISTEMAS
	
	*/
header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

include("conectar.php");
include_once("./popupmsg/popup.class.php");


// Normal Usage  , with time out.

$HeadlineStyleArr["text-align"] = "left";
$HeadlineStyleArr["color"] = "purple"; 
$HeadlineStyleArr["background-color"] = "silver";
$HeadlineStyleArr["font-style"] = "italic";
$HeadlineStyleArr["font-family"] = "arial, sans-serif";
$MessageStyleArr["border"] = "black 8px solid";
$MessageStyleArr["filter"] =  "alpha(opacity=80)"; // IE
$MessageStyleArr["moz-opacity"] = 0.8;  //FF
$MessageStyleArr["opacity"] = 0.8;    // FF

$TextStyleArr["text-align"] = "center";
$TextStyleArr["color"] = "silver"; 
$TextStyleArr["background-color"] = "purple";
$TextStyleArr["font-weight"] = "bold";
$TextStyleArr["font-family"] = "arial, sans-serif";

//$msg2 = new popupMsg (150,80,800,200,"CodeKa Mx version 16 Mod_03"," Por razones que escaparon  a nuestro control y por no estar terminado las revisiones de este programa de acuerdo a nuestro protocolo de Control de Calidad , nos vemos en la necesidad de POSTERGAR el despacho de este programa hasta el dia 8 de Marzo 2011. El GRUPO CodeKa Mx agradece a TODOS los que han manifestado interes en este desarrollo y lamenta este contratiempo...","OK",16000);
//$msg2->populateHTML();
//$msg2->PrintMsg();
?>

<html>
<head>
<meta content="text/html; charset=UTF-8" http-equiv=Content-Type>
  <title>Sistema Almacen</title>
  
  <link rel="icon" type="image/png" href="/images/favicon.png"/>

	
  <tr>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

  <script language="JavaScript" src="menu/JSCookMenu.js"></script>

  <link rel="stylesheet" href="menu/theme.css" type="text/css">

  <script language="JavaScript" src="menu/theme.js"></script>

  <script language="JavaScript">
<!--
var variablejs = "<?php echo $_SESSION['level']; ?>";

if (variablejs == 1 || variablejs == 2){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php']
	],
//	[null,'Inter. Comerciales',null,null,'Ventas clientes',
//		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
//		[null,'Clientes','./clientes/index.php','principal','Clientes']
//	],
        [null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
                [null,'Departamentos','./provincias/index.php','principal','Provincias'],
                [null,'Entidades Bancarias','./entidades/index.php','principal','Entidades']
	],
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
		[null,'Familias','./familias/index.php','principal','Familias'],
                [null,'Unidades de Medida','./embalajes/index.php','principal','Unidad'],
                [null,'Ubicaciones','./ubicaciones/index.php','principal','Ubicacion']
	],
	[null,'Ordenes',null,null,'Ordenes de salida',
		[null,'Ordenes de salida','./albaranes_clientes/index.php','principal','Guia despacho'],
		[null,'Ordenes de salida electricos','./albaranes_electricos/index.php','principal','Guia despacho'],
		[null,'Ordenes de salida sistemas','./albaranes_sistemas/index.php','principal','Guia despacho']

	],
        
        [null,'Parque Automotor',null,null,'Vehiculos y Equipos',
		[null,'Vehiculos - Equipos','./vehiculos/index.php','principal','Vehiculos'],
		[null,'Rutina de Mantenimiento','./albaranes_mecanica/index.php','principal','Vehiculos'],
	],
        
	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
		[null,'Entrada por reparación','./entrada_reparacion/index.php','principal','Guia despacho'],
	],	
		
		
//        [null,'Ordenes',null,null,'Ventas clientes',
//		[null,'Ventas Mostrador','./ventas_mostrador/index.php','principal','Ventas Mostrador'],
//		[null,'Facturas de Ventas','./facturas_clientes/index.php','principal','Facturas'],
//		[null,'Ordenes de salida','./albaranes_clientes/index.php','principal','Guia despacho'],
//		[null,'Facturar Guia despacho ventas','./lote_albaranes_clientes/index.php','principal','Facturar Guia despacho']
//	],
//		[null,'Ordenes',null,null,'Ordenes de salida',
//		[null,'Ordenes de salida general','./albaranes_clientes/index.php','principal','Guia despacho'],
//		[null,'Ordenes de salida electricos','./albaranes_electricos/index.php','principal','Guia despacho'],
//	],

        
//        	[null,'Entradas',null,null,'Compras proveedores',
//		[null,'Facturas de Compras','./facturas_proveedores/index.php','principal','Proveedores'],
//		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
//		[null,'Facturar Guia despacho a proveedores','./lote_albaranes_proveedores/index.php','principal','Facturar Guia despacho']
//	],

        [null,'Devoluciones Almacen',null,null,'Devoluciones',
		[null,'Devoluci&oacute;n de mercancia','./devoluciones/index.php','principal','Guia despacho'],
	],
	[null,'Reportes',null,null,'Tesoreria',
	 
		_cmSplit,
		[null,'Reportes',null,null,'Reportes',
			[null,'Costo Articulos en Stock','./fpdf/imprimir_articulos_costo.php','principal','Costo Articulos en Stock'],
	    	[null,'Productos Stock negativo','./fpdf/imprimir_stocks_negativo.php','principal','Productos Stocks negativos'],
		    [null,'Precios Netos Tienda','./fpdf/imprimir_articulos_venta.php','principal','Precios Netos Tienda'],
                    [null,'Stock Minimo','./fpdf/imprimir_stocks_minimo.php','principal','Stock Minimo'],
	]	
	],
//        	[null,'Tesoreria',null,null,'Tesoreria',
//	    [null,'Cobros','./cobros/index.php','principal','Cobros'],
//		[null,'Pagos','./pagos/index.php','principal','Pagos'],
//		[null,'Caja Diaria','./cerrarcaja/index.php','principal','Caja Diaria'],
//		[null,'Libro Diario','./librodiario/index.php','principal','Libro Diario'],
//		_cmSplit,
//		[null,'Reportes',null,null,'Reportes',
//			[null,'Costo Articulos en Stock','./fpdf/imprimir_articulos_costo.php','principal','Costo Articulos en Stock'],
//	    	[null,'Productos Stock negativo','./fpdf/imprimir_stocks_negativo.php','principal','Productos Stocks negativos'],
//		    [null,'Precios Netos Tienda','./fpdf/imprimir_articulos_venta.php','principal','Precios Netos Tienda']
//	]	
//	],
//	[null,'Mantenimientos',null,null,'Mantenimientos',
//		[null,'Etiquetas','./etiquetas/index.php','principal','Etiquetas'],
//		[null,'Optimizar el sistema','./optimizar/index.php','principal','Optimizar el sistema'],
//		[null,'Parametros del Sistema','./parametros/parametros.php','principal','Par�metros del Sistema'],
//		_cmSplit,
//		[null,'Tablas',null,null,'Tablas',
//			[null,'Impuestos','./impuestos/index.php','principal','Impuestos'],
//	    	[null,'Entidades bancarias','./entidades/index.php','principal','Entidades bancarias'],
//		    [null,'Ubicaciones','./ubicaciones/index.php','principal','Ubicaciones'],
//		    [null,'Embalajes','./embalajes/index.php','principal','Embalajes'],
//			[null,'Provincias','./provincias/index.php','principal','Provincias'],
//			[null,'Vendedores','./vendedores/index.php','principal','Vendedores'],
//			[null,'Cobradores','./cobradores/index.php','principal','Cobradores'],
//		    [null,'Formas de pago','./formaspago/index.php','principal','Formas de pago']
//	]
//	],
//	[null,'Copias Seguridad',null,null,'Copias de Seguridad',
//		[null,'Hacer copia','./backup/hacerbak.php','principal','Hacer copia'],
//		[null,'Restaurar copia','./backup/restaurarbak.php','principal','Restaurar copia']
//	],
//	[null,'Ayuda',null,null,'Ayuda',
//		[null,'Manual Conexion Hosting remoto','./servidor_remoto/manual_rem.php','principal','Manual Hosting Remoto'],
//		[null,'Manual Conexion Hosting Local ','./servidor_local/manual_local.php','principal','Manual Hosting Local'],
//		_cmSplit,
//		[null,'Foro sobre CodeKa Mx','http://forocodekamx.codekamx.com','principal','Foro sobre CodeKa Mx'],
//		[null,'Acerca de ....','./creditos.php','principal','Acerca de ....']
//	]
];
}
if (variablejs == 4){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php']
	],
	
	[null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
                [null,'Departamentos','./provincias/index.php','principal','Provincias'],
                [null,'Entidades Bancarias','./entidades/index.php','principal','Entidades'],
],
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
	],
	
		[null,'Ordenes',null,null,'Ordenes de salida',
		[null,'Ordenes de salida','./albaranes_clientes/index.php','principal','Guia despacho'],

	],
	    [null,'Parque Automotor',null,null,'Vehiculos y Equipos',
		[null,'Vehiculos - Equipos','./vehiculos/index.php','principal','Vehiculos'],
		[null,'Rutina de Mantenimiento','./albaranes_mecanica/index.php','principal','Vehiculos'],
	],
	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
	],
	 [null,'Devoluciones Almacen',null,null,'Devoluciones',
		[null,'Devoluci&oacute;n de mercancia','./devoluciones/index.php','principal','Guia despacho'],
],	
];
}

if (variablejs == 3){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php']
	],
	
	[null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
                [null,'Departamentos','./provincias/index.php','principal','Provincias'],
                [null,'Entidades Bancarias','./entidades/index.php','principal','Entidades'],
	],
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
	],
	    [null,'Ordenes',null,null,'Ordenes de salida',
		
		[null,'Ordenes de salida electricos','./albaranes_electricos/index.php','principal','Guia despacho'],
		[null,'Ordenes de salida Sistemas','./albaranes_sistemas/index.php','principal','Guia despacho'],
	],
	
	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
		
		[null,'Entrada por reparación','./entrada_reparacion/index.php','principal','Guia despacho'],
	],
	
	 [null,'Devoluciones Almacen',null,null,'Devoluciones',
		[null,'Devoluci&oacute;n de mercancia','./devoluciones/index.php','principal','Guia despacho'],
	],
];
}


if (variablejs == 6){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php']
	],
	
	[null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
                [null,'Departamentos','./provincias/index.php','principal','Provincias'],
                [null,'Entidades Bancarias','./entidades/index.php','principal','Entidades'],
				
				],
	
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
	],
	    [null,'Ordenes',null,null,'Ordenes de salida',
		[null,'Ordenes de salida','./albaranes_clientes/index.php','principal','Guia despacho'],
		
	],
	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
	],
	
	 [null,'Devoluciones Almacen',null,null,'Devoluciones',
		[null,'Devoluci&oacute;n de mercancia','./devoluciones/index.php','principal','Guia despacho'],
	],
];
}


if (variablejs == 7){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php','Salir']
	],
	
	[null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
                [null,'Departamentos','./provincias/index.php','principal','Provincias'],
                [null,'Entidades Bancarias','./entidades/index.php','principal','Entidades'],
				
],
	
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
	],
	   
	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
	],
	[null,'Devoluciones Almacen',null,null,'Devoluciones',
		[null,'Devoluci&oacute;n de mercancia','./devoluciones/index.php','principal','Guia despacho'],
],
	
];
}

if (variablejs == 8){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php','Salir']
	],
	
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
	],
	   
  [null,'Ordenes',null,null,'Ordenes de salida',
		[null,'Ordenes de salida','./albaranes_clientes/index.php','principal','Guia despacho'],
		
	],
	
	
];

}

if (variablejs == 9){
var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php']
	],
	
	[null,'Inter. Comerciales',null,null,'Ventas clientes',
		[null,'Proveedores','./proveedores/index.php','principal','Proveedores'],
                [null,'Departamentos','./provincias/index.php','principal','Provincias'],
                [null,'Entidades Bancarias','./entidades/index.php','principal','Entidades'],
],
	[null,'Productos',null,null,'Productos',
		[null,'Articulos','./articulos/index.php','principal','Articulos'],
	],
	    [null,'Parque Automotor',null,null,'Vehiculos y Equipos',
		[null,'Vehiculos - Equipos','./vehiculos/index.php','principal','Vehiculos'],
		[null,'Rutina de Mantenimiento','./albaranes_mecanica/index.php','principal','Vehiculos'],
	],
	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Recepcion de mercancia','./albaranes_proveedores/index.php','principal','Guia despacho'],
],
	 [null,'Devoluciones Almacen',null,null,'Devoluciones',
		[null,'Devoluci&oacute;n de mercancia','./devoluciones/index.php','principal','Guia despacho'],
],	
];

}

if(variablejs == 10)
{
	var MenuPrincipal = [
	[null,'Inicio',null,null,'Inicio',
		[null,'Reloj','./reloj/ureloj.php','principal','Reloj'],
		[null,'Calculadora','./calculadora/ucalculadora.php','principal','Calculadora'],
		_cmSplit,
		[null,'Salir','salir.php']
	],

	[null,'Entradas Almacen',null,null,'Entradas',
		[null,'Entrada por reparación','./entrada_reparacion/index.php','principal','Guia despacho'],
	],
];
}

--></script>

  <style type="text/css">

  body { background-color: rgb(255, 255,255);

    background-image: url(images/superior.png);

    background-repeat: no-repeat;

	margin: 0px;

    }
  #MenuAplicacion { margin-left: 10px;

    margin-top: 0px;

    }

  </style>

</head>

<body>

<div id="MenuAplicacion" align="center">

</div>



<script language="JavaScript">


	cmDraw ('MenuAplicacion', MenuPrincipal, 'hbr', cmThemeGray, 'ThemeGray');



</script>
    
    <tr>
        <td height="25"></td>
        <td colspan="3" valign="top">Usuario: &nbsp; <?php  echo utf8_encode ($_SESSION[('MM_Username')]); ?></td>
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td></td>
      </tr>
      

<iframe src="centralsalir.php" name="principal" title="principal" width="100%" height="1050px" frameborder=0 scrolling="no" style="margin-left: 0px; margin-right: 0px; margin-top: 2px; margin-bottom: 0px;"> </iframe>

</body>

</html>

