<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Audit Log - Import & Export</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
</head>

<body>
    <div class="web-container">
        <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-admin.png" alt="Audit Monster" height="40"></a>
        <div class="content-container2">
            <div class="sidebar">
                <ul class="menu-bar">
                    <li onclick="location.href='EventSum.php'">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                    <li onclick="location.href='AddEvent.php';">Add Event</li>
                    <li onclick="location.href='AddField.php';">Add Field</li>
                    <li style="background-color:#B480C2;">Import & Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                    <li onclick="location.href='DebugMode.php';">Debug Mode</li>
                </ul>
            </div>
            <div class="content">
                <h2>Import & Export</h2>
                <div class="import-export-outer-container">
                    <div class="import-export-content-container">
                        <div class="import-export-container">
                            <div class="content-box">
                                <h2>Import Excel File</h2>
                                <form name="sqlImport" action="SQLimport2.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                    <input type="file" name="file" id="inputFile">
                                    <!-- <input type="submit" name="upload" class="import-export-btn"> -->
                                    <a href="#confirm" class="import-export-btn">Submit</a>
                                    <h4>Please ensure that the excel file contains the same format as the example below</h4>
                                    <h4>or you can download it <a href="excel-pattern.xlsx">here</a></h4>
                                    <div id="confirm" class="popup">
                                        <div class="confirmation-message confirmation-message-header">
                                            <p>Confirmation</p>
                                        </div>
                                        <table class="version-control">
                                            <tr>
                                                <td class="label">
                                                    Name
                                                    <span class="required"> *</span>
                                                </td>
                                                <td>
                                                    <input type="text" id="name" name="username">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label">
                                                    Description
                                                    <span class="required"> *</span>
                                                </td>
                                                <td>
                                                    <textarea id="version-control-description" name="userdes" class="text-area"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="button-area">
                                            <input type="submit" id="confirm-button" name="upload" class="import-export-btn">
                                            <a href="#" class="btn">Cancel</a>
                                        </div>
                                    </div>
                                    <a href="#" class="close-popup"></a>
                                </form>
                            </div>
                        </div>
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
                <div class="import-export-outer-container">
                    <div>
                        <h2>Excel Format</h2>
                        <!--<h4>Please ensure that the excel file contains the same format as the example below or you can download
                            it
                            <a href="excel-pattern.xlsx">here</a>
                        </h4>-->
                        <img src="./images/ExcelTemplate.png" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var status = true;
            var username = document.forms["sqlImport"]["username"].value;
            var userdes = document.forms["sqlImport"]["userdes"].value;
            var file = document.getElementById("inputFile");
            if (file.files.item(0) == null) {
                alert("No file is chosen. Please select an excel file to upload.");
                status = false;
            } else {
                var type = file.files.item(0).name.split(".");
                if (type[1] == "xlsx" || type[1] == "xls") {
                    status = true;
                } else {
                    alert("Incorrect file type. Please select .xls or .xlsx file only.");
                    status = false;
                }
            }
            if (username == "") {
                document.forms["sqlImport"]["username"].style.backgroundColor = "lightpink";
                document.forms["sqlImport"]["username"].style.borderColor = "lightcoral";
                status = false;
            } else {
                document.forms["sqlImport"]["username"].style.backgroundColor = "white";
                document.forms["sqlImport"]["username"].style.borderColor = "initial";
            }
            if (userdes == "") {
                document.forms["sqlImport"]["userdes"].style.backgroundColor = "lightpink";
                document.forms["sqlImport"]["userdes"].style.borderColor = "lightcoral";
                status = false;
            } else {
                document.forms["sqlImport"]["userdes"].style.backgroundColor = "white";
                document.forms["sqlImport"]["userdes"].style.borderColor = "initial";

            }
            return status;
        }
    </script>
</body>

</html>