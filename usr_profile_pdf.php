<?php
include "include/connection.php";
include "include/restrict.php";
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
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
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('libraries/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Include From Data

function date_indo_pdf($date, $print_day = false)
{
    $day = array(
        1 =>
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );
    $month = array(
        1 =>
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split    = explode('-', $date);
    $tgl_indo = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

    if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

$GetData = $_GET['USER'];
$data = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$GetData'");
$result = mysqli_fetch_array($data);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Profile TPB ' . $result['nama_lengkap'] . '');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 9);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<br><br><center><b>PROFILE PENGGUNA TPB</b></center><br><br>
<table border="1" cellspacing="3" cellpadding="4">
  <tbody>
    <tr>
      <td rowspan="2" style="text-align: center;">
        <img src="assets/images/users/' . $result['foto'] . '" />
      </td>
      <td>
        <p>Username</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="300">
        <p>' . $result['username'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Hak Akses TPB</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="300">
        <p>' . $result['role'] . '</p>
      </td>
    </tr>
  </tbody>
</table>
<p><strong>INFORMASI DATA DIRI</strong></p>
<table border="1" cellspacing="3" cellpadding="4">
  <tbody>
    <tr>
      <td>
        <p>NIK</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['NIK'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>NIP</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['NIP'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Nama Lengkap</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['nama_lengkap'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Tempat Lahir</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['tempat_lahir'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Tanggal Lahir</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . date_indo_pdf($result['tgl_lahir'], TRUE) . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Usia</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['usia'] . ' Tahun</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Jenis Kelamin</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['jenis_kelamin'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Agama</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['agama'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Alamat</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['alamat'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Departemen</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['departemen'] . '</p>
      </td>
    </tr>
    <tr>
      <td>
        <p>Jabatan</p>
      </td>
      <td style="text-align: center;" width="19">
        <p>:</p>
      </td>
      <td width="404">
        <p>' . $result['jabatan'] . '</p>
      </td>
    </tr>
  </tbody>
</table>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Profile_TPB_' . $result['nama_lengkap'] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
