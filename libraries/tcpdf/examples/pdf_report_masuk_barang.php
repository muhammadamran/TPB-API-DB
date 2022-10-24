<?php
include "../../../include/connection.php";

if (isset($_POST["find_"])) {
    $StartTanggal = $_POST['StartTanggal'];
    $EndTanggal   = $_POST['EndTanggal'];
}

$dataForPrivileges = $dbcon->query("SELECT INSERT_DATA,UPDATE_DATA,DELETE_DATA,KIRIM_DATA,UPDATE_PASSWORD FROM view_privileges WHERE USER_NAME='amran.siregar'");
$resultForPrivileges = mysqli_fetch_array($dataForPrivileges);

//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage('L', 'A4');


$pdf->SetFont('helvetica', '', 8);


$data = '<tbody>';
$dataTable = $dbcon->query("SELECT hdr.NOMOR_BC11,hdr.TANGGAL_BC11,hdr.PEMASOK,
                                   brg.KODE_BARANG,brg.URAIAN,brg.KODE_SATUAN,brg.JUMLAH_SATUAN,hdr.KODE_VALUTA,brg.CIF
                            FROM plb_header AS hdr
                            LEFT OUTER JOIN plb_barang AS brg ON hdr.NOMOR_AJU=brg.NOMOR_AJU
                            WHERE hdr.TANGGAL_BC11 BETWEEN '$StartTanggal' AND '$EndTanggal'
                            ORDER BY hdr.TANGGAL_BC11 ASC LIMIT 10");
if (mysqli_num_rows($dataTable) > 0) {
    $no = 0;
    while ($row = mysqli_fetch_array($dataTable)) {
        $no++;

    $data .= '
    <tr nobr="true">
        <td style="width:25px">&nbsp;' . $no . '</td>
        <td style="text-align: center;">BC2.7 PLB</td>
        <td style="text-align: center;">' . $row['NOMOR_BC11'] . '</td>
        <td style="text-align: center;">' . $row['TANGGAL_BC11'] . '</td>
        <td style="text-align: center;">' . $row['PEMASOK'] . '</td>
        <td style="text-align: center;">' . $row['KODE_BARANG'] . '</td>
        <td style="width:200px; font-size: 10px">&nbsp;' . $row['URAIAN'] . '</td>
        <td style="text-align: center;">
                <font>' . $row['KODE_SATUAN'] . '</font>
                <font>' . $row['JUMLAH_SATUAN'] . '</font>
        </td>
        <td style="text-align: center;">
                <font>' . $row['KODE_VALUTA'] . '</font>
                <font>' . $row['CIF'] . '</font>
        </td>
    </tr>';

}
} else {
}

$data .= '</tbody>';

// Table with rowspans and THEAD
$tbl = <<<EOD
<style>
    table{
        font-family: serif;
        font-size: 11pt;
    }
    table tr {

    }
    table tr td {
        padding:3px;
        border:#000000 solid 1px;
    }
    em {
        font-size: 4pt;
    }
    tr { white-space:nowrap; }
</style>

<div id="content" class="nav-top-content">
    <div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;margin-top: -100px">
        <img src="https://itinventory-sarinah.com/assets/images/logo/logo_1659678401.logo_1658131072.Sarinah.svg.png" width="150px">
    </div>
    <div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;display: grid;">
        <font style="font-size: 20px;text-transform: uppercase;font-weight: 900;">LAPORAN PEMASUKAN BARANG PER DOKUMEN PABEAN</font>
        <br>
        <font>DI GUDANG BERIKAT PT BHANDA GHARA REKSA, JALAN BOULEVARD, KOMPLEK PERGUDANGAN PT BGR BLOK J1, KELAPA GADING, JAKARTA UTARA</font>
        <br>
        <font>PT. Sarinah </font>
        <br>
        <font>Tanggal: $StartTanggal S.D $EndTanggal</font>
    </div>
</div>

<table id="example1" border="1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;width: 25px">No.</th>
            <th colspan="3" style="text-align: center;">Dokumen Pabean</th>
            <th rowspan="2" style="text-align: center;">Supplier</th>
            <th rowspan="2" style="text-align: center;">Kode Barang<br>(No. HS)</th>
            <th rowspan="2" style="text-align: center;width: 200px">Barang</th>
            <th rowspan="2" style="text-align: center;">Jumlah</th>
            <th rowspan="2" style="text-align: center;">Nilai Barang</th>
        </tr>
        <tr>
            <th style="text-align: center;">Jenis</th>
            <th style="text-align: center;">No.</th>
            <th style="text-align: center;">Tanggal</th>
        </tr>
    </thead>
    $data
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
