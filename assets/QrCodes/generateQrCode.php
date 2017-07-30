<?php    

    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'QrCodes'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'QrCodes/';

    include "../phpqrcode/qrlib.php";

    $part = $_GET['PartNumber'];
    $desc = $_GET['Description'];
    $box = $_GET['BoxNumber'];
    
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

    $qrValue = '1234-1234';
    $filename = $PNG_TEMP_DIR.$qrValue;
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 10;
    
 
    QRcode::png($qrValue, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
       
    //display generated file
    // echo '<img title="'.$qrValue.'" src="'.$PNG_WEB_DIR.basename($filename).'" />';  
    echo '
    <table border="1" rules="all" width="350">
        <tr><td style="width:120px;color:blue;"><strong>PART NUMBER</strong></td>
        <td>'.$part.'</td><td rowspan="3">&nbsp;&nbsp;<img width="100" src="'.$PNG_WEB_DIR.basename($filename).'" /></td></tr>
        <tr><td style="width:120px;color:blue;"><strong>DESCRIPTION</strong></td><td>'.$desc.'</td></tr>
        <tr><td style="width:120px;color:blue;"><strong>BOX NUMBER</strong></td><td>'.$box.'</td></tr>
    </table>
    ';