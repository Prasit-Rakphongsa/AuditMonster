<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Field Dictionary</title>
     <style>
        select
        {
        width:40px;
        height:20px;
        cursor: pointer;
    	/*background-color:#a65959;*/
    	box-shadow: 0 2px 0 red;
    	border-radius: 2px;
    }
    </style>
</head>

<body>
    <div class="web-container">
        <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-read.png" alt="Audit Monster" height="40"></a>
        <div class="content-container">
            <div class="sidebar">
                <ul>
                    <li onclick="location.href='EventSum.php';">Event Summary</li>
                    <li style="background-color:#B480C2;">Field Dictionary</li>
                    <li onclick="location.href='export.php';">Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                </ul>
            </div>
            <div class="content">
                <h2>Field Dictionary</h2>
                <div id="div1">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th width="3%">ID</th>
                                <th width="15%">Field Name</th>
                                <th width="9%">Type</th>
                                <th width="5%">Length</th>
                                <th width="5%">Dec Point</th>
                                <th width="4%">ThaiChar</th>
                                <th width="20%">Description</th>
                                <th width="15%">Sample Data</th>
                                <th width="15%">Remarks</th>
                                <th width="7%">Generated By</th>
                                 <th width="2%"></th>
                            </tr>
                            </tbody>
                            </table>
                        </div>
                    <div id="div2">
                        <table class="table" id="field-data">
                            <tbody>
                                <tr>
                            <th width="4.5%"></th>
                            <th width="14%"></th>
                            <th width="9%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="4%"></th>
                            <th width="20%"></th>
                            <th width="15%"></th>
                            <th width="15%"></th>
                            <th width="7%"></th>
                            </tr>
                        <?php
                        	require_once"connect.php";
                            $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
                              $User="U";
                            $System="S";
                            $generated_value="888";
                        	$mysql_qry = "select * from field";
                            $result = mysqli_query($con ,$mysql_qry);
                         	while($row = mysqli_fetch_array($result)) {
                         	    if(strcmp($row['generated_by'],$User)==0){
                        		    $generated_value="User";
                        		}else if(strcmp($row['generated_by'],$System)==0){
                        		    $generated_value="System";
                        		}else{
                        		    $generated_value="Other fields";
                        		}
                         	  echo'<tr class="event-sum-row" onclick="submit(this)" width="100%">
                         	    <td width="3%">'.$row['field_id'].'</td>
                                <td width="15%">'.$row['field_name'].'</td>
                    			<td width="9%">'.$row['type'].'</td>
                    			<td width="5%">'.$row['length'].'</td>
                    			<td width="5%">'.$row['decimal_point'].'</td>
                    			<td width="4%">'.$row['thai_char'].'</td>
                    			<td width="20%">'.$row['description'].'</td>
                    			<td width="15%">'.$row['sample_data'].'</td>
                        		<td width="15%">'.$row['remarks'].'</td>
                        		<td width="7.25%">'.$generated_value.'</td> 
                        		</tr>';
                        	} 
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script src="jquery.min.js"></script>
    <script src="ddtf.js"></script>
    <script>
        $('#field-data').ddTableFilter();
    </script>
    <script>
        function submit(data){
            var url = "FieldDetail.php?fieldName=" + data.cells[1].innerHTML;
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