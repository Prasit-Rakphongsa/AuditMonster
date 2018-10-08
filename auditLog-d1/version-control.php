<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Version Control</title>
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
       <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-admin.png" alt="Audit Monster" height="40"></a>
        <div class="content-container">
            <div class="sidebar">
                <ul>
                    <li onclick="location.href='EventSum.php';">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                    <li onclick="location.href='AddEvent.php';">Add Event</li>
                    <li onclick="location.href='AddField.php';">Add Field</li>
                    <li onclick="location.href='import.php';">Import & Export</li>
                    <li style="background-color:#B480C2;">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                    <li onclick="location.href='DebugMode.php';">Debug Mode</li>
                </ul>
            </div>
            <div class="content">
                <h2>Version Control</h2>
                 <div> 
                <table class="table">
                    <tbody>
                        <tr>
                            <th width="15%">VersionID</th>
                            <th width="53.5%">Description</th>
                            <th width="15%">Timestamp</th>
                            <th width="15%">Editor</th>
                            <th width="1.5%"></th>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div id="div2">
                        <table class="table" id="version-data">
                         <tbody>
                             <tr>
                              <th width="15%"></th>
                            <th width="53.5%"></th>
                            <th width="15%"></th>
                            <th width="15%"></th>
                            </tr>
                        <?php
                        	require_once"connect.php";
                             $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
                        	
                        //  	$mysql_qry = "select * from History;";
                        $mysql_qry = "select * from History H inner join (select idHistory,max(timestamp) as timestamp from History group by idHistory) K on H.idHistory = K.idHistory and H.timestamp = K.timestamp order by H.idHistory;";
                            $result = mysqli_query($con ,$mysql_qry);
                          	while($row = mysqli_fetch_array($result)) {
                         		echo'<tr onclick="submit(this)">
                         			<td class="c" >'.$row['idHistory'].'</td>
                         			<td class="c" >'.$row['description'].'</td>
                         			<td class="c">'.$row['timestamp'].'</td>
                         			<td class="c">'.$row['name'].'</td>
                         			</tr>';
                         	} 
                         ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <script src="jquery.min.js"></script>
    <script src="ddtf.js"></script>
    <script>
        $('#version-data').ddTableFilter();
    </script>
    <script>
        function submit(data){
            var url = "EditVersionControl.php?versionId=" + data.cells[0].innerHTML +"&oldTimeStemp=" + data.cells[2].innerHTML;
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