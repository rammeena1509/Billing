<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 7, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// set text shadow effect
$pdf->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$invoice=$data['info']->order_id;
$idate=$data['info']->order_date;
$itime=$data['info']->order_time;
$cname=$data['info']->customer_name;
$cmobile=$data['info']->customer_mobile;
$cmail=$data['info']->customer_email;
$caname=$data['info']->cashier_name;
$camobile=$data['info']->cashier_mobile;
$camail=$data['info']->cashier_email;
$total=$data['info']->total_price;
$discount=$data['info']->discount;
$gst=$total*.18;
$total_paid=$total-$discount+$gst;
$str="";
$i=1;
foreach($data['detail'] as $row){
    $str.="<tr><td><br/>".$i."<br/></td><td><br/>".$row->product_id.$row->batch_id."<br/></td><td><br/>".$row->product_name."<br/></td><td><br/>".$row->product_price."<br/></td><td><br/>".$row->quantity."<br/></td><td><br/>".$row->quantity*$row->product_price."<br/></td></tr>";
    $i++;
}
$html = <<<EOD
<html>
<head>
<style>
.table {
  width: 100%;
  margin-bottom: 1rem;
}
    
.table th,
.table td {
  vertical-align: top;
    text-align: center;
  border-top: 1px solid #eceeef;
}

.table thead th {
  text-align: center;
  border-bottom: 5px solid #eceeef;
}

.table tbody + tbody {
  border-top: 2px solid #eceeef;
}

.table .table {
  background-color: #fff;
}
.table-bordered {
  border: 1px solid #eceeef;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #eceeef;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}



.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table-responsive.table-bordered {
  border: 2px solid black;
}
</style>
</head>  
<body>
    <table>
        <tr>
            <td width="200px"><br/><br/><img src="./assets/logo.png" alt="logo-image"/></td>
            <td width="300px" style="text-align: center;">
                <p>Ramshankar Meena,E-398,Behind Mother Dairy,Delta 1 Greater Noida,U.P. 201308</p>
                <p><b>CIN:GW43GDBBBAJSYENCNSNS</b></p>
                <p><b>GST NO.:GW43GDBBBAJSYENCNSNS<br/></b></p>
            </td>
            <td style="float:right;"><br/><br/><img src="./assets/logo.png" alt="logo-image"/></td>
        </tr>
    </table>
    <div class="container">
        <div class="table-responsive">          
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td width="660px">
                        <table>
                                <tr>
                                    <th colspan="3">
                                    <br/>
                                        Billing Detail<br/>
                                    </th>
                                </tr>
                                <tr>
                                    <td><br/>Invoice Number<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$invoice<br/></td>
                                </tr>
                                <tr>
                                    <td><br/>Invoice Date<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$idate<br/></td>
                                </tr>
                                <tr>
                                    <td><br/>Invoice Time<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$itime<br/></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <br/>&nbsp;<br/>
                        </th>
                    </tr>
                    <tr>
                        <td width="330px">
                            <table>
                                <tr>
                                    <th colspan="3">
                                       <br/> Billing To<br/>
                                    </th>
                                </tr>
                                <tr>
                                    <td><br/>Name<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$cname<br/></td>
                                </tr>
                                <tr>
                                    <td><br/>Mobile<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$cmobile<br/></td>
                                </tr>
                                <tr>
                                    <td><br/>Email<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$cmail<br/></td>
                                </tr>
                            </table>
                        </td>
                        <td width="330px">
                        <table>
                                <tr>
                                    <th colspan="3">
                                        <br/>Billing By<br/>
                                    </th>
                                </tr>
                                <tr>
                                    <td><br/>Name<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$caname<br/></td>
                                </tr>
                                <tr>
                                    <td><br/>Mobile<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$camobile<br/></td>
                                </tr>
                                <tr>
                                    <td><br/>Email<br/></td>
                                    <td><br/>:<br/></td>
                                    <td><br/>$camail<br/></td>
                                </tr>
                            </table>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
            <br/><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.No.<br/></th>
                        <th>Product Id<br/></th>
                        <th>Product Name<br/></th>
                        <th>Unit Price<br/><br/></th>
                        <th>Quantity<br/></th>
                        <th>Total<br/></th>
                    </tr>
                    <tr><th colspan="6">&nbsp;</th></tr>
                </thead>
                <tbody>
                $str
                </tbody>
            </table>
            <br/><br/>
            <table align="right">
                <tr>
                    <th>Sub Total</th>
                    <td>:</td>
                    <th>$total</th>
                </tr>
                <tr>
                    <th>GST @ 18%</th>
                    <td>:</td>
                    <th>$gst</th>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>:</td>
                    <th>$discount</th>
                </tr>
                <tr>
                    <th>Total Amount Paid</th>
                    <td>:</td>
                    <th>$total_paid</th>
                </tr>
            </table>
            </div>
            </div>
            <center><p><sup>*</sup>This is auto-generated invoice.Signature is not required</p></center>
</body>
</html>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$output=$pdf->Output('rammeena.pdf', 's');
file_put_contents('./assets/invoices/'.$invoice.'.pdf', $output);

//============================================================+
// END OF FILE
//============================================================+
