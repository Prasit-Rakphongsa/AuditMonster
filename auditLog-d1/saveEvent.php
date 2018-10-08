<?php
     $eventcode=$_POST['eventcode'];
    $subcode=$_POST['subcode'];
     $nameEng=$_POST['nameEng'];
   $nameTH=$_POST['nameTH'];
    $des=$_POST['des'];
    $PRM=$_POST['PRM'];
    $GL=$_POST['GL'];
   $EDW=$_POST['EDW'];
   $endpoint=$_POST['endpoints'];
    $username=$_POST['username'];
    $userdes=$_POST['userdes'];
    
	require_once"connect.php";
    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
	if($con){
	    
	    $s=$con->prepare("SELECT event_code from event WHERE event_code='$eventcode'&& sub_event_code='$subcode'");
   $s->execute();
   $s->store_result();
   if($s->num_rows>0){
        echo "<script>
		 alert('Failed to save event (This event code and sub event code already existed). Please try again.');
		 window.location.href='AddEvent.php';
		 </script>";
   }
   else{
	$sql = 'INSERT INTO event(event_code,sub_event_code,event_name_en,event_name_th,description,send_to_prm,send_to_gl,send_to_edw,endpoints) values('.$eventcode.',"'.$subcode.'","'.$nameEng.'","'.$nameTH.'","'.$des.'","'.$PRM.'","'.$GL.'","'.$EDW.'","'.$endpoints.'");';
	
	$sql3=$con->prepare("select distinct idHistory from History;");
	$sql3->execute();
	$sql3->store_result();
	$idHistory=$sql3->num_rows;
	
	$updatedString = "".$eventcode." was added";
	
    $sql2="INSERT INTO History(idHistory,name,timestamp,description,request,query,updated) values('$idHistory','$username',CURRENT_TIMESTAMP(),'$userdes','Add Event','$sql','$updatedString')";

	 if(mysqli_query($con, $sql) && mysqli_query($con, $sql2) ){
		 echo "<script>
		 alert('Event saved successfully.');
		 window.location.href='AddEvent.php';
		 </script>";
	 }else{
	     echo "<script>
		 alert('Failed to save event. Please try again.');
		 window.location.href='AddEvent.php';
		 </script>";
	 }
	}
	}else{
		echo "<script>
		 alert('Server unavailable. Please try again.');
		 window.location.href='AddEvent.php';
		 </script>";
	}
		
    mysqli_close($con);
    
	
?>