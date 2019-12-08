<?php
session_start();
		
		if(isset($_POST['Add'])){
		
		$uname = $_POST['uname'];
		$ename = $_POST['ename'];
		$pass = $_POST['pass'];
		$cname = $_POST['cname'];
		$cno = $_POST['cno'];
		$utype =$_POST["utype"];

		
		if(empty($uname)==true || empty($ename)==true || empty($pass) == true ||empty($cname) == true ||empty($cno) == true ||empty($utype) == true){
			echo "fill all!";
		}
		 else{
			if (checkUniqueValue($uname)) {
				echo "Sorry. This uname is already taken.";
				exit();
			}

	

           else{
            $conn=mysqli_connect('localhost','root','','jobportal');
			$sql="insert into elist(ename,cname,cno,uname,pass,utype) values('{$ename}','{$cname}','{$cno}','{$uname}','{$pass}','{$utype}')";
			$set=mysqli_query($conn,$sql);
		header('location: viewinfo.php');
		mysqli_close($conn);
				}
		}
}
elseif (isset($_POST['Update'])) {
			//header('location: AdminHome.php');
	$uname = $_POST['uname'];
		$ename = $_POST['ename'];
		$pass = $_POST['pass'];
		$cname = $_POST['cname'];
		$cno = $_POST['cno'];
		//$utype =$_POST["utype"];
		$eid =$_POST["eid"];

		
		if(empty($eid)==true){
			echo "ID required!";
		}
		 if (empty($uname)==false) 
		 	{
			if (checkUniqueValue($uname)) {
				echo "Sorry. This username is already taken.";
				exit();
			}


           else{
            $conn=mysqli_connect('localhost','root','','jobportal');
			$sql="update elist SET uname='{$uname}' where eid='{$eid}'";
			$set=mysqli_query($conn,$sql);
		header('location: viewinfo.php');
		mysqli_close($conn);
				}
		}

		 

           else{
            $conn=mysqli_connect('localhost','root','','jobportal');
			$sql="update elist SET ename='{$ename}' where eid='{$eid}'";
			$set=mysqli_query($conn,$sql);
		header('location: viewinfo.php');
		mysqli_close($conn);
				}
		}

		 if (empty($pass)==false) 
		 	{
          if($pass==$cpass){
            $conn=mysqli_connect('localhost','root','','jobportal');
			$sql="update elist SET pass='{$pass}' where eid='{$eid}'";
			$set=mysqli_query($conn,$sql);
		header('location: viewinfo.php');
		mysqli_close($conn);
				}
		}

	
	elseif (isset($_POST['Delete'])) {
		$eid2 =$_POST["eid2"];

		
		if(empty($eid2)==true){
			echo "ID required!";
		}
		else{
			$con=mysqli_connect('localhost','root','','jobportal');
			$sql="DELETE from elist where eid='{$eid2}'";
			$set=mysqli_query($con,$sql);
			header('location: viewinfo.php');
		mysqli_close($conn);
			
		}
		}
		if(isset($_GET['eid'])) { 
				$eid = $_GET['eid'];
				$_SESSION['eid']=$eid;
$con=mysqli_connect('localhost','root','','jobportal');
			$sql="DELETE from elist where eid='{$eid}'";
			$set=mysqli_query($con,$sql);
			header('location: viewinfo.php');
		mysqli_close($conn);
}


		
elseif (isset($_POST['Back'])) {
			header('location: AdminHome.php');
		}
		
	


		function checkUniqueValue($value){
				 $conn=mysqli_connect('localhost','root','','fwa');						

			$found = 0;
						$sql="select * from info where uname='{$value}' or email='{$value}'";
			$get=mysqli_query($conn,$sql);
			$user=mysqli_fetch_assoc($get);
						if($user["uname"] == $value){
							$found = 1;

						}
						if($user["email"] == $value){
							$found = 1;
						}
					
			return $found;
		}
		

		
		
if(isset($_COOKIE['uname'])){

?>



<!DOCTYPE html>
<html>
<head>
	<title>
		Info table
	</title>
</head>
<body>
	<table>
	<center>
	<tr>
						<td width="150px"><h2><i><font color="Red">Freelance</font></i></h2></td>
						<td  width="100px"><a href="profile.php">Profile</a></td>
						<td width="100px"><a href="viewinfo.php">View Info</a></td>
						<td width="100px"><a href="Pages/logout.php">Logout</a></td>
						<td width="100px"><a href="Jobreq.php">Job Requests</a></td>
						<td width="100px"><a href="FreelancerDetails.php">Freelancer Details</a></td>
						<td width="100px"><a href="Analytics.php">Analytics</a></td>
						<td width="100px"><a href="UserAnalysis.php">User Analysis</a></td>
						<td width="80px"><a href="Message.php">Message</a></td>
						<td width="100px"><a href="Notification.php">Notificstion</a></td>
						<td width="80px"><a href="home.php"><img src="a.jpg" width="40px" height="40px"></a>
						<br>
						<a href = "Pages/logout.php"><h3>LogOut</h3></a></td>
					</tr>
					
					 <tr>
                        <td colspan="11" style="border-top:4px solid #888;"></td>
                    </tr>
					
		
	
	</table></center>

<center>
	<table border="1">
		<thead>
		<tr>
			<th>ID</th>
			<th>Ename</th>
			<th>Company Name</th>
			<th>User Name</th>	
			<th>Contact No</th>	
			<th>Password</th>				
			<th>User Type</th>
		</tr>	
          </thead>

          <tbody>
          	   <?php
          	  $conn=mysqli_connect('localhost','root','','jobportal');
			$sql="select * from elist";
			$get=mysqli_query($conn,$sql);
			
   if(count($get)>0){
	while ($user=mysqli_fetch_assoc($get)) {
	
	?>
					<tr>
						<td><?php echo $user["eid"];?></td>
		          		<td><?php echo $user["ename"];?></td>
		          		<td><?php echo $user["cname"];?></td>
		          		<td><?php echo $user["uname"];?></td>
		          		<td><?php echo $user["cno"];?></td>
						<td><?php echo $user["pass"];?></td>
						<td><?php echo $user["utype"];?></td>
		          		 <td> <a href="ViewInfo.php?id=<?php echo $user['id'];?>">Delete</a>|<a href="edit.php?id=<?php echo $user['id'];?>"/>Edit</a></td>

		          	</tr>
		         	

    <?php
    		}
    	}
	
	?>	

          </tbody>	
        


	</table>
	</center>

	<form method="POST" action="">
		<fieldset>	\
		
			<legend><b>Edit Info</b></legend>
			<table cellpadding="5px">
			<tr>
					<td>
			Employee Name<br><input type="text" name="ename" value="">
			</td>
				<td>
			Username:<br><input type="text" name="cname" value="">
			</td>
			
			
				<td>
			Email:<br><input type="text" name="uname" value="">
			</td>
			<td>
			Company No: <br><input type="cno" name="cno" value="">
			</td>
			
				<td>
			Password <br><input type="password" name="pass" value="">
			</td>
			
			
			
			

			
			<td>
			<input type="radio" name="utype" value="User"/>User <br>
			<input type="radio" name="utype" value="Admin"/>Admin
			
			</td>
			
			
			
			<tr>
			<td style="border-top:1px solid #888;">
			<input type="submit" name="Add" value="Add"/>
			<input type="submit" name="Update" value="Update"/>
			<input type="text" name="eid2" value="">
			<input type="submit" name="Delete" value="Delete"/>
			</td>
			</tr>

			
			</table>

			

		</fieldset>	
		

	</form>
<form method="POST" action="">
	<table>
				<tr>
				<td>
				<input type="submit" name="Back" value="Back" method="POST" action=""/>
				</td>
			</tr>
			</table>

</form>

<input type="text" name="search" method="POST" action=""  onkeyup="search(this.value)" />
<div id="find"> </div>

<script type="text/javascript">
	
		function search(val){
			
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", "search.php", true);
				xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhttp.send('key='+val);
			
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					 	document.getElementById('find').innerHTML = this.responseText;					 
					}
				};
		}
	</script>


</body>
</html>
<?php
}
else{
	header('location:signin.php');
}
?>