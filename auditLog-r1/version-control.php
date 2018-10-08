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
        <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-read.png" alt="Audit Monster" height="40"></a>
        <div class="content-container">
            <div class="sidebar">
                <ul>
                    <li onclick="location.href='EventSum.php';">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                    <li onclick="location.href='export.php';">Export</li>
                    <li style="background-color:#B480C2;">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                </ul>
            </div>
            <div class="content">
                <h2>Version Control</h2>
                <div id="div-1">
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
                        	
                         	$mysql_qry = "select * from History;";
                            $result = mysqli_query($con ,$mysql_qry);
                          	while($row = mysqli_fetch_array($result)) {
                         		echo'<tr>
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
</body>
<script src="jquery.min.js"></script>
    <script src="ddtf.js"></script>
    <script>
        $('#version-data').ddTableFilter();
    </script>

</html>