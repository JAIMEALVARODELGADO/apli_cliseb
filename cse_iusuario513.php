<!-- Inactiva/Activa Usuario del Sistema -->
<HTML>
<head>
<title>Inactiva/Activa Usuario del Sistema</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_eusuario51.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
mysql_query("UPDATE u_cliseb SET esta_ucs='$esta_ucs' WHERE codi_ucs=$codi_ucs");
mysql_close();
?>
<body onload='javascript:cargar()'>
</body>
</HTML>
