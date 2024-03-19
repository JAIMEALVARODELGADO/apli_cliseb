<!-- Captura de compras -->
<HTML>
<head>
<title>Captura de Compras</title>
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
    if (document.form1.sexo_cli.value == "") { a += " Sexo\n"; }
    if (document.form1.fnac_cli.value != "") {
	  //if(validafecha(document.form1.fnac_cli.value)==false){
	  //  a += " Fecha de Nacimiento Inválida\n";
	  //}
	  if(validahoy(document.form1.fnac_cli.value)==false){
	    a += " La fecha de nacimiento no puede ser mayor a la actual\n";
	  }
	  if(validafechamen(document.form1.fnac_cli.value)==true){
	    a += " La fecha de nacimiento no puede ser menor a 1900\n";
	  }
	}
    //if (document.form1.tele_cli.value == "") { a += " Teléfono\n"; }
    if (document.form1.tdoc_com.value == "") { a += " Tipo de Doc. de Compra\n"; }
    if (document.form1.ndoc_com.value == "") { a += " Numero de Compra\n"; }
    if (document.form1.fech_com.value == "") { a += " Fecha de Compra\n"; }
	if (document.form1.fech_com.value!=""){
	  if(validafecha(document.form1.fech_com.value)==false){
	    a += " Fecha de Compra Inválida\n";
	  }
	  if(validahoy(document.form1.fech_com.value)==false){
	    a += " La fecha de compra no puede ser mayor a la actual\n";
	  }
	  if(validafechamen(document.form1.fech_com.value)==true){
	    a += " La fecha de compra no puede ser menor a 1900\n";
	  }
    }
    if (document.form1.valo_com.value == "") { a += " Valor de la Compra\n"; }

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

<script language='vBscript'>
'Funcion que retorna true si la fecha es válida y false si la fecha no es válida
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

'Funcion que retorna true si la fecha es menor a la fecha actual
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validahoy(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=0
  end if
  if(diferencia>=0) then
    validahoy=true
  else
    validahoy=false
  end if
end function

'Funcion que retorna true si la fecha es mayor a 1900
'Parámetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=-1
  end if
  if(diferencia>=39911) then
    validafechamen=true
  else
    validafechamen=false
  end if
end function
</script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$disp='';
if(!empty($nrod_cli)||!empty($codi_cli)){
  if(!empty($codi_cli)){
    $consultacli=mysql_query("select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                              from cliente where codi_cli=$codi_cli");
  }
  else{
    $consultacli=mysql_query("select codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli,punt_cli
                              from cliente where tpid_cli='$tpid_cli' and nrod_cli='$nrod_cli'");
  }
  if(mysql_num_rows($consultacli)<>0){
    $rowcli=mysql_fetch_array($consultacli);
    $codi_cli=$rowcli[codi_cli];
	$tpid_cli=$rowcli[tpid_cli];
	$nrod_cli=$rowcli[nrod_cli];
	$nomb_cli=$rowcli[nomb_cli];
	$apel_cli=$rowcli[apel_cli];
	$dire_cli=$rowcli[dire_cli];
	$tele_cli=$rowcli[tele_cli];
	$fnac_cli=cambiafechadmy($rowcli[fnac_cli]);
	$sexo_cli=$rowcli[sexo_cli];
	$emai_cli=$rowcli[emai_cli];
	$prof_cli=$rowcli[prof_cli];
	$punt_cli=$rowcli[punt_cli];
	$disp='disabled';
  }
}
?>
</head>
<body>
<form name='form1' method='post' action='cse_ccompra11.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Capura de Compras</td></tr>
</table>
<br>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos del Cliente</td></tr>
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
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' onblur='recarga()' value='<?echo $nrod_cli;?>'></td>
	<td class='Td2' width='5%' align='right'>Nombres:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?echo $nomb_cli;?>' <?echo $disp;?>></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='20%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?echo $apel_cli;?>' <?echo $disp;?>>
	<a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Sexo:</td>
    <td class='Td2' align='left'><select name='sexo_cli' <?echo $disp;?>>
	  <option value=''>
	  <option value='F'>Femenino
	  <option value='M'>Masculino
	  <option value='I'>Indefinido
	  </select>
	</td>
	<td class='Td2' align='right'>Fecha Nacimiento: dd/mm/aaaa</td>
	<td class='Td2' align='left'><input type='text' name='fnac_cli' size='10' maxlength='10' value='<?echo $fnac_cli;?>' <?echo $disp;?>></td>
	<td class='Td2' align='right'>Dirección:</td>
    <td class='Td2' align='left' colspan='3'><input type='text' name='dire_cli' size='50' maxlength='50' value='<?echo $dire_cli;?>' <?echo $disp;?>></td>
  </tr>
  <tr>
    <td class='Td2' align='right'>Teléfono:</td>
	<td class='Td2' align='left'><input type='text' name='tele_cli' size='22' maxlength='22' value='<?echo $tele_cli;?>' <?echo $disp;?>></td>
	<td class='Td2' align='right'>E-mail:</td>
    <td class='Td2' align='left' colspan=4><input type='text' name='emai_cli' size='60' maxlength='60' value='<?echo $emai_cli;?>' <?echo $disp;?>></td>
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
	</select>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td class='Td2' align='right'>Puntos Acumulados:</td>
	<td class='Td2' align='left'><font color='#ff0000'><b><?echo $punt_cli;?></font></td>
  </tr>
</table>

<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos de la Compra</td></tr>
</table>
<?
$hoy=hoy();
?>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Local:</td>
    <td class='Td2' width='15%' align='left'><select name='loca_com'>
	<option value=''>
	<?
	  $consultalo=mysql_query("SELECT codi_tip,desc_tip,valo_tip FROM tipo WHERE codi_gru='03' ORDER BY desc_tip");
	  while($rowlo=mysql_fetch_array($consultalo)){
	    echo "<option value='$rowlo[codi_tip]'>$rowlo[valo_tip] ".substr($rowlo[desc_tip],0,15);
	  }
	?>
	</select>
  </tr>
  <tr>
    <td class='Td2' width='10%' align='right'>Documento:</td>
    <td class='Td2' width='15%' align='left'><select name='tdoc_com'>
	<option value=''>
	<?
	  $consultado=mysql_query("SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='02'");
	  while($rowdo=mysql_fetch_array($consultado)){
	    echo "<option value='$rowdo[codi_tip]'>$rowdo[desc_tip]";
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='ndoc_com' size='6' maxlength='6' value='<?echo $ndoc_com;?>'></td>
	<td class='Td2' width='10%' align='right'>Fecha:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='fech_com' size='10' maxlength='10' value='<?echo $hoy;?>'></td>
	<td class='Td2' width='10%' align='right'>Valor:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='valo_com' size='7' maxlength='7' value='<?echo $valo_com;?>'></td>
  </tr>
</table>
<input type='hidden' name='codigo' value='<?echo $codi_cli?>'>
<script language='javascript'>
document.form1.tpid_cli.value='<?echo $tpid_cli;?>';
document.form1.sexo_cli.value='<?echo $sexo_cli;?>';
document.form1.prof_cli.value='<?echo $prof_cli;?>';
document.form1.loca_com.value='<?echo $loca_com;?>';
document.form1.tdoc_com.value='<?echo $tdoc_com;?>';
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
mysql_free_result($consultalo);
mysql_free_result($consultado);
mysql_free_result($consultapr);
mysql_close();
?>
</body>
</HTML>