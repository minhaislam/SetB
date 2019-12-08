<?php
	function getConnection(){
		$conn = mysqli_connect('localhost', 'root', '', 'jobportal');
		return $conn;
	}
?>