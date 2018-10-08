<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Tutorial</title>
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
                    <li style="background-color:#B480C2;">Tutorial</li>
                </ul>
            </div>
            <div class="content" style="background-color:#f1f1f1">
                <!--Table of contents-->
                    <div id="table-of-contents" class="tutorial-content">
                        <span class="tutorial-content-box"></span>
                        <span class="tutorial-table-of-content">
                            <h2>Table of Contents</h2>
                            <ol>
                                <li><a href="#page-eventsum">Event Summary Page</a></li>
                                <li><a href="#page-eventdetail">Event Details page</a></li>
                                <li><a href="#page-fielddic">Field Dictionary page</a></li>
                                <li><a href="#page-fielddetail">Field Detail page</a></li>
                                <li><a href="#page-export">Export page</a></li>
                                <li><a href="#page-version-control">Version Control Page</a></li>
                            </ol>
                        </span>
                    </div>
                <!--Event Summary page-->
                     <div id="page-eventsum" class="tutorial-content">
                        <span class="tutorial-content-box"></span>
                        <span class="tutorial-content-text">
                            <h2>Event Summary Page</h2>
                            <p><a href=EventSum.php>Event Summary page</a> shows all existing events in the audit log.</p>
                            <p>Click on an event to view:</p>
                            <ul>
                                <li>Event details</li>
                                <li>All fields used by this event</li>
                            </ul>
                            <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                        </span>
                    </div>
                <!--Event Details page-->
                 <div id="page-eventdetail" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Event Details page</h2>
                        <p>Event Detail page shows an event's details and its field mapping.</p>
                        <p>You can export all events and fields in <a href=Export.php>Export page</a>.</p>
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
                <!--Field Dictionary page-->
                     <div id="page-fielddic" class="tutorial-content">
                        <span class="tutorial-content-box"></span>
                        <span class="tutorial-content-text">
                            <h2>Field Dictionary Page</h2>
                            <p><a href=FieldDic.php>Field Dictionary page</a> shows all existing fields in the audit log.</p>
                            <p>Click on a field to view:</p>
                            <ul>
                                <li>Field details</li>
                                <li>All events that contain this field</li>
                            </ul>
                            <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                        </span>
                    </div>
                <!--Field Details page-->
                     <div id="page-fielddetail" class="tutorial-content">
                        <span class="tutorial-content-box"></span>
                        <span class="tutorial-content-text">
                            <h2>Field Details page</h2>
                            <p>Field Detail page shows a field's details and all correlated events.</p>
                            <p>You can export all events and fields in <a href=Export.php>Export page</a>.</p>
                            <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                        </span>
                    </div>
                <!-- Export page     -->
                    <div id="page-export" class="tutorial-content">
                        <span class="tutorial-content-box"></span>
                        <span class="tutorial-content-text">
                            <h2>Export Page</h2>
                            <p><a href=Export.php>Export page</a> lets you export the Audit Log in diffrent types of files.</p>
                            <strong>Note</strong>
                            <p>If you choose to export .csv file, please use notepad-style programs to open it. Using excel to open it will result in corruption of data due to excel moving cells to replace null fields.</p>
                            </br >
                            <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                        </span>
                    </div>
                <!--Version Control-->
                    <div id="page-version-control" class="tutorial-content">
                        <span class="tutorial-content-box"></span>
                        <span class="tutorial-content-text">
                            <h2>Version Control Page</h2>
                            <p><a href="version-control.php">Version Control page</a> records all the action done to the Audit Log. All records you see will be of the release you are currently in.</p>
                            <p>Click on a record to: </p>
                            <ul>
                                <li>View history of that version control record</li>
                            </ul>
                            <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                        </span>
                    </div>
                    
                <!--End of tutorials    -->
                    
                </div>
        </div>
    </div>
</body>

</html>