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
                    <li style="background-color:#B480C2;">Tutorial</li>
                    <li onclick="location.href='DebugMode.php';">Debug Mode</li>
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
                            <li><a href="#create-new-event">Creating a new event</a></li>
                            <li><a href="#create-new-field">Creating a new field</a></li>
                            <li><a href="#edit-event">Editing an event</a></li>
                            <li><a href="#edit-field">Editing a field</a></li>
                            <li><a href="#delete-event">Deleting an event</a></li>
                            <li><a href="#delete-field">Deleting a field</a></li>
                            <li><a href="#edit-relation">Editing events-fields relation by importing an excel file</a></li>
                            <li><a href="#version-control-popup">Confirmation popup for version control</a></li>
                            <li><a href="#debug-mode">Debug Mode Page</a></li>
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
                            <li><a href="#edit-event">Edit Event</a> button</li>
                        </ul>
                        <strong>Note </strong><p>To edit an event's field mapping, import the field mapping in <a href=import.php>Import & Export.</a></p>
                        </br >
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Event Details page-->
             <div id="page-eventdetail" class="tutorial-content">
                <span class="tutorial-content-box"></span>
                <span class="tutorial-content-text">
                    <h2>Event Details page</h2>
                    <p>Event Detail page shows an event's details and its field mapping.</p>
                    <p>Click on <a href="#edit-event">Edit Event</a> button to enter edit mode.</p>
                    <strong>Note </strong><p>To edit an event's field mapping, import the field mapping in <a href=import.php>Import & Export.</a></p>
                    </br >
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
                            <li><a href="#edit-field">Edit Field</a> button</li>
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
                        <p>Click on <a href="#edit-field">Edit Field</a> button to enter edit mode.</p>
                        <strong>Note </strong><p>To edit an event's field mapping, import the field mapping in <a href=import.php>Import & Export.</a></p>
                        </br >
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Create new event-->
                <div id="create-new-event" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Creating a new event</h2>
                        <ol type="1">
                            <li><a href=AddEvent.php>Add new event</a> without mapping it to any fields yet
                                <ul>                            
                                    <li>If the event has multiple subevents, they will have to be added one by one</li>
                                </ul>
                            </li>
                            <li>For requirements that state to create new fields, proceed to <a href=AddField.php>Add Field page</a> to create new fields in the Field Dictionary</li>
                            <li>To map fields to events, import the relation as an excel file in <a href=import.php>Import & Export page</a>
                                <ul>
                                    <li>Be noted that if any event or field in your excel file has not been created in the system, importing will fail. Make sure every event and field in your excel file already existed in the system before importing.</li>
                                </ul>
                            </li>
                        </ol>
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Create new field-->
                <div id="create-new-field" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Creating a new field</h2>
                        To create a new field in the database: 
                        <ol type="1">
                            <li>Make sure the field you want to create hasn't already existed or has the same name as any field in the <a href=FieldDic.php>Field Dictionary</a></li>
                            <li>To create new fields, proceed to <a href=AddField.php>Add Field page</a> to create new fields in the Field Dictionary</li>
                            <li>To map fields to events, import the relation as an excel file in <a href=import.php>Import & Export page</a>
                                <ul>
                                    <li>Be noted that if any event or field in your excel file has not been created in the system, importing will fail. Make sure every event and field in your excel file already existed in the system before importing.</li>
                                </ul>
                            </li>
                        </ol>

                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Edit event-->
                <div id="edit-event" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Editing an event</h2>
                        <ol type="1">
                            <li>To edit an event's detail, click on it in <a href=EventSum.php>Events Summary page</a> to enter <a href="#page-eventdetail">Event Details page</a>. You will see its <strong>Edit</strong> button to enter edit mode.
                                <ul>
                                    <li>Be noted that if you want to edit an event's relation/mapping with fields then you will have to import an excel file in <a href=import.php>Import & Export page</a>.</li>
                                </ul>
                            </li>
                        </ol>
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!----Edit field-->
                <div id="edit-field" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Editing a field</h2>
                        <ol type="1">
                            <li>To edit a field, click on it in <a href=FieldDic.php>Field Dictionary page</a> to enter <a href="#page-fielddetail">Field Details page</a>. You will see its <strong>Edit</strong> button to enter edit mode.
                                <ul>
                                    <li>Be noted that if you want to edit an event's relation/mapping with fields then you will have to import an excel file in <a href=import.php>Import & Export page</a>.</li>
                                </ul>
                            </li>
                        </ol>
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Delete event-->
                <div id="delete-event" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Deleting an event</h2>
                        <span>Coming soon.</span>
                        </br >
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Delete field-->
                <div id="delete-field" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Delete a field</h2>
                        <span>Coming soon.</span>
                        </br >
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Edit event-field relation-->
                <div id="edit-relation" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Editing events-fields relation</h2>
                        <ol type="1">
                            <li>Be noted that if any event or field in your excel file has not been created in the system, importing will fail. Make sure every event and field in your excel file already existed in the system before importing</li>
                            <li>Go to <a href=import.php>Import & Export page</a></li>
                            <li>Create an excel file by following the format described on the page or simply download a blank excel file with correct format we have prepared on the page</li>
                            <li>Fill the excel file according to the format and re-upload (both .xls and .xlsx are supported) in <a href=import.php>Import & Export page</a></li>
                        </ol>
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
            <!--Confirmation popup-->
                <div id="version-control-popup" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Confirmation popup for version control</h2>
                        <ol type="1">
                            <li>Name (Required) example: Boonsita V.</li>
                            <li>JIRA task (Optional) - the JIRA task that prompted the update of Audit Log</li>
                            <li>Description (Required) - brief details of update</li>
                            <ul style="list-style-type:none">
                                <li>Examples of how to write description
                                    <ul>
                                        <li>AD-5939: Update mapping field for CARD_SUB_TYPE_OLD to optional for event code 424 and 425</li>
                                        <li>Add new event code 172: ETB ONLINE ACCOUNT OPENING</li>
                                        <li>Update field length for the field FUND_CODE from 6 to 15</li>
                                    </ul>
                                </li>
                            </ul>
                        </ol>
                        <span class="tutorial-content-back"> <a href="#table-of-contents">back to top</a></span>
                    </span>
                </div>
             <!--Debug Mode-->
                <div id="debug-mode" class="tutorial-content">
                    <span class="tutorial-content-box"></span>
                    <span class="tutorial-content-text">
                        <h2>Debug Mode Page</h2>
                        <span><a href="DebugMode.php">Debug Mode page</a> shows a record of actions done to the audit log database.</span>
                        </br >
                        <strong>Definition of each column in Debug Mode</strong>
                        <ul>
                            <li><strong>Version ID</strong> - The versionID you see here is the same as the one in <a href="version-control.php">Version Control page</a></li>
                            <li><strong>Description</strong> - Action done by user</li>
                            <li><strong>Timestamp</strong> - Date and time when the action was done</li>
                            <li><strong>Editor</strong> - User's name</li>
                            <li><strong>Request</strong> - Function used by user</li>
                            <li><strong>Command</strong> - SQL command generated by action of user</li>
                            <li><strong>Update</strong> - Changes caused by action of user</li>
                        </ul>
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
                            <li>Enter edit mode</li>
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