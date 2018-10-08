<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="mystyle.css">
    <link rel="shortcut icon" href="./images/LogoS.ico">
    <link href="https://fonts.googleapis.com/css?family=Athiti|Hind" rel="stylesheet">
    <title>Audit Log - Add Field</title>
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
                    <li style="background-color:#B480C2;">Add Field</li>
                    <li onclick="location.href='import.php';">Import & Export</li>
                    <li onclick="location.href='version-control.php';">Version Control</li>
                    <li onclick="location.href='TutorialPage.php';">Tutorial</li>
                    <li onclick="location.href='DebugMode.php';">Debug Mode</li>
                </ul>
            </div>
            <div class="content">
                <div class="create-display">
                    <form name="addField" action="saveField.php" onsubmit="return validateForm()" method="post">
                        <h2>Add Field</h2>
                        <table>
                            <tr>
                                <td class="label">Field name
                                    <span class="required">* </span>
                                </td>
                                <td>
                                    <input type="text" name="fieldname">
                                    <span id="fieldName-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Type
                                    <span class="required">* </span>
                                </td>
                                <td>
                                    <!--<input type="text" name="type">-->
                                    <select>
                                      <option value="VARCHAR">VARCHAR</option>
                                      <option value="INTEGER">INTEGER</option>
                                      <option value="STRING">STRING</option>
                                      <option value="DATETIME">DATETIME</option>
                                      <option value="DATE">DATE</option>
                                      <option value="DECIMAL">DECIMAL</option>
                                      <option value="DECIMAL(7,2)">DECIMAL(7,2)</option>
                                      <option value="DECIMAL(15,2)">DECIMAL(15,2)</option>
                                      <option value="DECIMAL(21,2)">DECIMAL(21,2)</option>
                                      <option value="DECIMAL(21,4)">DECIMAL(21,4)</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Length
                                    <span class="required">* </span>
                                </td>
                                <td>
                                    <input type="text" name="length">
                                    <span id="length-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Decimal Point</td>
                                <td>
                                    <input type="text" name="decimal">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Thai Character</td>
                                <td>
                                    <input type="radio" class="radio" name="thai" value="Y">Allowed
                                    <input type="radio" class="radio" name="thai" value="N">Not Allowed</td>
                            </tr>
                            <tr>
                                <td class="label">Description</td>
                                <td>
                                    <textarea cols="50" rows="5" name="description" class="text-area"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Sample Data</td>
                                <td>
                                    <textarea cols="50" rows="5" name="sample" class="text-area"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Remarks</td>
                                <td>
                                    <textarea cols="50" rows="5" name="remarks" class="text-area"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Generated by
                                    <span class="required">* </span>
                                </td>
                                <td>
                                    <input type="radio" class="radio" name="gen" value="S"> System</br>
                                    <input type="radio" class="radio" name="gen" value="U"> User's Input</br>
                                    <input type="radio" class="radio" name="gen" value="F"> Other Field's Value
                                    <span> example: &lt;DEVICE_ID&gt;</span>
                                    <span id="gen-error" class="required"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Send to EDW
                                    <span class="required">* </span>
                                </td>
                                <td>
                                    <input type="radio" class="radio" name="EDW" value="Y"> Yes
                                    <input type="radio" class="radio" name="EDW" value="N"> No
                                    <span id="EDW-error" class="required"></span>
                                </td>
                                </td>
                                </td>
                            </tr>
                        </table>
                        <a href="#confirm" class="btn">Submit</a>
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
            var fieldName = document.forms["addField"]["fieldname"].value;
            var type = document.forms["addField"]["type"].value;
            var length=document.forms["addField"]["length"].value;
            var gen = document.forms["addField"]["gen"].value;
            // var generatorValue = document.forms["addField"]["generator-value"].value.trim();
            var EDW = document.forms["addField"]["EDW"].value;
            var username = document.forms["addField"]["username"].value;
            var userdes = document.forms["addField"]["userdes"].value;
            if (fieldName == "" || !(/^[A-Z_0-9]+$/.test(fieldName))) {
                document.forms["addField"]["fieldname"].style.backgroundColor = "lightpink";
                document.forms["addField"]["fieldname"].style.borderColor = "lightcoral";
                document.getElementById("fieldName-error").innerHTML = "  Only capital letters(A-Z), numbers(0-9) and underscore(_) are allowed.";
                contentStatus = false;
            } else {
                document.forms["addField"]["fieldname"].style.backgroundColor = "white";
                document.forms["addField"]["fieldname"].style.borderColor = "initial";
            }
            if (type == "" || !(/^[A-Za-z(,)]+$/.test(type))) {
                document.forms["addField"]["type"].style.backgroundColor = "lightpink";
                document.forms["addField"]["type"].style.borderColor = "lightcoral";
                contentStatus = false;
            } else {
                document.forms["addField"]["type"].style.backgroundColor = "white";
                document.forms["addField"]["type"].style.borderColor = "initial";
            }
            if (length == ""||!(/^[0-9]+$/.test(length))) {
                document.forms["addField"]["length"].style.backgroundColor = "lightpink";
                document.forms["addField"]["length"].style.borderColor = "lightcoral";
                document.getElementById("length-error").innerHTML = "  Only numbers(0-9) are allowed.";
                popupStatus = false;
            } else {
                document.forms["addField"]["length"].style.backgroundColor = "white";
                document.forms["addField"]["length"].style.borderColor = "initial";
            }
            if (username == "") {
                document.forms["addField"]["username"].style.backgroundColor = "lightpink";
                document.forms["addField"]["username"].style.borderColor = "lightcoral";
                popupStatus = false;
            } else {
                document.forms["addField"]["username"].style.backgroundColor = "white";
                document.forms["addField"]["username"].style.borderColor = "initial";
            }
            if (userdes == "") {
                document.forms["addField"]["userdes"].style.backgroundColor = "lightpink";
                document.forms["addField"]["userdes"].style.borderColor = "lightcoral";
                popupStatus = false;
            } else {
                document.forms["addField"]["userdes"].style.backgroundColor = "white";
                document.forms["addField"]["userdes"].style.borderColor = "initial";

            }
            if (EDW == "") {
                document.getElementById("EDW-error").innerHTML = "  Please select Yes or No";
                contentStatus = false;
            } else {
                document.getElementById("EDW-error").innerHTML = "";
            }
            if (gen == "") {
                document.getElementById("gen-error").innerHTML = " Please select System, User's Input or Other Field's Value";
                contentStatus = false;
            // } else if ((gen == "W" && generatorValue == "") || (gen == "W" && (!(/^[<]$/.test(generatorValue.substring(0,1))) || !(/^[>]$/.test(generatorValue.substring(generatorValue.length-1,generatorValue.length))) || !(/^[.A-Z0-9]+$/.test(generatorValue.substring(1,generatorValue.length-1)))))) {
            //     document.getElementById("gen-error").innerHTML = " Please enter this field";
            //     status = false;
            } else {
                document.getElementById("gen-error").innerHTML = "";
            }
            if(contentStatus == false){
                window.location.href = 'AddField.php#';
            }else{
                window.location.href = 'AddField.php#confirm';
            }
            return contentStatus && popupStatus;
        }
    </script>
</body>

</html>