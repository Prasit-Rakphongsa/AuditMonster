<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Field Detail</title>
</head>

<body>
    <div class="web-container">
        <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-read.png" alt="Audit Monster" height="40"></a>
        <div class="content-container">
            <div class="sidebar">
                <ul>
                    <li onclick="location.href='EventSum.php';">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                       <li onclick="location.href='export.php';">Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                </ul>
            </div>
            <div class="content">
                <?php
                    $fieldName = $_POST['fieldName'];
                    require_once"connect.php";
                    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
                     $User="U";
                            $System="S";
                            $generated_value="888";
                 	$mysql_qry = 'select * from field where field_name = "'.$fieldName.'";';
                    $result = mysqli_query($con ,$mysql_qry);
                    $fieldDetail = array();
                    while($row = mysqli_fetch_array($result)) {
                         array_push($fieldDetail,$row);
                    }
                    
                    echo '<div>';
                    echo '<h2 style="display: inline-block;">Field Detail</h2>';
                    echo '</div>';
                    echo '<div>Field ID : '.$fieldDetail[0]["field_id"].'</div>';
                    echo '<div>Field Name : '.$fieldDetail[0]["field_name"].'</div>';
                    echo '<div>Type : '.$fieldDetail[0]["type"].'</div>';
                    echo '<div>Length : '.$fieldDetail[0]["length"].'</div>';
                    echo '<div>Decimal Point : '.$fieldDetail[0]["decimal_point"].'</div>';
                    echo '<div>Thai Character : '.$fieldDetail[0]["thai_char"].'</div>';
                    echo '<div>Description : '.$fieldDetail[0]["description"].'</div>';
                    echo '<div>Sample Data : '.$fieldDetail[0]["sample_data"].'</div>';
                    echo '<div>Remarks : '.$fieldDetail[0]["remarks"].'</div>';
                    echo '<div>Generated By : '.$fieldDetail[0]["generated_by"].'</div>';
                    echo '<div>Send to EDW : '.$fieldDetail[0]["send_to_edw"].'</div>';
                    // if($fieldName == "INFORMATION_1" || $fieldName == "INFORMATION_2" || $fieldName == "INFORMATION_3" || $fieldName == "INFORMATION_4" || $fieldName == "INFORMATION_5" || $fieldName == "INFORMATION_6"){
                        $mysql_query2 = 'select * from event_field_relation inner join event on event_field_relation.event_code = event.event_code and event_field_relation.sub_event_code = event.sub_event_code where field_id = '.$fieldDetail[0]["field_id"].';';
                        $result2 = mysqli_query($con ,$mysql_query2);
                        
                        ?>
                        
                    <div id="div1">
                         <table class="edit-page-table">
                             <tboby>
                                <tr>
                                 <th width="10%">Event Code</th>
                                 <th width="15%">Sub Event Code</th>
                                 <th width="20%">Event Name EN</th>
                                 <th width="20%">Event Name TH</th>
                                 <th width="15%">Field</th>
                                 <th width="10%">Value</th>
                                 <th width="15%">Generated By</th>
                                 <th width="2%"></th>
                                 </tr>
                            </tboby>
                        </table>
                    </div>
                    <div id="div2">
                         <table class="edit-page-table">
                             <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result2)) {
                            if(strcmp($row['generated_by'],$User)==0){
                        		    $generated_value="User";
                        		}else if(strcmp($row['generated_by'],$System)==0){
                        		    $generated_value="System";
                        		}else{
                        		    $generated_value="Other fields";
                        		}
                            echo '<tr>
                            <td width="10%">'.$row['event_code'].'</td>
                            <td width="15%">'.$row['sub_event_code'].'</td>
                             <td width="20%">'.$row['event_name_en'].'</td>
                            <td width="20%">'.$row['event_name_th'].'</td>
                            <td width="15%">'.$row['field_name'].'</td>';
                            if($fieldName == "INFORMATION_1" || $fieldName == "INFORMATION_2" || $fieldName == "INFORMATION_3" || $fieldName == "INFORMATION_4" || $fieldName == "INFORMATION_5" || $fieldName == "INFORMATION_6"){
                                echo '<td width="10%">&lt;'.substr($row["generator_value"],1,-1).'&gt; ('.$row["mandatory"].')</td>';
                            }else{
                                echo '<td width="10%">'.$row["mandatory"].'</td>';
                            }
                            echo '<td width="15%">'.$generated_value.'</td></tr>';
                        }
                    // }
                    
                    
                ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submit(data){
            var url = "EventDetail.php?eventCode=" + data.cells[0].innerHTML + "&subEventCode=" + data.cells[1].innerHTML;
            postURL(url,true);
        }
        function postURL(url, multipart) {
          var form = document.createElement("FORM");
          form.method = "POST";
          if(multipart) {
            form.enctype = "multipart/form-data";
          }
          form.style.display = "none";
          document.body.appendChild(form);
          form.action = url.replace(/\?(.*)/, function(_, urlArgs) {
            urlArgs.replace(/\+/g, " ").replace(/([^&=]+)=([^&=]*)/g, function(input, key, value) {
              input = document.createElement("INPUT");
              input.type = "hidden";
              input.name = decodeURIComponent(key);
              input.value = decodeURIComponent(value);
              form.appendChild(input);
            });
            return "";
          });
          form.submit();
        }
    </script>
</body>
</html>