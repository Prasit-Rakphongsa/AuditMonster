<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Event Summary</title>
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
                    <li style="background-color:#B480C2;">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                    <li onclick="location.href='export.php';">Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                </ul>
            </div>
            <div class="content">
                <h2>Event Summary</h2>
                <div id="div1"> 
                    <table class="table">
                        <tbody>
                        <tr>
                            <th width="8%">Event Code</th>
                            <th width="8%">Sub Event Code</th>
                            <th width="16%">Event Name EN</th>
                            <th width="16%">Event Name TH</th>
                            <th width="20%">Description</th>
                            <th width="5%">To PRM</th>
                            <th width="5%">To GL</th>
                            <th width="5%">To EDW</th>
                            <th width="15%">Endpoints</th>
                            <th width="2%"></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="div2">
                        <table class="table" id="event-data">
                         <tbody>
                              <tr>
                            <th width="8%"></th>
                            <th width="8%"></th>
                            <th width="16%"></th>
                            <th width="16%"></th>
                            <th width="20%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                            <th width="15%"></th>
                            </tr>
                        <?php
                        	require_once"connect.php";
                             $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
                        	
                         	$mysql_qry = "select * from event ";
                            $result = mysqli_query($con ,$mysql_qry);
                          	while($row = mysqli_fetch_array($result)) {
                         		echo'<tr onclick="submit(this)">
                         			<td width="8%">'.$row['event_code'].'</td>
                         			<td width="8%">'.$row['sub_event_code'].'</td>
                        			<td width="16%">'.$row['event_name_en'].'</td>
                         			<td width="16%">'.$row['event_name_th'].'</td>
                         			<td width="20%">'.$row['description'].'</td>
                         			<td width="5%">'.$row['send_to_prm'].'</td>
                         			<td width="5%">'.$row['send_to_gl'].'</td>
                         			<td width="5%">'.$row['send_to_edw'].'</td>
                         			<td width="15.35%">'.$row['endpoints'].'</td>
                         			</tr>';
                         	} 
                         ?>
                  </tbody>
                </table>
                <!--</div>-->
            </div>
        </div>
    </div>
    <script src="jquery.min.js"></script>
    <script src="ddtf.js"></script>
    <script>
        $('#event-data').ddTableFilter();
    </script>
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