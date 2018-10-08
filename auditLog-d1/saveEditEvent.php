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
    $oldEventCode=$_POST['oldEventCode'];
    $oldSubEventCode=$_POST['oldSubEventCode'];
    
	require_once"connect.php";
    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
	if($con){
	     // update array
	    $update=array();
	    // reteive old data
	    $store= array();
	 $sql=$GLOBALS['con']->query("SELECT * from event WHERE event_code='$eventcode' and sub_event_code='$subcode'");
      while($row = mysqli_fetch_array($sql)){
              array_push($store,$row);
      }
      //print_r($store[0][1]);
      // check updating database
      $count=0;
      if(strcmp($store[0][0],$eventcode)!=0){
          array_push($update,"Event code: ".$store[0][0]." => $eventcode, ");
        //   print_r($update[$count]);
          ++$count;
          //echo("equal");
      }
      if(strcmp($store[0][1],$subcode)!=0){
          array_push($update,"Sub event code: ".$store[0][1]." => $subcode, ");
        //   print_r($update[$count]);
          ++$count;
      }
      if(strcmp($store[0][2],$nameEng)!=0){
          array_push($update,"Event name(EN): ".$store[0][2]." => $nameEng, ");
        //   print_r($update[$count]);
          ++$count;
      }
      if(strcmp($store[0][3],$nameTH)!=0){
          array_push($update,"Event name(TH): ".$store[0][3]." => $nameTH, ");
        //   print_r($update[$count]);
          ++$count;
      }
      if(strcmp($store[0][4],$des)!=0){
          $represent;
          if(strcmp($store[0][4],"")==0){
              $store[0][4]="(null)";
          }if(strcmp($des,"")==0){
              $represent="(null)";
          }else{
              $represent=$des;
          }
          
              array_push($update,"Description: ".$store[0][4]." => $represent, ");
            //   print_r($update[$count]);
              ++$count;
      }
       if(strcmp($store[0][5],$PRM)!=0){
          array_push($update,"Send to PRM: ".$store[0][5]." => $PRM, ");
        //   print_r($update[$count]);
          ++$count;
      }
       if(strcmp($store[0][6],$GL)!=0){
          array_push($update,"Send to GL: ".$store[0][6]." => $GL, ");
        //   print_r($update[$count]);
          ++$count;
      }
       if(strcmp($store[0][7],$EDW)!=0){
          array_push($update,"Send to EDW: ".$store[0][7]." => $EDW, ");
        //   print_r($update[$count]);
          ++$count;
      }
       if(strcmp($store[0][8],$endpoint)!=0){
           $represent2;
            if(strcmp($store[0][8],"")==0){
              $store[0][8]="(null)";
          }if(strcmp($endpoint,"")==0){
              $represent2="(null)";
          }else{
              $represent2=$endpoint;
          }
          
          array_push($update,"Endpoint: ".$store[0][8]." => $represent2, ");
        //   print_r($update[$count]);
      }

    //combine updated
    $CombineUpdate="";
    $saveUpdated=0;
    while($count>=0){
        $CombineUpdate.=$update[$saveUpdated];
        $saveUpdated++;
        $count--;
    }
    //echo(".....".$CombineUpdate);
    
    $sql3=$con->prepare("select distinct idHistory from History;");
	$sql3->execute();
	$sql3->store_result();
	$idHistory =(int)$sql3->num_rows;
	$sql = 'UPDATE event SET event_code = '.$eventcode.', sub_event_code = "'.$subcode.'", event_name_en = "'.$nameEng.'", event_name_th = "'.$nameTH.'", description = "'.$des.'", send_to_prm = "'.$PRM.'", send_to_gl = "'.$GL.'", send_to_edw = "'.$EDW.'", endpoints = "'.$endpoint.'" where event_code = '.$oldEventCode.' AND sub_event_code = "'.$oldSubEventCode.'";';
	
    $sql2="INSERT INTO History(idHistory,name,timestamp,description,request,query,updated) values('$idHistory','$username',CURRENT_TIMESTAMP(),'$userdes','Edit Event','$sql','$CombineUpdate')";

	 if(mysqli_query($con, $sql)&&mysqli_query($con,$sql2)){
		 echo "<script>
		 alert('Event edited successfully.');
		 window.location.href='EventSum.php';
		 </script>";
	 }else{
	     echo "<script>
		 alert('Failed to edit event. Please try again.');
		 window.location.href='EventSum.php';
		 </script>";
	 }  
	} else{
		echo "<script>
		 alert('Failed to connect database. Please try again.');
		 window.location.href='EventSum.php';
		 </script>";
	} 

    mysqli_close($con);
    
	
?>