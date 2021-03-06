<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Import</title>
</head>
<body>
    <table class="error-table">
        <tbody>
            <tr>
                <th>Event Code</th>
                <th>Sub Event Code</th>
                <th>Field</th>
                <th>Mandatory</th>
                <th>Value</th>
                <th>Generated By</th>
                <th>Send to EDW</th>
                <th>Status</th>
            </tr>
            <?php
require_once 'excel/PHPExcel.php';
include 'excel/PHPExcel/IOFactory.php';
require_once"connect.php";
$con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);


function ExistingCheck($code,$sub,$field,$man,$value,$gen,$edw){
    // check event in event table
   $queryEvent=$GLOBALS['con']->query("SELECT * from event WHERE event_code='$code' and sub_event_code='$sub'");
   $event = array(array());
   while($row = mysqli_fetch_array($queryEvent)){
       array_push($event,$row);
   }
//   echo 'event = '.count($event).' ';
   if(count($event) > 1){
       // check field in field table
       $queryField = $GLOBALS['con']->query("SELECT * from field WHERE field_name='$field'");
       $fieldTable = array(array());
       while($row = mysqli_fetch_array($queryField)){
           array_push($fieldTable,$row);
       }
    //   echo 'field = '.count($fieldTable).' ';
        if(count($fieldTable) > 1){
            // check event, field in relation table
            $queryRelation = $GLOBALS['con']->query('select * from event_field_relation where event_code = '.$code.' and sub_event_code = "'.$sub.'" and field_name = "'.$field.'";');
            $relation = array(array());
           while($row = mysqli_fetch_array($queryRelation)){
               array_push($relation,$row);
           }
        //   echo 'relation = '.count($relation).' ';
            if(count($relation) > 1){
                //update old relation information
                $sql=$GLOBALS['con']->prepare('update event_field_relation set event_code = '.$code.', sub_event_code = "'.$sub.'",field_id='.$fieldTable[1]["field_id"].',field_name="'.$field.'",mandatory="'.$man.'",generator_value="'.$value.'",generated_by="'.$gen.'",send_to_edw="'.$edw.'" where event_code = '.$code.' and sub_event_code = "'.$sub.'" and field_name = "'.$field.'";');
                $sql->execute();
                $sql->close();
                return true;
            }else{
                // insert new relation
                $sql=$GLOBALS['con']->prepare('insert into event_field_relation(event_code,sub_event_code,field_id,field_name,mandatory,generator_value,generated_by,send_to_edw) values('.$code.',"'.$sub.'",'.$fieldTable[1]["field_id"].',"'.$field.'","'.$man.'","'.$value.'","'.$gen.'","'.$edw.'");');
                $sql->execute();
                $sql->close();
                return true;
            }
            
      }else{
          return false;
      }
    }else{
        return false;
    }
}


if(isset($_POST['upload'])){
$inputFileName =$_FILES['file']['tmp_name']; 
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}

    $i = 0;
    $wholeStatus = true;
    if(count($namedDataArray) == 0){
        // echo "<script>
        // alert(\"Please insert your data in excel sheet first.\");
        // window.location.href='import.php';
        // </script>";
        echo '<div style="color: red; text-align: center;">Please insert your data in excel sheet first.</div>';
        echo '<div style="text-align: center; margin-top: 20px;"><button id="confirm-button" onclick=window.location.href="import.php">Back to Import</button></div>';
    }else{
    foreach ($namedDataArray as $result) {
    		$i++;
    		$eventCode = strtoupper(trim($result["EVENT_CODE"]," "));
    		$subEventCode = strtoupper(trim($result["SUB_EVENT_CODE"]," "));
    		$fieldName = strtoupper(trim($result["FIELD"]," "));
    		$mandatory = strtoupper(trim($result["MANDATORY"]," "));
    		$value = strtoupper(trim($result["VALUE"]," "));
    		$generatedBy = strtoupper(trim($result["GENERATED_BY"]," "));
    		$sendToEDW = strtoupper(trim($result["SEND_TO_EDW"]," "));
    		$status = true;
            echo "<tr>";
            if(preg_match("/^[0-9]+$/", $eventCode)) {
                echo "<td>".$eventCode."</td>";
            }else{
                // echo "Event Code at row ".($i)." has wrong format.</br>";
                echo '<td style="background-color: #ff745b">'.$eventCode.'</td>';
                $status = false;
                $wholeStatus = false;
            }
            if(preg_match("/^[A-Z^0-9]+$/", $subEventCode)) {
                echo "<td>".$subEventCode."</td>";
            }else{
                // echo "Sub Event Code at row ".($i)." has wrong format.</br>";
                echo '<td style="background-color: #ff745b">'.$subEventCode.'</td>';
                $status = false;
                $wholeStatus = false;
            }
            if(preg_match("/^[A-Za-z_]+$/", $fieldName)) {
                echo "<td>".$fieldName."</td>";
            }else{
                echo '<td style="background-color: #ff745b">'.$fieldName.'</td>';
                $status = false;
                $wholeStatus = false;
            }
            if(preg_match("/^[M,O]$/", $mandatory)) {
                echo "<td>".$mandatory."</td>";
            }else{
                echo '<td style="background-color: #ff745b">'.$mandatory.'</td>';
                $status = false;
                $wholeStatus = false;
            }
            if(preg_match("/^[M,O]$/", $value)) {
                echo "<td>".$value."</td>";
            }else{
                if(preg_match("/^[<]$/", substr($value,0,1)) && preg_match("/^[>]$/", substr($value,-1)) && preg_match("/^[.A-Z0-9]+$/", substr($value,1,-1))){
                    echo "<td>&lt;".substr($value,1,-1)."&gt;</td>";
                }else{
                    echo '<td style="background-color: #ff745b;">'.$value.'</td>';
                    $status = false;
                    $wholeStatus = false;
                }
            }
            if(preg_match("/^[S,U,F]$/", $generatedBy)) {
                echo "<td>".$generatedBy."</td>";
            }else{
                echo '<td style="background-color: #ff745b">'.$generatedBy.'</td>';
                $status = false;
                $wholeStatus = false;
            }
            if(preg_match("/^[Y,N]$/", $sendToEDW)) {
                echo "<td>".$sendToEDW."</td>";
            }else{
                echo '<td style="background-color: #ff745b">'.$sendToEDW.'</td>';
                $status = false;
                $wholeStatus = false;
            }
            if($status){
                // echo $result["EVENT_CODE"].','.$result["SUB_EVENT_CODE"].','.$result["FIELD"].','.$result["MANDATORY"].','.$result["VALUE"].','.$result["GENERATED_BY"].','.$result["SEND_TO_EDW"];
                if(ExistingCheck($result["EVENT_CODE"],$result["SUB_EVENT_CODE"],$result["FIELD"],$result["MANDATORY"],$result["VALUE"],$result["GENERATED_BY"],$result["SEND_TO_EDW"])){
        		    echo '<td style="background-color: #91ff5b">Success</td>';
        		}else{
        		    echo '<td style="background-color: #ff745b">Fail</td>';
        		    $wholeStatus = false;
        		  //  break;
        		}
            }else{
                echo '<td style="background-color: #ff745b">Fail</td>';
            }
    }
    
    if($wholeStatus){
        $username=$_POST['username'];
        $userdes=$_POST['userdes'];
        $sql="INSERT INTO History(name,timestemp,description) values('$username',CURRENT_TIMESTAMP(),'$userdes')";
        if(mysqli_query($con, $sql)){
            echo '<div style="text-align: center; margin-top: 20px;"><button id="confirm-button" onclick=window.location.href="import.php">Back to Import</button></div>';   
        }else{
            echo '<div style="text-align: center; margin-top: 20px;"><button id="confirm-button" onclick=window.location.href="import.php">Back to Import</button></div>';
        }
    }else{
        echo '<div style="text-align: center; margin-top: 20px;"><button id="confirm-button" onclick=window.location.href="import.php">Back to Import</button></div>';
    }
    }
    }else{
        echo "<script>
		 alert('Excel file has incorrect format. Please check your excel file again.');
         window.location.href='import.php';
		 </script>";
    }

    mysqli_close($con);
?>
        </tbody>
    </table>
</body>
</html>