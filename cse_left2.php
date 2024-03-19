<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CLISEB</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<table class='Tbl0' width='100%'>
  <tr>
    <td width='20%'><img src='img/logo23.png' width='140' height='90'></td>
  </tr>
</table>

<br>
<table class='Tbl0' width='100%'>
  <tr>
    <td class='Td1' width='100%'>MENU</td>
  </tr>
</table>

<table class='Tbl0' width='100%'>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$consultatp=mysql_query("SELECT tipo_ucs FROM u_cliseb WHERE codi_ucs=$Gcodi_ucs");
$rowtp=mysql_fetch_array($consultatp);
$tipo_ucs=$rowtp[tipo_ucs];
$consulta=mysql_query("SELECT codi_men,desc_men FROM menu WHERE nive_men='1'");
while($row=mysql_fetch_array($consulta)){
	echo "<tr>";
	echo "<td class='Td1' width='100%'>$row[desc_men]</td>";
	echo "</tr>";
	if($tipo_ucs=='1'){
		$consulta2=mysql_query("SELECT codi_men,desc_men,url_men FROM menu WHERE nive_men='2' AND depe_men=$row[codi_men]");
	}
	else{
		$consulta2=mysql_query("SELECT m.codi_men,m.desc_men,m.url_men FROM menu AS m
	                        INNER JOIN um_cliseb AS um ON um.codi_men=m.codi_men
							INNER JOIN u_cliseb AS u ON u.codi_ucs=um.codi_ucs
	                        WHERE m.nive_men='2' AND um.codi_ucs=$Gcodi_ucs AND m.depe_men=$row[codi_men]");
	}
	while($row2=mysql_fetch_array($consulta2)){
		echo "<tr><td class='Th1' width='100%'><a href='$row2[url_men]' target='fr03'>$row2[desc_men]</a></td></tr>";
		//echo $row2[url_men];;
	}
	mysql_free_result($consulta2);
}
mysql_free_result($consultatp);
mysql_free_result($consulta);
mysql_close()
?>
</table>
</body>
</html>
