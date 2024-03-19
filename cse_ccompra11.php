<!-- Guarda las Compras -->
<HTML>
<head>
<title>Guarda Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<Script Language="JavaScript">
function cargar() {
  //window.open('cse_ccompra1','fr03','');
}
function regresar(){
  history.go(-1);
}
</Script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
if(!empty($fnac_cli)){
  $fnac_cli=cambiafecha($fnac_cli);
}
else{
  $fnac_cli='0000-00-00';
}
$fech_com=cambiafecha($fech_com);
$hoy=cambiafecha(hoy());
$puntos=floor($valo_com/1000);
if(empty($codigo)){
  //$cons="INSERT INTO cliente (codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli)
  //             VALUES (0,'$tpid_cli','$nrod_cli','$nomb_cli','$apel_cli','$dire_cli','$tele_cli','$fnac_cli','$sexo_cli','$emai_cli','$prof_cli')";
//echo $cons;
  mysql_query("INSERT INTO cliente (codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli)
               VALUES (0,'$tpid_cli','$nrod_cli','$nomb_cli','$apel_cli','$dire_cli','$tele_cli','$fnac_cli','$sexo_cli','$emai_cli','$prof_cli')");
  $codi_cli=mysql_insert_id();
}
else{
  $codi_cli=$codigo;
}
//$consultacom="SELECT codi_com FROM compra WHERE tdoc_com='$tdoc_com' and ndoc_com='$ndoc_com' and loca_com='$loca_com'";
//echo $consultacom;
$consultacom=mysql_query("SELECT codi_com FROM compra WHERE tdoc_com='$tdoc_com' and ndoc_com='$ndoc_com' and loca_com='$loca_com' and anul_com<>'S'");
$encon=mysql_num_rows($consultacom);
if(mysql_num_rows($consultacom)==0){
	//echo "INSERT INTO compra (codi_com,codi_cli,tdoc_com,ndoc_com,fech_com,valo_com,loca_com,esta_com,impr_com,anul_com)
    //           VALUES (0,$codi_cli,'$tdoc_com','$ndoc_com','$fech_com','$valo_com','$loca_com','A','N')";
  mysql_query("INSERT INTO compra (codi_com,codi_cli,tdoc_com,ndoc_com,fech_com,valo_com,loca_com,esta_com,impr_com,anul_com)
               VALUES (0,$codi_cli,'$tdoc_com','$ndoc_com','$fech_com','$valo_com','$loca_com','A','N','N')");
  $codi_com=mysql_insert_id();
  //$consultapun="SELECT punt_cli FROM cliente WHERE codi_cli=$codi_cli";
  //echo $consultapun;
  $consultapun=mysql_query("SELECT punt_cli FROM cliente WHERE codi_cli=$codi_cli");
  $rowpun=mysql_fetch_array($consultapun);	 
  mysql_query("UPDATE cliente SET punt_cli=$rowpun[punt_cli]+$puntos,fuco_cli='$hoy' WHERE codi_cli=$codi_cli");
}
mysql_close();
?>
</head>
<?
if($encon==0){
  //echo "<body onload='javascript:cargar()'>";
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Compra Guardada</td></tr>";
  echo "</table>";
  echo "<br><br><br><br><br><br><br><br><br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='cse_prnboleta.php?codi_com=$codi_com' target='blank' onclick='cargar()'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Imprimir Boletas'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='cse_prnboleta.php?codi_com=$codi_com' target='blank' onclick='cargar()'>Imprimir Boletas</a></td>";
  echo "</tr>";
  echo "</table>";
}
else{
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Reporte de errores!</td></tr>";
  echo "</table>";
  echo "<br><br><br><br>";
  echo "<center>La compra ya fue registrada anteriormente</center>";
  echo "<br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='regresar()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='regresar()'>Regresar</a></td>";
  echo "</tr>";
  echo "</table>";
}
?>
</body>
</HTML>
