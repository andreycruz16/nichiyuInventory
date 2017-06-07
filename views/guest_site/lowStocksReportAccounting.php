<?php
include('session.php');
require_once('../../assets/tcpdf/tcpdf.php');

if($_GET['date']) {
    $date = $_GET['date'];
    $GLOBALS['date'] = $date;
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
        $this->Cell(0, 0, 'LOW STOCKS', 0, 0, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'R', 10);
        $this->Cell(0, 0, 'Accounting Department', 0, 0, 'C');

        $this->Ln();
        $this->SetFont('helvetica', 'R', 9);
        $this->Cell(0, 0, 'As of '.date('F d, Y', strtotime($GLOBALS['date'])), 0, 0, 'C');

        $this->SetMargins(0, 40, 0);
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
$pdf->SetTitle('AccountingReport_LowStocks_'.date('M-d-y'));
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
            <th align="center" width="5%"><i>#</i></th>
            <th align="center" width="35%">Part #</th>
            <th align="center" width="35%"> Description</th>
            <th align="center" width="12%"> Order Point</th>
            <th align="center" width="10%"> Total Quantity</th>
        </tr>';
require '../../database.php';
$sql = "SELECT
tbl_item_history.item_id,
tbl_item.description,
tbl_item.partNumber,
SUM(tbl_item_history.quantity),
tbl_item.minStockCount,
tbl_item_history.history_id,
tbl_item.boxNumber
FROM
tbl_item_history
INNER JOIN
tbl_item ON tbl_item.item_id = tbl_item_history.item_id
WHERE
tbl_item_history.dept_id = 4
AND tbl_item.status = 0
AND (tbl_item_history.date >= 0000-00-00 AND tbl_item_history.date <= '".$date."')
GROUP BY
tbl_item_history.item_id;";

 $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $ctr = 1;
            while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                $item_id = $row[0];
                $description = $row[1];
                $partNumber = $row[2];
                $quantity = $row[3];
                $minStockCount = $row[4];
                $history_id = $row[5];
                $boxNumber = $row[6];

                if(!($quantity <= $minStockCount && $quantity >= 0)) { 
                    continue; 
                }
$txt.='       
        <tr>
            <td align="center" style="white-space:nowrap;">'. $ctr .'</td>
            <td align="" style="white-space:nowrap;"> '. $partNumber .'</td>
            <td align="" style="white-space:nowrap;"> '. $description .'</td>
            <td align="center" style="white-space:nowrap;"> '. $minStockCount .'</td>
            <td align="center" style="white-space:nowrap;"> '. $quantity .'</td>
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
$pdf->Output('AccountingReport_LowStocks_'.date('F-d-y', strtotime($GLOBALS['date'])).'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+