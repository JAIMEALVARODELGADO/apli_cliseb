<?php
ob_end_clean();
require('fpdf.php');
include("funciones.php");
conectarbd();
$consultaplan=mysql_query("SELECT codi_ppm,fsor_ppm,nota_ppm FROM plan_premio");
$rowplan=mysql_fetch_array($consultaplan);
$consultaval=mysql_query("SELECT valxb_ent FROM entidad");
$rowval=mysql_fetch_array($consultaval);
$valxb=$rowval[valxb_ent];
$consulta=mysql_query("SELECT co.codi_com,co.tdoc_com,co.ndoc_com,co.fech_com,co.valo_com,co.loca_com,cl.codi_cli,cl.tpid_cli,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre,cl.tele_cli,tp.desc_tip
           FROM compra as co 
		   INNER JOIN cliente as cl ON cl.codi_cli=co.codi_cli
		   INNER JOIN tipo as tp ON tp.codi_tip=cl.tpid_cli
		   WHERE co.codi_com=$codi_com");
$row=mysql_fetch_array($consulta);

if($valxb==0){
	$l=1;
}
else{
	$l=floor($row[valo_com]/$valxb);
}

$pdf=new FPDF('P','mm','p1');
for($c=1;$c<=$l;$c++){
  $pdf->AddPage();
  $pdf->SetFont('Arial','',8);
  $f=3;
  //$pdf->Image('img\logo23.png',2,2,50,40,'','');
  
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"CENTRO COMERCIAL",0,0,'C');
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"SEBASTIAN DE BELALCAZAR P.H.",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"NIT 800005421-2",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"PLAN DE PREMIOS",0,0,'C');
  
  $pdf->SetFont('Arial','',6);
  $consultapre=mysql_query("SELECT desc_pre FROM premio WHERE codi_ppm=$rowplan[codi_ppm]");
  while($rowpre=mysql_fetch_array($consultapre)){
    $f=$f+3;
    $pdf->SetXY(2,$f);
    $pdf->Cell(68,4,$rowpre[desc_pre],0,0,'L');
  }
  $f=$f+3;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Sorteo: ".cambiafechadmy($rowplan[fsor_ppm]),0,0,'L');
  $f=$f+3;
  $pdf->SetXY(2,$f);
  $pdf->Multicell(68,3,$rowplan[nota_ppm],0,'J');
  
  $pdf->SetFont('Arial','',8);
  $f=$f+14;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"$row[nombre]",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"$row[desc_tip] $row[nrod_cli]",0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Telefono: ".$row[tele_cli],0,0,'C');
  
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Datos de la Compra",0,0,'C');
  $consultalo=mysql_query("SELECT codi_tip,desc_tip,valo_tip FROM tipo WHERE codi_tip='$row[loca_com]'");
  $rowlo=mysql_fetch_array($consultalo);
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Local: $rowlo[valo_tip] $rowlo[desc_tip]",0,0,'L');
  
  $consultado=mysql_query("SELECT codi_tip,desc_tip FROM tipo WHERE codi_tip='$row[tdoc_com]'");
  $rowdo=mysql_fetch_array($consultado);
  $f=$f+4;
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"$rowdo[desc_tip] $row[ndoc_com]",0,0,'L');
  
  $f=$f+4;
  $fech_com=cambiafechadmy($row[fech_com]);
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Fecha: $fech_com",0,0,'L');
  
  $f=$f+4;
  $fech_com=cambiafechadmy($row[fech_com]);
  $pdf->SetXY(2,$f);
  $pdf->Cell(68,4,"Valor: $row[valo_com]",0,0,'L');
  
  $f=$f+7;
  $pdf->SetXY(0,$f);
  $pdf->Cell(68,2,"°<",0,0,'L');
  $f=$f+1;
  $pdf->SetXY(0,$f);
  $pdf->Cell(68,2,"°",0,0,'L');
}

mysql_query("UPDATE compra SET impr_com='S' WHERE codi_com=$codi_com");
mysql_free_result($consultaval);
mysql_free_result($consulta);
mysql_free_result($consultalo);
mysql_free_result($consultado);
mysql_close();
$pdf->Output();
?> 

