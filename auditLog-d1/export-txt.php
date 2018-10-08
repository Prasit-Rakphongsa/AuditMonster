<?php
    require 'phpspreadsheet/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
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
    
    $es_gl = "es_gl_list = ";
    $es_gl_list = array();
    for($i=1; $i<count($event); $i++){
        if($event[$i]["send_to_gl"] == "Y"){
            if(in_array($event[$i]["event_code"],$es_gl_list) == false){
                $es_gl .= $event[$i]["event_code"].",";
                array_push($es_gl_list,$event[$i]["event_code"]);
            }
        }
    }
    $es_gl = substr($es_gl,0,-1);
    
    $es_fields_size = "es_fields_size = ";
    for($i=1; $i<count($field); $i++){
        $es_fields_size .= $field[$i]["length"].",";
    }
    $es_fields_size = substr($es_fields_size,0,-1);
    $output = "[ES]\r\n".$es_gl."\r\n".$es_fields_size;
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="report.txt"');
    print($output);
    exit;
?>