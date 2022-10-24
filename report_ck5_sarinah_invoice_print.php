<!-- QUERY -->
<?php
include "include/connection.php";
// include "include/restrict.php";

$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

$dataSetRealTime = $dbcon->query("SELECT * FROM tbl_realtime ORDER BY id DESC LIMIT 1");
$resultSetRealTime = mysqli_fetch_array($dataSetRealTime);

$SetTime = $resultSetRealTime['reload'];

$CheckForPrivileges = $_SESSION['username'];
$dataForPrivileges = $dbcon->query("SELECT INSERT_DATA,UPDATE_DATA,DELETE_DATA,KIRIM_DATA,UPDATE_PASSWORD FROM view_privileges WHERE USER_NAME='$CheckForPrivileges'");
$resultForPrivileges = mysqli_fetch_array($dataForPrivileges);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
		<title>TPBERP | PT. Sarinah </title>
	<?php } else { ?>
		<title><?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> - <?= $resultHeadSetting['title'] ?></title>
	<?php } ?>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
	<meta name=ProgId content=Excel.Sheet>
	<meta name=Generator content="Microsoft Excel 15">
	<link rel=File-List href="CK-5-DAW%2010%20Pallet%20TBB1_files/filelist.xml">
	<?php if ($resultHeadSetting['icon'] == NULL) { ?>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon/icon-default.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon/icon-default.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/icon-default.png">
	<?php } else { ?>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
	<?php } ?>
	<link href="assets/css/tpb.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link href="assets/css/default/invoice-print.min.css" rel="stylesheet" />
	<link href="assets/css/ck5plb.css" rel="stylesheet" />
</head>
<style type="text/css">
	.nav-top-content {
		padding: 20px;
		margin-top: 30px;
	}

	@media (max-width: 767.5px) {
		.nav-top-content {
			padding: 20px;
			margin-top: 0px;
		}
	}
</style>
<body onload="window.print();">
	<!-- begin #page-container -->
	<div id="content" class="nav-top-content">
		<div class="invoice">
			<div class="invoice-company">
				<?= $resultHeadSetting['company'] ?>
			</div>
			<!-- <div class="invoice-header">
				<div class="invoice-from">
					<small>from</small>
					<address class="m-t-5 m-b-5">
						<strong class="text-inverse">Twitter, Inc.</strong><br />
						Street Address<br />
						City, Zip Code<br />
						Phone: (123) 456-7890<br />
						Fax: (123) 456-7890
					</address>
				</div>
				<div class="invoice-to">
					<small>to</small>
					<address class="m-t-5 m-b-5">
						<strong class="text-inverse">Company Name</strong><br />
						Street Address<br />
						City, Zip Code<br />
						Phone: (123) 456-7890<br />
						Fax: (123) 456-7890
					</address>
				</div>
				<div class="invoice-date">
					<small>Invoice / July period</small>
					<div class="date text-inverse m-t-5">August 3,2012</div>
					<div class="invoice-detail">
						#0000123DSS<br />
						Services Product
					</div>
				</div>
			</div> -->

      <?php 

      $getdet = mysqli_query($dbcon,"SELECT * FROM tpb_header WHERE NOMOR_AJU = '$_GET[AJU]' ");
      $inv = mysqli_fetch_array($getdet);

      /* kontainer info */
      $getdet2 = mysqli_query($dbcon,"SELECT * FROM tpb_kontainer WHERE ID_HEADER = '$inv[ID]' ");
      $kon = mysqli_fetch_array($getdet2);

      /* dokumen info */
      $getdet3 = mysqli_query($dbcon,"SELECT * FROM tpb_dokumen WHERE ID_HEADER = '$inv[ID]' ");
      $dok = mysqli_fetch_array($getdet3);

      ?>


      <div class="invoice-content">
        <!-- <div style="display: flex;justify-content: center;"> -->
         <!-- <div style="margin-left: 80px;"> -->
          <table cellspacing="0" border="0">
            <colgroup width="31"></colgroup>
            <colgroup width="29"></colgroup>
            <colgroup width="10"></colgroup>
            <colgroup width="91"></colgroup>
            <colgroup width="10"></colgroup>
            <colgroup width="131"></colgroup>
            <colgroup width="73"></colgroup>
            <colgroup width="29"></colgroup>
            <colgroup width="18"></colgroup>
            <colgroup width="62"></colgroup>
            <colgroup width="88"></colgroup>
            <colgroup width="123"></colgroup>
            <colgroup width="10"></colgroup>
            <colgroup width="47"></colgroup>
            <colgroup width="51"></colgroup>
            <colgroup width="138"></colgroup>
            <colgroup width="24"></colgroup>
            <colgroup width="128"></colgroup>
            <tr>
              <td colspan=6 rowspan=2 height="150" align="left" valign=middle><br><img src="assets/images/icon/icon_1658131045.Sarinah.svg.png" width=300 height=70 hspace=49 vspace=22>
              </td>
              <td colspan=6 style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5>PT. SARINAH</font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><b><font face="Aharoni" size=5><br></font></b></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><br></td>
              <td style="border-bottom: 2px solid #000000" align="left" valign=middle><br></td>
              <td style="border-bottom: 2px solid #000000" align="right" valign=bottom><font face="Arial Black" size=6 color="#404040"><br></font></td>
            </tr>
            <tr>
              <td colspan=6 style="border-top: 2px solid #000000" align="left" valign=middle><b><font size=4>Jl. MH Thamrin No 11 Jakarta 10350</font></b></td>
              <td style="border-top: 2px solid #000000" align="left" valign=middle><b><font size=4><br></font></b></td>
              <td style="border-top: 2px solid #000000" align="left" valign=middle><b><font size=4><br></font></b></td>
              <td style="border-top: 2px solid #000000" align="left" valign=middle><b><font size=4><br></font></b></td>
              <td style="border-top: 2px solid #000000" align="left" valign=middle><b><font size=4><br></font></b></td>
              <td align="left" valign=middle><b><font size=4><br></font></b></td>
              <td align="left" valign=middle><b><font size=4><br></font></b></td>
              <td align="center" valign=middle><b><font size=4><br></font></b></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="right" valign=bottom><font face="Arial Black" size=6 color="#404040"><br></font></td>
            </tr>
            <tr>
              <td align="left" valign=middle><b><font size=5><br></font></b></td>
              <td align="left" valign=middle><b><font size=5><br></font></b></td>
              <td align="left" valign=middle><b><font size=5><br></font></b></td>
              <td align="left" valign=middle><b><font size=5><br></font></b></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="right" valign=bottom><font face="Arial Black" size=6 color="#404040"><br></font></td>
            </tr>
            <tr>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=bottom><font face="Arial Black" size=6 color="#404040">INVOICE</font></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
              <td align="left" valign=middle><br></td>
            </tr>
            <tr>
              <td style="border-bottom: 1px solid #969696" colspan=11 height="26" align="center" valign=middle bgcolor="#ECECEC"><b><font color="#404040"><br></font></b></td>
              <td style="border-bottom: 1px solid #969696" colspan=7 align="center" valign=middle><b><font color="#404040"><br></font></b></td>
            </tr>
            <tr>
              <td style="border-top: 1px solid #969696" colspan=11 height="10" align="left" valign=bottom><b><font color="#0070C0"><br></font></b></td>
              <td style="border-top: 1px solid #969696" colspan=7 align="left" valign=bottom><b><font color="#0070C0"><br></font></b></td>
            </tr>
            <tr>
              <td colspan=4 height="27" align="left" valign=bottom bgcolor="#FFFFFF">Duty Free Name</td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><b>:</b></td>
              <td colspan="2" align="left" valign=middle bgcolor="#FFFFFF"><?php echo $inv['NAMA_PENERIMA_BARANG'];?></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><b><br></b></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              
              <td align="left" valign=bottom bgcolor="#FFFFFF">Number</td>
              <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
              <td colspan="2" align="left" valign=middle bgcolor="#FFFFFF"><?php echo $inv['NOMOR_IJIN_TPB_PENERIMA'];?></td>
              
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="center" valign=middle bgcolor="#FFFFFF" sdval="3" sdnum="1033;"></td>
              <td align="left" valign=middle bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"></td>
            </tr>
            <tr>
              <td colspan=4 height="27" align="left" valign=bottom bgcolor="#FFFFFF">NPWP</td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><b>:</b></td>
              <td align="left" valign=middle bgcolor="#FFFFFF"><?php echo $inv['ID_PENERIMA_BARANG'];?></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF">Ex Bill Of Lading</td>
              <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
              <td align="left" valign=middle><?php echo $kon['NOMOR_KONTAINER'];?></td>
              <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
              <td align="center" valign=middle bgcolor="#FFFFFF" sdval="25" sdnum="1033;"></td>
              <td align="left" valign=middle bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"></td>
            </tr>
            <tr>
              <td colspan=4 height="27" align="left" valign=bottom bgcolor="#FFFFFF">Street Address</td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><b>:</b></td>
              <td colspan="2" align="left" valign=middle bgcolor="#FFFFFF"><?php echo $inv['ALAMAT_PENERIMA_BARANG'];?></td>
              
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF">No. Dokumen</td>
              <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
              <td colspan=3 align="left" valign=middle bgcolor="#FFFFFF"><?php echo $dok['NOMOR_DOKUMEN'];?></td>
              <td align="center" valign=middle bgcolor="#FFFFFF" sdval="22" sdnum="1033;"></td>
              <td align="left" valign=middle bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"></td>
            </tr>
            <tr>
              <td height="25" align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><b></b></td>
              <td align="left" valign=middle bgcolor="#FFFFFF"></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF">Original</td>
              <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><?php echo $inv['KODE_NEGARA_PEMASOK'];?></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"><br></td>
            </tr>
            <tr>
              <td height="27" align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=middle bgcolor="#FFFFFF"></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF">BC 2.7 Number</td>
              <td align="right" valign=bottom bgcolor="#FFFFFF"><b>:</b></td>
              <td colspan=2 align="left" valign=bottom bgcolor="#FFFFFF"><?php echo $inv['NOMOR_AJU']; ?></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><?php echo "(" . $inv['TANGGAL_AJU'] . ")" ;?></td>
            </tr>
            <tr>
              <td height="17" align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF"><br></td>
              <td align="left" valign=bottom bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"><br></td>
            </tr>
          </table>
          <table id="example" class="table table-striped table-bordered first" style="width:100%">
            <thead>
              <tr>
                <th>RcdID</th>
                <th>Description</th>
                <th>SKU</th>
                <th>Details</th>
                <th>Quantity</th>
                <th>Pric (USD)</th>                                     
                <th>Bottle</th>
                <th>Litre(s)</th>
              </tr>
            </thead>
            <tbody>
                        <?php
                        include 'include/connection.php';
                        $result = mysqli_query($dbcon,"SELECT * FROM tpb_barang WHERE ID_HEADER = '$inv[ID]' ORDER BY ID ASC");
                        if(mysqli_num_rows($result)>0){
                          while($row = mysqli_fetch_array($result))
                          {
                            echo "<tr>";
                            echo "<td>" . $row['ID'] . "</td>";
                            echo "<td>" . $row['URAIAN'] . "</td>";
                            echo "<td>" . $row['KODE_BARANG'] . "</td>";
                            echo "<td>" . $row['UKURAN'] . "</td>";
                            echo "<td>" . $row['JUMLAH_SATUAN'] . "</td>";
                            echo "<td>" . $row['CIF'] . "</td>";

                            $bottleqty = $row['UKURAN'] * $row['JUMLAH_SATUAN'];
                            echo "<td>" . $bottleqty . "</td>";                                        
                            
                            /* GET LITRE DATA FROM tb_barang_tarif - start */
                            $getlitre = mysqli_query($dbcon,"SELECT JUMLAH_SATUAN FROM tpb_barang_tarif WHERE ID_BARANG = '$row[ID]' AND JENIS_TARIF = 'CUKAI' ");
                            $lit = mysqli_fetch_array($getlitre);

                            echo "<td>" . $lit['JUMLAH_SATUAN'] . "</td>"; 

                            /* GET LITRE DATA FROM tb_barang_tarif - end */

                            echo "</tr>"; 
                            }

                            /* calculate total QTY */
                            $result2 = mysqli_query($dbcon,"SELECT sum(JUMLAH_SATUAN) as TotalQty FROM tpb_barang WHERE ID_HEADER = '$inv[ID]' ORDER BY ID ASC");
                            $rowx = mysqli_fetch_array($result2);

                            /* calculate total BOTTLE */
                            $result3 = mysqli_query($dbcon,"SELECT sum(UKURAN*JUMLAH_SATUAN) as TotalBottle FROM tpb_barang WHERE ID_HEADER = '$inv[ID]' ORDER BY ID ASC");
                            $row3 = mysqli_fetch_array($result3);

                            /* calculate total PRICE */
                            $result4 = mysqli_query($dbcon,"SELECT sum(CIF) as TotalCif FROM tpb_barang WHERE ID_HEADER = '$inv[ID]' ORDER BY ID ASC");
                            $row4 = mysqli_fetch_array($result4);

                            /* calculate total PRICE */
                            $result5 = mysqli_query($dbcon,"SELECT sum(JUMLAH_SATUAN) as TotalLitre FROM tpb_barang_tarif WHERE ID_HEADER = '$inv[ID]' AND JENIS_TARIF = 'CUKAI'");
                            $row5 = mysqli_fetch_array($result5);


                            echo "<tr>";
                            echo "<td>" . "-" . "</td>";
                            echo "<td>" . "-" . "</td>";
                            echo "<td>" . "-" . "</td>";
                            echo "<td>" . "TOTAL" . "</td>";
                            echo "<td>" . "<b>" . $rowx['TotalQty'] . "</b>". "</td>";
                            echo "<td>" . "<b>" . $row4['TotalCif'] . "</b>". "</td>";
                            echo "<td>" . "<b>" . $row3['TotalBottle'] . "</b>". "</td>";
                            echo "<td>" . "<b>" . $row5['TotalLitre'] . "</b>". "</td>";
                            echo "</tr>"; 
                        } 
                        mysqli_close($con);
                        ?>
                </tbody>
          </table>
          <!-- </div> -->
          <!-- </div> -->
				<!-- <div class="invoice-price">
					<div class="invoice-price-left">
						<div class="invoice-price-row">
							<div class="sub-price">
								<small>SUBTOTAL</small>
								<span class="text-inverse">$4,500.00</span>
							</div>
							<div class="sub-price">
								<i class="fa fa-plus text-muted"></i>
							</div>
							<div class="sub-price">
								<small>PAYPAL FEE (5.4%)</small>
								<span class="text-inverse">$108.00</span>
							</div>
						</div>
					</div>
					<div class="invoice-price-right">
						<small>TOTAL</small> <span class="f-w-600">$4508.00</span>
					</div>
				</div> -->
			</div>
			<!-- <div class="invoice-note">
				* Make all cheques payable to [Your Company Name]<br />
				* Payment is due within 30 days<br />
				* If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
			</div> -->
			<div class="invoice-footer">
				<p class="text-center m-b-5 f-w-600">
					Export CK5 Sarinah | IT Inventory <?= $resultHeadSetting['company'] ?>
				</p>
				<p class="text-center">
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> <?= $resultHeadSetting['website'] ?></span>
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:<?= $resultHeadSetting['telp'] ?></span>
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> <?= $resultHeadSetting['email'] ?></span>
				</p>
			</div>
		</div>
	</div>

	<?php 
		// include "include/panel.php"; 
	?>
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/theme/default.min.js"></script>
</body>
</html>
