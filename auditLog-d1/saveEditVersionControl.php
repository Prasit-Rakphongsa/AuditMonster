<?php
    $versionId = $_POST['versionId'];
    $oldDes = $_POST['oldDes'];
    $des = $_POST['des'];
    $editor = $_POST['editor'];
    
	require_once"connect.php";
    $con=new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_name);
	if($con){
			
// 	$sql = 'update History set description="'.$des.'",timestemp = CURRENT_TIMESTAMP(), name = "'.$editor.'" where idHistory = '.$versionId;
    // $sql = "INSERT INTO History(idHistory,name,timestemp,description,request,query,updated) values('$versionId','$editor',CURRENT_TIMESTAMP(),'$des','Edit Version Control',,'$updatedString')";
	$updatedString = "Version control description : ".$oldDes." => ".$des;
	$emptyString = "";
	$sql2="INSERT INTO History(idHistory,name,timestamp,description,request,query,updated) values('$versionId','$editor',CURRENT_TIMESTAMP(),'$des','Edit Version Control','$emptyString','$updatedString')";
	
	 if(mysqli_query($con, $sql2)){
		 echo "<script>
		 alert('Version control edited successfully.');
		 window.location.href='version-control.php';
		 </script>";
	 }else{
	     echo "<script>
		 alert('Failed to edit version control. Please try again.');
		 window.location.href='version-control.php';
		 </script>";
	 }
	}else{
		echo "<script>
		 alert('Failed to edit version control. Please try again.');
		 window.location.href='version-control.php';
		 </script>";
	}
		
    mysqli_close($con);
    
	
?>