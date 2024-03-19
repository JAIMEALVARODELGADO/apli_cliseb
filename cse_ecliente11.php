<!-- Edicion de Datos del Cliente -->
<HTML>
<head>
<title>Edita Cliente</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.tpid_cli.value == "") { a += " Tipo de Documento de Identificación\n"; }
    if (document.form1.nrod_cli.value == "") { a += " Numero de Identificación\n"; }
    if (document.form1.nomb_cli.value == "") { a += " Nombres\n"; }
    if (document.form1.apel_cli.value == "") { a += " Apellidos\n"; }
    //if (document.form1.sexo_cli.value == "") { a += " Sexo\n"; }
    //if (document.form1.fnac_cli.value == "") { a += " Fecha de Nacimiento\n"; }
    //if (document.form1.tele_cli.value == "") { a += " Teléfono\n"; }
    if (a != "") 
    { alert(error + a);return true;}

document.form1.submit()
}
function atras()
{
  history.go(-1)
}
function recarga(){
  document.form1.action='cse_ccompra1.php';
  document.form1.submit();
}
function buscar(){
  document.form1.action='cse_ccompra12.php';
  document.form1.submit();
}
</script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$consultacli=mysql_query("select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                          from cliente where codi_cli=$codi_cli");
$rowcli=mysql_fetch_array($consultacli);
$fnac_cli=cambiafechadmy($rowcli[fnac_cli]);
?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente111.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Editar Cliente</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos Personales</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificación:</td>
    <td class='Td2' width='15%' align='left'><select name='tpid_cli'>
	<option value=''>
	<?
	  $consultatp=mysql_query("SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='01'");
	  while($rowtp=mysql_fetch_array($consultatp)){
	    echo "<option value='$rowtp[codi_tip]'>$rowtp[desc_tip]";
	  }
	?>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' value='<?echo $rowcli[nrod_cli];?>'></td>
	<td class='Td2' width='5%' align='right'>Nombres:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?echo $rowcli[nomb_cli];?>'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?echo $rowcli[apel_cli];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli'>
	  <option value=''>
	  <option value='F'>Femenino
	  <option value='M'>Masculino
	  <option value='I'>Indefinido
	</td>
	<td class='Td2' align='right'>Fecha Nacimiento: dd/mm/aaaa</td>
	<td class='Td2' align='left'><input type='text' name='fnac_cli' size='10' maxlength='10' value='<?echo $fnac_cli;?>'></td>
	<td class='Td2' align='right'>Dirección:</td>
    <td class='Td2' align='left' colspan='3'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?echo $rowcli[dire_cli];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Teléfono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?echo $rowcli[tele_cli];?>'></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?echo $rowcli[emai_cli];?>'></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Profesión:</td>
	<td class='Td2' align='left'><select name='prof_cli' <?echo $disp;?>>
	<option value=''>
	<?
	  $consultapr=mysql_query("SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='04'");
	  while($rowpr=mysql_fetch_array($consultapr)){
	    echo "<option value='$rowpr[codi_tip]'>$rowpr[desc_tip]";
	  }
	?>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td class='Td2' align='right'>Puntos Acumulados:</td>
	<td class='Td2' align='left'><font color='#ff0000'><b><?echo $rowcli[punt_cli];?></font></td>
  </tr>
</table>

<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>
<script language='javascript'>
document.form1.tpid_cli.value='<?echo $rowcli[tpid_cli];?>';
document.form1.sexo_cli.value='<?echo $rowcli[sexo_cli];?>';
document.form1.prof_cli.value='<?echo $rowcli[prof_cli];?>';
document.form1.loca_com.value='<?echo $rowcli[loca_com];?>';
document.form1.tdoc_com.value='<?echo $rowcli[tdoc_com];?>';
</script>
<br>
<table class='Tbl0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?
mysql_free_result($consultatp);
mysql_free_result($consultacli);
mysql_close();
?>
</body>
</HTML>