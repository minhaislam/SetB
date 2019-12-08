<?php
	
	require_once('db.php');
	$term = $_POST['key'];
	$con = getConnection();
	$sql = "select * from elist where uname like '%{$term}%'";
	$result = mysqli_query($con, $sql);
	$row = "";
	while($data = mysqli_fetch_assoc($result)){
		$row .= $data['ename']."|".$data['cname']."|".$data['uname']."|".$data['pass']."|".$data['utype']."<br>";
	}
	echo $row;
	
?>