<?php
    require 'phpspreadsheet/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    require_once"connect.php";
    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
    
    // prepare event
    $event_query = "select * from event";
    $event_query_result = mysqli_query($con ,$event_query);
    $event = array(array());
    while($row = $event_query_result->fetch_assoc()) {
        array_push($event,$row);
    }
    
    // prepare field
    $field_query = "select * from field";
    $field_query_result = mysqli_query($con ,$field_query);
    $field = array(array());
    while($row = $field_query_result->fetch_assoc()) {
        array_push($field,$row);
    }
    // prepare event field relation
    $event_field_relation_query = "select * from event_field_relation";
    $event_field_relation_query_result = mysqli_query($con ,$event_field_relation_query);
    $event_field_relation = array(array());
    while($row = $event_field_relation_query_result->fetch_assoc()) {
        array_push($event_field_relation,$row);
    }
    
    $filtered_event_field_relation = array(array(array(array())));
    foreach($event_field_relation as $key => $value){
        $filtered_event_field_relation[$value["event_code"]][$value["sub_event_code"]][$value["field_name"]] = $value["generator_value"];
    }
    $fieldRow = array();
    for($i=1; $i<count($field); $i++){
        array_push($fieldRow,$field[$i]["field_name"]);
    }
    
    $fileName = 'audit_log_sample.xlsx';
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->getProperties()
                ->setCreator("Audit Log Revamp Team")
                ->setLastModifiedBy("Audit Log Revamp Team");
    $spreadsheet->setActiveSheetIndex(0);
    // sheet1
    $spreadsheet->getActiveSheet()->setTitle("Event");
    $spreadsheet->getActiveSheet()
                ->setCellValue('A1','EVENT_CODE')
                ->setCellValue('B1','SUB_EVENT_CODE')
                ->setCellValue('C1','EVENT_NAME_EN')
                ->setCellValue('D1','EVENT_NAME_TH')
                ->setCellValue('E1','DESCRIPTION')
                ->setCellValue('F1','SEND_TO_PRM')
                ->setCellValue('G1','SEND_TO_GL')
                ->setCellValue('H1','SEND_TO_EDW')
                ->setCellValue('I1','ENDPOINTS');
    $spreadsheet->getActiveSheet()
                ->fromArray(
                    $fieldRow,
                    NULL,
                    'J1'
                );
    for($i=1; $i<count($event); $i++){
        $row = array();
        array_push($row,$event[$i]["event_code"]);
        array_push($row,$event[$i]["sub_event_code"]);
        array_push($row,$event[$i]["event_name_en"]);
        array_push($row,$event[$i]["event_name_th"]);
        array_push($row,$event[$i]["description"]);
        array_push($row,$event[$i]["send_to_prm"]);
        array_push($row,$event[$i]["send_to_gl"]);
        array_push($row,$event[$i]["send_to_edw"]);
        array_push($row,$event[$i]["endpoints"]);
        for($k=1; $k<count($field); $k++){
            if(array_key_exists($field[$k]["field_name"],$filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]])){
                array_push($row,$filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]][$field[$k]["field_name"]]);
            }else {
                array_push($row,NULL);
            }
        }
        $spreadsheet->getActiveSheet()
                ->fromArray(
                    $row,
                    NULL,
                    "A".($i+1)
                );
    }
    
    $spreadsheet->createSheet();
    $spreadsheet->setActiveSheetIndex(1);
       // sheet 2
    $spreadsheet->getActiveSheet()->setTitle("Field Dictionary");
    $spreadsheet->getActiveSheet()
                ->setCellValue('A1','FIELD_ID')
                ->setCellValue('B1','FIELD_NAME')
                ->setCellValue('C1','TYPE')
                ->setCellValue('D1','LENGTH')
                ->setCellValue('E1','DEC_POINT')
                ->setCellValue('F1','THAI_CHAR')
                ->setCellValue('G1','DESCRIPTION')
                ->setCellValue('H1','SAMPLE_DATA')
                ->setCellValue('I1','REMARKS')
                ->setCellValue('J1','GENERATED_BY')
                ->setCellValue('K1','SEND_TO_EDW');
    for($i=1; $i<count($field); $i++){
        $spreadsheet->getActiveSheet()
                ->fromArray(
                    $field[$i],
                    NULL,
                    "A".($i+1)
                );
    }
    
    $spreadsheet->createSheet();
    $spreadsheet->setActiveSheetIndex(2);
    
    // sheet 3
    $spreadsheet->getActiveSheet()->setTitle("Version Control");
    $spreadsheet->getActiveSheet()
                ->setCellValue('A1','ID')
                ->setCellValue('B1','VERSION_ID')
                ->setCellValue('C1','EDITOR')
                ->setCellValue('D1','TIMESTAMP')
                ->setCellValue('E1','DESCRIPTION');
    $version_control_query = "select id,idHistory,name,timestamp,description from History";
    $version_control_query_result = mysqli_query($con ,$version_control_query);
    $version_control = array(array());
    while($row = $version_control_query_result->fetch_assoc()) {
        array_push($version_control,$row);
    }
    for($i=1; $i<count($version_control); $i++){
        $spreadsheet->getActiveSheet()
                ->fromArray(
                    $version_control[$i],
                    NULL,
                    "A".($i+1)
                );
    }
    
    $spreadsheet->setActiveSheetIndex(0);
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=report.xlsx");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
?>