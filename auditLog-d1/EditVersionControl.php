<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Edit Version Control</title>
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
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                    <li onclick="location.href='DebugMode.php';">Debug Mode</li>
                </ul>
            </div>
            <div class="content">
                <div class="create-display" style="text-align : center">
                <?php
                    $versionId = $_POST['versionId'];
                    $oldTimeStemp = $_POST['oldTimeStemp'];
                    require_once"connect.php";
                    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
                    //echo $oldTimeStemp;
                 	$mysql_qry = 'select * from History where idHistory = '.$versionId.' and timestamp = "'.$oldTimeStemp.'";';
                    $result = mysqli_query($con ,$mysql_qry);
                    $versionDetail = array();
                    while($row = mysqli_fetch_array($result)) {
                         array_push($versionDetail,$row);
                    }
                    echo '<div class=page-header-area>';
                    echo '<h2 style="display: inline-block;">Edit Version Control</h2>';
                    echo '</div>';
                    echo '<div>VersionId : '.$versionDetail[0]["idHistory"].'</div>';
                    echo '<div>Editor : '.$versionDetail[0]["name"].'</div>';
                    echo '<div>Timestamp : '.$versionDetail[0]["timestamp"].'</div>';
                    echo '<div>Description : '.$versionDetail[0]["description"].'</div>';
                    echo '<div>';
                    echo '<form name="editVersionControl" action="saveEditVersionControl.php" onsubmit="return validateForm()" method="POST">
                        <input type="hidden" name="versionId" value="'.$versionId.'">
                        <input type="hidden" name="oldDes" value="'.$versionDetail[0]["description"].'">
                        <input type="hidden" name="oldTime" value="'.$versionDetail[0]["timestamp"].'">
                        <table style="margin : 50px auto 10px auto">
                            <tr>
                                <td class="label">
                                    Description
                                    <span class="required"> *</span></td>
                                <td>
                                    <textarea cols="50" rows="5" name="des" class="text-area">'.$versionDetail[0]["description"].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Editor
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="text" name="editor" value="'.$versionDetail[0]["name"].'">
                                </td>
                            </tr>
                        </table>
                        <input id="confirm-button" type="submit" value="Submit">
                    </form></div>';
                ?>
                </div>
            </div>
        </div>
        <script>
        function validateForm() {
            var status = true;
            var versionId = document.forms["editVersionControl"]["versionId"].value;
            var des = document.forms["editVersionControl"]["des"].value;
            var editor = document.forms["editVersionControl"]["editor"].value;
            if (des == "") {
                document.forms["editVersionControl"]["des"].style.backgroundColor = "lightpink";
                document.forms["editVersionControl"]["des"].style.borderColor = "lightcoral";
                status = false;
            } else {
                document.forms["editVersionControl"]["des"]
                document.forms["editVersionControl"]["des"]
            }
            if (editor == "") {
                document.forms["editVersionControl"]["editor"].style.backgroundColor = "lightpink";
                document.forms["editVersionControl"]["editor"].style.borderColor = "lightcoral";
                status = false;
            } else {
                document.forms["editVersionControl"]["editor"]
                document.forms["editVersionControl"]["editor"]
            }
            return status;
        }
    </script>
</body>

</html>