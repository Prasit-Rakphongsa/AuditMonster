<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Audit Log - Export</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
</head>

<body>
    <div class="web-container">
        <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-read.png" alt="Audit Monster" height="40"></a>
        <div class="content-container2">
            <div class="sidebar">
                <ul class="menu-bar">
                    <li onclick="location.href='EventSum.php'">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                    <li style="background-color:#B480C2;">Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                </ul>
            </div>
            <div class="exportContent">
                <div class="import-export-outer-container">
                        <div class="import-export-container">
                            <div class="content-box">
                                <h2>Export File</h2>
                                <form id="audio_form" action="export-excel.php">
                                    <input type="submit" value="xlsx" class="import-export-btn">
                                </form>
                                <form action="export-csv.php">
                                    <input type="submit" value="csv" class="import-export-btn">
                                </form>
                                <form action="export-txt.php">
                                    <input type="submit" value="txt" class="import-export-btn">
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>