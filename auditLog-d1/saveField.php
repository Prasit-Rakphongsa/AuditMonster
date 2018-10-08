<?php
    $fieldname=$_POST['fieldname'];
    $type=$_POST['type'];
    $length=$_POST['length'];
    $decimal=$_POST['decimal'];
    $thai=$_POST['thai'];
    $description=$_POST['description'];
    $sample=$_POST['sample'];
    $remarks=$_POST['remarks'];
    $generatedBy = $_POST['gen'];
    $EDW = $_POST['EDW'];
    
    $username=$_POST['username'];
    $userdes=$_POST['userdes'];
    
	require_once"connect.php";
    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
	if($con){
	    
	     $s=$con->prepare("SELECT field_id from field WHERE field_name='$fieldname'");
   $s->execute();
   $s->store_result();
   if($s->num_rows>0){
        echo "<script>
		 alert('Failed to save field (This field already existed). Please try again.');
		 window.location.href='AddField.php';
		 </script>";
   }
   else{
			
// 	$sql="INSERT INTO field(field_name,type,length,decimal_point,thai_char,description,sample_data,remarks,generated_by,send_to_edw) values('$fieldname','$type','$length','$decimal','$thai','$description','$sample','$remarks','$generatedBy','$EDW')";
    $sql = 'INSERT INTO field(field_name,type,length,decimal_point,thai_char,description,sample_data,remarks,generated_by,send_to_edw) values("'.$fieldname.'","'.$type.'","'.$length.'","'.$decimal.'","'.$thai.'","'.$description.'","'.$sample.'","'.$remarks.'","'.$generatedBy.'","'.$EDW.'")';
	
	$sql3=$con->prepare("select distinct idHistory from History;");
	$sql3->execute();
	$sql3->store_result();
	$idHistory=$sql3->num_rows;
	
	$updatedString = "".$fieldname." was added";
	
    $sql2="INSERT INTO History(idHistory,name,timestamp,description,request,query,updated) values('$idHistory','$username',CURRENT_TIMESTAMP(),'$userdes','Add Field','$sql','$updatedString')";
	
// 	$sql2="INSERT INTO History(name,timestemp,description) values('$username',CURRENT_TIMESTAMP(),'$userdes')";
	
	 if( mysqli_query($con, $sql)&&mysqli_query($con, $sql2)){
		 echo "<script>
		 alert('Saved successfully.');
		 window.location.href='AddField.php';
		 </script>";
	 }else{
	     echo "<script>
		 alert('System failed. Please try again.');
		 window.location.href='AddField.php';
		 </script>";
	 }
	}
	}else{
		echo "<script>
		 alert('Server unavailable. Please try again.');
		 window.location.href='AddField.php';
		 </script>";}
		
    mysqli_close($con);
    
	
?>