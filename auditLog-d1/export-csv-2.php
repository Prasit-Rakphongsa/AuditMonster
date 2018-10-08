<?php 
// P'nunu
    require 'phpspreadsheet/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Csv;

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
    
    // Prepare data to have the template of 4D array of eventCode -> subEventCode -> fieldName -> fieldValue
    $filtered_event_field_relation = array(array(array(array())));
    foreach($event_field_relation as $key => $value){
        $filtered_event_field_relation[$value["event_code"]][$value["sub_event_code"]][$value["field_name"]] = $value["generator_value"];
    }
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0);
    // store the index of column to write on spreadsheet
    $c = 1;
    // loop every event
    for($i=1; $i<count($event); $i++){
        if($event[$i]["send_to_edw"] == "Y" or $event[$i]["send_to_edw"] == "y"){
            // create a row of event
            $row = array();
            array_push($row,$event[$i]["event_code"]);
            // loop every fields to find if they're in that event or not
            for($k=2; $k<count($field); $k++){
                if(array_key_exists($field[$k]["field_name"],$filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]])){
                    // for sub_event_code field, if that event doesn't have sub event then export the word SUB_EVENT_CODE, but if there are then export the sub event code (such as 110A)
                    if($field[$k]["field_name"] == "SUB_EVENT_CODE"){
                        if($event[$i]["sub_event_code"] == 0){
                            array_push($row,"SUB_EVENT_CODE");
                        }else{
                            array_push($row,$event[$i]["sub_event_code"]);
                    }
                    // for every field in the event, check if that field is not extracted, then don't export it.
                    } else if($field[$k]["send_to_edw"] == "Y" or $field[$k]["send_to_edw"] == "y"){
                        if($field[$k]["field_name"] == "SUB_EVENT_CODE"){
                            
                        } else if($field[$k]["field_name"] == "INFORMATION_1"){
                            array_push($row,substr($filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]][$field[$k]["field_name"]], 1, -1));
                        } else if($field[$k]["field_name"] == "INFORMATION_2"){
                            array_push($row,substr($filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]][$field[$k]["field_name"]], 1, -1));
                        } else if($field[$k]["field_name"] == "INFORMATION_3"){
                            array_push($row,substr($filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]][$field[$k]["field_name"]], 1, -1));
                        } else if($field[$k]["field_name"] == "INFORMATION_4"){
                            array_push($row,substr($filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]][$field[$k]["field_name"]], 1, -1));
                        } else if($field[$k]["field_name"] == "INFORMATION_5"){
                            array_push($row,substr($filtered_event_field_relation[$event[$i]["event_code"]][$event[$i]["sub_event_code"]][$field[$k]["field_name"]], 1, -1));
                        } else{
                            array_push($row,$field[$k]["field_name"]);
                        }
                    }
                    // in case that the field is not extracted, just fill blank in the csv file.
                    else if($field[$k]["send_to_edw"] == "N" or $field[$k]["send_to_edw"] == "n"){
                        array_push($row,NULL);
                    }
                }
                // for the fields that are not in the event, then fill blank.
                else{
                    array_push($row,NULL);
                }
            // write the row we create into spreadsheet
            $spreadsheet->getActiveSheet()
                    ->fromArray(
                        $row,
                        NULL,
                        "A".($c)
                    );
            }
            // increase the index of our row
            $c++;
        }
    }
    // $spreadsheet->getActiveSheet()->setTitle($fileName);
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $writer->setDelimiter(',');
    $writer->setEnclosure('');
    $writer->setLineEnding("\r\n");
    $writer->setSheetIndex(0);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=report.csv");
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
?>