<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Add Event</title>
</head>

<body>
    <div class="web-container">
        <a id="logo-monster" href="EventSum.php"><img src="images/logo-monster-admin.png" alt="Audit Monster" height="40"></a>
        <div class="content-container">
            <div class="sidebar">
                <ul>
                    <li onclick="location.href='EventSum.php';">Event Summary</li>
                    <li onclick="location.href='FieldDic.php';">Field Dictionary</li>
                    <li style="background-color:#B480C2;">Add Event</li>
                    <li onclick="location.href='AddField.php';">Add Field</li>
                    <li onclick="location.href='import.php';">Import & Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                    <li onclick="location.href='DebugMode.php';">Debug Mode</li>
                </ul>
            </div>
            <div class="content">
                <div class="create-display">
                    <form name="addEvent" action="saveEvent.php" onsubmit="return validateForm()" method="POST">
                        <h2>Add Event</h2>
                        <table>
                            <tr>
                                <td class="label">
                                    Event code
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input id="eventCode" type="number" name="eventcode">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Sub event code
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="text" name="subcode">
                                    <span id="subEventCode-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Event name(ENG)
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="text" name="nameEng">
                                    <span id="eventNameEng-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Event name(TH)
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="text" name="nameTH">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Description </td>
                                <td>
                                    <textarea cols="50" rows="5" name="des" class="text-area"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Send to PRM
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="radio" class="radio" name="PRM" value="Y">Yes
                                    <input type="radio" class="radio" name="PRM" value="N">No
                                    <span id="PRM-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Send to GL
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="radio" class="radio" name="GL" value="Y">Yes
                                    <input type="radio" class="radio" name="GL" value="N">No
                                    <span id="GL-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    Send to EDW
                                    <span class="required"> *</span>
                                </td>
                                <td>
                                    <input type="radio" class="radio" name="EDW" value="Y">Yes
                                    <input type="radio" class="radio" name="EDW" value="N">No
                                    <span id="EDW-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Endpoints </td>
                                <td>
                                    <textarea cols="50" rows="5" name="endpoints" class="text-area"></textarea>
                                </td>
                            </tr>
                        </table>
                        <div>
                            <a href="#confirm" class="btn">Submit</a>
                        </div>

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
                                <button id="confirm-button" type="submit">Confirm</button>
                                <a href="#" class="btn">Cancel</a>
                            </div>
                        </div>
                        <a href="#" class="close-popup"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var contentStatus = true;
            var popupStatus = true;
            var eventCode = document.forms["addEvent"]["eventcode"].value;
            var subEventCode = document.forms["addEvent"]["subcode"].value.trim();
            var nameEng = document.forms["addEvent"]["nameEng"].value.trim();
            var nameTH = document.forms["addEvent"]["nameTH"].value.trim();
            var PRM = document.forms["addEvent"]["PRM"].value.trim();
            var GL = document.forms["addEvent"]["GL"].value.trim();
            var EDW = document.forms["addEvent"]["EDW"].value.trim();
            var username = document.forms["addEvent"]["username"].value;
            var userdes = document.forms["addEvent"]["userdes"].value;
            if (eventCode == ""|| !(/^[0-9]+$/.test(eventCode))) {
                document.forms["addEvent"]["eventcode"].style.backgroundColor = "lightpink";
                document.forms["addEvent"]["eventcode"].style.borderColor = "lightcoral";
                contentStatus = false;
            } else {
                document.forms["addEvent"]["eventcode"].style.backgroundColor = "white";
                document.forms["addEvent"]["eventcode"].style.borderColor = "initial";
            }
            if (subEventCode == "" || !(/^[A-Z0-9]+$/.test(subEventCode))) {
                document.getElementById("subEventCode-error").innerHTML = "  Only number(0-9) and capital letters(A-Z) are allowed"
                document.forms["addEvent"]["subcode"].style.backgroundColor = "lightpink";
                document.forms["addEvent"]["subcode"].style.borderColor = "lightcoral";
                contentStatus = false;
            } else {
                document.forms["addEvent"]["subcode"].style.backgroundColor = "white";
                document.forms["addEvent"]["subcode"].style.borderColor = "initial";
            }
            if (nameEng == "" || !(/^[A-Za-z\s]+$/.test(nameEng))) {
                document.getElementById("eventNameEng-error").innerHTML = "  Only capital letters(A-Z) are allowed"
                document.forms["addEvent"]["nameEng"].style.backgroundColor = "lightpink";
                document.forms["addEvent"]["nameEng"].style.borderColor = "lightcoral";
                contentStatus = false;
            } else {
                document.forms["addEvent"]["nameEng"].style.backgroundColor = "white";
                document.forms["addEvent"]["nameEng"].style.borderColor = "initial";

            }
            if (nameTH == "") {
                document.forms["addEvent"]["nameTH"].style.backgroundColor = "lightpink";
                document.forms["addEvent"]["nameTH"].style.borderColor = "lightcoral";
                contentStatus = false;
            } else {
                document.forms["addEvent"]["nameTH"].style.backgroundColor = "white";
                document.forms["addEvent"]["nameTH"].style.borderColor = "initial";

            }
            if (PRM == "") {
                document.getElementById("PRM-error").innerHTML = "  Please select Yes or No"
                contentStatus = false;
            } else {
                document.getElementById("PRM-error").innerHTML = ""

            }
            if (GL == "") {
                document.getElementById("GL-error").innerHTML = "  Please select Yes or No"
                contentStatus = false;
            } else {
                document.getElementById("GL-error").innerHTML = ""

            }
            if (EDW == "") {
                document.getElementById("EDW-error").innerHTML = "  Please select Yes or No"
                contentStatus = false;
            } else {
                document.getElementById("EDW-error").innerHTML = ""

            }
            if (username == "") {
                document.forms["addEvent"]["username"].style.backgroundColor = "lightpink";
                document.forms["addEvent"]["username"].style.borderColor = "lightcoral";
                popupStatus = false;
            } else {
                document.forms["addEvent"]["username"].style.backgroundColor = "white";
                document.forms["addEvent"]["username"].style.borderColor = "initial";

            }
            if (userdes == "") {
                document.forms["addEvent"]["userdes"].style.backgroundColor = "lightpink";
                document.forms["addEvent"]["userdes"].style.borderColor = "lightcoral";
                popupStatus = false;
            } else {
                document.forms["addEvent"]["userdes"].style.backgroundColor = "white";
                document.forms["addEvent"]["userdes"].style.borderColor = "initial";

            }
            if(contentStatus == false){
                window.location.href = 'AddEvent.php#';
            }else{
                window.location.href = 'AddEvent.php#confirm';
            }
            return contentStatus && popupStatus;
        }
    </script>
</body>

</html>