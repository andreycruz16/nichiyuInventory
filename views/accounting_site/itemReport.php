<?php
 ob_start();
include('session.php');
require_once('../../assets/tcpdf/tcpdf.php');

if($_GET['item_id']) {
    $item_id = $_GET['item_id'];
    $GLOBALS['item_id'] = $item_id;
} 

if($_GET['partNumber']) {
    $partNumber = $_GET['partNumber'];
    $GLOBALS['partNumber'] = $partNumber;
}  

if($_GET['description']) {
    $description = $_GET['description'];
    $GLOBALS['description'] = $description;
}  

if($_GET['quantity']) {
    $quantity = $_GET['quantity'];
    $GLOBALS['quantity'] = $quantity;
}  

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $image_file = '../../assets/img/nichiyu.png';
        $this->Image($image_file, 10, 10, 55, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $this->Ln();
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 0, 'NICHIYU ASIALIFT PHILIPPINES, INC.', 0, 0, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'R', 8);
        $this->Cell(0, 0, '# 9M.FLORES ST. STO. ROSARIO SILANGAN, PATEROS M.M.', 0, 0.5, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 0, 'ITEM TRANSACTION HISTORY', 0, 0, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'R', 10);
        $this->Cell(0, 0, 'Accounting Department', 0, 0, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'R', 9);
        $this->Cell(0, 0, 'As of '.date('F d, Y'), 0, 0, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'R', 10);
        $this->Cell(0, 10, 'Description: '.$GLOBALS['description'].'          Part Number: '.$GLOBALS['partNumber'], 0, 0, '');

        $this->SetMargins(0, 44, 0);
    }

    // Page footer
    public function Footer() {
        $this->Ln();
        $this->SetFont('helvetica', 'R', 10);
        $this->Cell(0, 0, 'Date Printed: '.date("F d, Y").'');        
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

    }
}
// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('NICHIYU ASIALIFT');
$pdf->SetTitle('Accounting_ItemReport_'.$partNumber.'_'.date('M-d-y'));
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
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
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// set some text to print
$txt = '

<table rules="all" border=".5" width="100%">
        <tr style="background-color:#555; color:#fff;">
            <th align="center" width="4%">#</th>
            <th align="center" width="7.5%"> Date</th>
            <th align="center" width="11.5%"> Reference Type</th>
            <th align="center" width="14%"> Reference #</th>
            <th align="center" width="12.5%"> Receiving Report</th>
            <th align="center" width="9.5%"> Transfer&nbsp;Type</th>
            <th align="center" width="11.5%"> Unit&nbsp;Cost</th>
            <th align="center" width="9.5%"> Quantity</th>
            <th align="center" width="11.5%"> Total Cost</th>
            <th align="center" width="9.0%"> Stock on hand</th>
        </tr>';
require '../../database.php';
$sql = "SELECT 
       tbl_item_history.timestamp, 
       tbl_item_history.date, 
       tbl_reference.referenceType,
       tbl_item_history.referenceNumber, 
       tbl_item_history.receivingReport, 
       tbl_item_history.transferType, 
       tbl_item_history.quantity, 
       tbl_item_history.user_id, 
       tbl_item_history.customerName, 
       tbl_item_history.unitCost 
       FROM tbl_item_history 
       INNER JOIN tbl_reference ON tbl_item_history.reference_id = tbl_reference.reference_id
       WHERE item_id = ".$item_id." 
       AND dept_id = 4
       AND tbl_reference.reference_id != 0
       ORDER BY tbl_item_history.history_id ASC;";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $ctr = 1;
            $stockOnHand = 0;
            while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                $timestamp = $row[0];
                $date = $row[1];
                $referenceType = $row[2];
                $referenceNumber = $row[3];
                $receivingReport = $row[4];
                $transferType = $row[5];
                $quantity = $row[6];
                $username = $row[7];
                $customerName = $row[8];
                $unitCost = $row[9];
                $stockOnHand = $stockOnHand + $quantity;


$txt.='       
        <tr>
            <td align="center" style="white-space:nowrap;"> '. $ctr .'</td>
            <td align="center" style="white-space:nowrap;"> '. date('m/d/Y', strtotime($date)) .'</td>
            <td align="center" style="white-space:nowrap;"> '. $referenceType .'</td>
            <td align="center" style="white-space:nowrap;"> '. $referenceNumber .'</td>
            <td align="center" style="white-space:nowrap;"> '. $receivingReport .'</td>
            <td align="center" style="white-space:nowrap;"> '. $transferType .'</td>
            <td align="center" style="white-space:nowrap;"> PHP&nbsp;'. $unitCost .'</td>
            <td align="center" style="white-space:nowrap;"> '. $quantity .'</td>
            <td align="center" style="white-space:nowrap;"> PHP&nbsp;'. number_format((float)abs($quantity*$unitCost), 2, '.', '') .'</td>
            <td align="center" style="white-space:nowrap;"> '. $stockOnHand .'</td>
        </tr>                                                                   
    ';

                $ctr++;
            }
        }
        mysqli_close($conn);

$txt.='
</table>
<p align="center"><i>____________NOTHING FOLLOWS____________</i></p>
    ';


// print a block of text using Write()
$pdf->writeHTML($txt, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Accounting_ItemReport_'.$partNumber.'_'.date('M-d-y').'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+