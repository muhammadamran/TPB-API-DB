<?php
header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

header("Content-Disposition: attachment; filename=Laporan CK5 Sarinah-Halaman-1A_$datenow.xls");
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="CK-5-DAW%2010%20Pallet%20TBB_files/filelist.xml">
<style id="CK-5-DAW 10 Pallet TBB_12150_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl6812150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6912150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7012150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7112150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt dashed windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7212150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt dashed windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7312150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7412150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7512150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7612150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7712150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7812150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt dashed windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7912150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt dashed windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8012150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt dashed windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8112150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt dashed windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8212150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8312150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8412150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8512150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8612150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:underline;
	text-underline-style:single;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8712150
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"AvantGarde Bk BT", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
-->
</style>
</head>

<body>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->

<div id="CK-5-DAW 10 Pallet TBB_12150" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=695 class=xl6912150
 style='border-collapse:collapse;table-layout:fixed;width:521pt'>
 <col class=xl6912150 width=64 span=8 style='width:48pt'>
 <col class=xl6912150 width=15 style='mso-width-source:userset;mso-width-alt:
 548;width:11pt'>
 <col class=xl6912150 width=168 style='mso-width-source:userset;mso-width-alt:
 6144;width:126pt'>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7312150 colspan=10 width=695 style='height:14.25pt;
  border-right:.5pt solid black;width:521pt'><a name="RANGE!A1:J78">I. CATATAN
  HASIL PEMERIKSAAN / PENYEGELAN BKC YANG AKAN DIKELUARKAN :</a></td>
 </tr>
 <tr height=6 style='mso-height-source:userset;height:4.5pt'>
  <td height=6 class=xl7612150 style='height:4.5pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt;border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl8112150 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt;border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl8112150 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt;border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl8112150 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Tempat,
  Tanggal Pemeriksaan</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Pengusaha/Pejabat
  Bea dan Cukai</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150><span style='mso-spacerun:yes'></span></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>Nama</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=4 style='height:14.25pt'>Penyegelan
  dilakukan terhadap :</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>N.I.P</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8412150 colspan=3 style='height:14.25pt'>Jenis dan
  Nomor Segel :</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl8512150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8612150 colspan=6 style='height:14.25pt'>J. CATATAN
  HASIL PEMERIKSAAN / PENGELUARAN :</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=3 style='height:14.25pt'>(Disegel /
  Tidak disegel *)</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=3 style='height:14.25pt'>(Sesuai /
  Tidak Sesuai *)</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl7212150>&nbsp;</td>
  <td class=xl8112150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Tempat,
  Tanggal Pemeriksaan</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Pengusaha/Pejabat
  Bea dan Cukai</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl8212150></td>
  <td class=xl8212150></td>
  <td class=xl8312150>&nbsp;</td>
 </tr>
 <tr height=6 style='mso-height-source:userset;height:4.5pt'>
  <td height=6 class=xl7612150 style='height:4.5pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=3 style='height:14.25pt'>Jenis Alat
  Angkut<span style='mso-spacerun:yes'></span>:</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>Nama</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=3 style='height:14.25pt'>Nomor
  Polisi<span style='mso-spacerun:yes'></span>:</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>N.I.P</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8412150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl8512150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8612150 colspan=10 style='height:14.25pt;border-right:
  .5pt solid black'>K. CATATAN HASIL PEMERIKSAAN PEMASUKAN BKC DI TEMPAT
  TUJUAN/TEMPAT PENIMBUNAN TERAKHIR :</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=5 style='height:14.25pt'>Sesuai / Tidak
  Sesuai karena*) ......</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt;border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl8112150 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt;border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl8112150 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8012150 style='height:14.25pt;border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl7212150 style='border-top:none'>&nbsp;</td>
  <td class=xl8112150 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7812150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7112150>&nbsp;</td>
  <td class=xl7912150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Tempat,
  Tanggal Pemeriksaan</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Pengusaha/Pejabat
  Bea dan Cukai</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>Nama</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>N.I.P</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8412150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl8512150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8612150 colspan=10 style='height:14.25pt;border-right:
  .5pt solid black'>N. CATATAN BENDAHARAWAN KPPBC YANG MENGAWASI TEMPAT TUJUAN
  / PELABUHAN MUAT :</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=5 style='height:14.25pt'>Sesuai / Tidak
  Sesuai karena*) ......</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=4 style='height:14.25pt'>Nomor Buku
  Pengawasan<span style='mso-spacerun:yes'></span>:</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Tempat,
  Tanggal Pemeriksaan</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 colspan=3 style='height:14.25pt'>Nomor Surat
  Pengantar<span style='mso-spacerun:yes'></span>:</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'>Pengusaha/Pejabat
  Bea dan Cukai</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150 colspan=2>Tanggal :</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl8212150></td>
  <td class=xl8212150></td>
  <td class=xl8312150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td colspan=3 class=xl8212150 style='border-right:.5pt solid black'></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl7612150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150>Nama</td>
  <td class=xl6912150>:</td>
  <td class=xl7712150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl8712150 style='height:14.25pt'>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>&nbsp;</td>
  <td class=xl7012150>N.I.P</td>
  <td class=xl7012150>:</td>
  <td class=xl8512150>&nbsp;</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl6812150 colspan=3 style='height:14.25pt'>*)<span
  style='mso-spacerun:yes'></span>Coret yang tidak perlu</td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl6912150 style='height:14.25pt'></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
  <td class=xl6912150></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=15 style='width:11pt'></td>
  <td width=168 style='width:126pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
