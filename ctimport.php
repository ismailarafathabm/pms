<?php
include_once './../EMS/Excels/Classes/PHPExcel.php';
$source = "ct.xls";
$excelReader = PHPExcel_IOFactory::createReaderForFile($source);
$excelObj = $excelReader->load($source);
$worksheet = $excelObj->getSheet(0);
$lastRow = $worksheet->getHighestRow();
$lastColumn = $worksheet->getHighestColumn();
$rpts = [];
$noplates = [];
for ($row = 1; $row <= $lastRow; $row++) {
    $rpt = array();
    $projectcode = trim($worksheet->getCell('A' . $row)->getValue());
    $projectname = trim($worksheet->getCell('B' . $row)->getValue());

    $faccount = trim($worksheet->getCell('C' . $row)->getValue());
    // $dayval = $faccount;    // you would read from your file here
    // $date = new DateTime('1899-12-31');
    // $date->modify("+$dayval day -1 day");
    // $faccount = $date->format('Y-m-d');

    //echo $date->format('Y-m-d');
    $raccount = trim($worksheet->getCell('D' . $row)->getValue());
    $fmaterial = trim($worksheet->getCell('E' . $row)->getValue());
    $rmaterial = trim($worksheet->getCell('F' . $row)->getValue());
    $cuttinglistno = trim($worksheet->getCell('G' . $row)->getValue());
    $monumber = trim($worksheet->getCell('H' . $row)->getValue());
    $marking = trim($worksheet->getCell('I' . $row)->getValue());
    $description = trim($worksheet->getCell('J' . $row)->getValue());
    $location = trim($worksheet->getCell('K' . $row)->getValue());
    $qty = trim($worksheet->getCell('L' . $row)->getValue());
    $height = trim($worksheet->getCell('M' . $row)->getValue());
    $width = trim($worksheet->getCell('N' . $row)->getValue());
    $area = trim($worksheet->getCell('O' . $row)->getValue());
    $gono = trim($worksheet->getCell('P' . $row)->getValue());
    $mstatus = trim($worksheet->getCell('Q' . $row)->getValue());
    $mrefno = trim($worksheet->getCell('R' . $row)->getValue());
    $foperation = trim($worksheet->getCell('S' . $row)->getValue());
    $roperation = trim($worksheet->getCell('T' . $row)->getValue());
    $rproecution = trim($worksheet->getCell('U' . $row)->getValue());

    $rpt = array(
        'projectcode' => $projectcode,
        'projectname' => $projectname,
        'faccount' => $faccount,
        'raccount' => $raccount,
        'fmaterial' => $fmaterial,
        'rmaterial' => $rmaterial,
        'cuttinglistno' => $cuttinglistno,
        'monumber' => $monumber,
        'marking' => $marking,
        'description' => $description,
        'location' => $location,
        'qty' => $qty,
        'height' => $height,
        'width' => $width,
        'area' => $area,
        'gono' => $gono,
        'mstatus' => $mstatus,
        'mrefno' => $mrefno,
        'foperation' => $foperation,
        'roperation' => $roperation,
        'rproecution' => $rproecution,
    );

    $rpts[] = $rpt;
}
echo json_encode($rpts);
