<?php
session_start();
?>
<?php
	if(isset($_SESSION['username']))
	{
		$user=$_SESSION['username'];
		$pass=$_SESSION['password'];
		$level=$_SESSION['levelid'];
	}
	else
	{
?>
	<script type="text/javascript">
		//window.location="index.php";
		<?php header("location:index.php"); ?>
		alert("Please login first to access this page.");
	</script>
<?php
	exit();
	}

	//Guest //Student
	if (($level==1) || ($level==2))
	{
		include("dbconfig.php");
		$result=mysql_query("SELECT * FROM usermaster WHERE username ='".$user."' AND password=PASSWORD('".$pass."')");
		while($row=mysql_fetch_array($result))
		{
			if($row['isactive']==1)
			{
				$uid=$row['userid'];
				$_SESSION['uid']=$uid;
				$fname=$row['fname'];
				$mname=$row['mname'];
				$lname=$row['lname'];
				$pic="uploads/".$row['pic'];
				$fullname=$fname." ".$lname;
			}
			else
			{
?>
			<script type="text/javascript">
				//window.location="index.php";
				<?php header("location:index.php"); ?>
				alert("Sorry but your account is no longer active Please contact your administrator immediately.");
			</script>
<?php
			session_destroy();
			}
		}
	}
	//Faculty
	elseif ($level==3)
	{
?>
	<script type="text/javascript">
		//window.location="index_faculty.php";
		<?php header("location:index_faculty.php"); ?>
	</script>
<?php
	}
	//Registrar
	elseif ($level==4)
	{
?>
	<script type="text/javascript">
		//window.location="index_registrar.php";
		<?php header("location:index_registrar.php"); ?>
	</script>
<?php
	}
	else
	{
?>
	<script type="text/javascript">
		//window.location="index.php";
		<?php header("location:index.php"); ?>
		alert("Please login first to access this page.");
	</script>
<?php
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>CAMP CRAME HIGH SCHOOL</title>
	<link href="css/css.css" rel="stylesheet" type="text/css">
	<!-- THIS ESSENTIAL IN PLAYING FLASH -->
	<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
	<script type="text/javascript">
		function mhover(obj,txt){
			obj.src =txt;
		}
		function mout(obj,txt){
			obj.src =txt;
		}
	</script>
	<style>
		.firstcharacter { float: left; color: #903; font-size: 50px; line-height: 35px; padding-top: 4px; padding-right: 8px; padding-left: 3px; font-family: Georgia; }
	</style>
</head>

<body>

<!-- CONTAINER OF DIV'S -->
<div class="container">
	
	<!-- HEADER -->
	<div class="header">
	</div>
	
	<!-- NAVIGATOR -->
	<div class="navigator" align="center">
		<?php 
		
		if($level==1)
		{
			include 'includes/mainNav_Guest.txt';
		}
		else if ($level==2)
		{
			include 'includes/mainNav_student.php';
		}
		
 ?>
	</div>
	
	<!-- MARQUEE INFO -->
	<div class="marqueeInfo">
		<?php include 'includes/Navmarquee.txt'; ?>
	</div>
	
	<!-- TEXT CONTAINER -->
	<div class="bodycontainer">
		<!-- Another div here for info-->
		
				<?php
					display_form();
				
					function display_form()
					{
						global $errors;
				?>
				<!-- CONTENTS -->
	  			<div class="Contents">
					<div style="width:240px; height:400px; float:left; ">


						<br/>
						<table  width="200" height="128" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td bgcolor="#880000" colspan="2" align="center" width="168"><font face="Georgia" size="-0.5" color="#FFFFFF" >CCHS @ Glance</font></td>
							</tr>
                        	<td>&nbsp;</td>
                      		<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a id="" href="#"><img src="images/star.jpg" height="12" width="18">History</td>
                      		</tr>
							<td>&nbsp;</td>
                      		<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Organizational Chart</td>
                      		</tr>
							<td>&nbsp;</td>
                      		<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Student Handbook</td>
                      		</tr>
							<td>&nbsp;</td>
                      		<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Facilities</td>
                      		</tr>          
							<td>&nbsp;</td>							
                      		<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Course Offerings</td>
                      		</tr> 
                      		<td>&nbsp;</td>
							<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Department of Education</td>
                      		</tr> 
                      		<td>&nbsp;</td>
							<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Cavite State University</td>
                      		</tr> 
                      		<td>&nbsp;</td>
							<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Google</td>
                      		</tr> 
                      		<td>&nbsp;</td>
							<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">Yahoo</td>
                      		</tr> 
                      		<td>&nbsp;</td>
							<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">K-12</td>
                      		</tr> 
                      		<td>&nbsp;</td>
							<tr>
								<td>&nbsp;</td>
								<td align="justify" colspan ="2"><a href="#"><img src="images/star.jpg" height="12" width="18">YouTube</td>
                      		</tr> 

							</table>
						<br/>
					</div>
					
					<div style="left:-250px;"> 
						<br>						
						<h1>Announcements</h1>
						<br/>
						<legend><font size="+1""><strong></strong></font></legend>
						<table class="curvedEdges" width="400" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF6633">
								<tr>
								  <td colspan="2" bgcolor="#FF6633"><div align="center"><strong><font color="#FFFFFF">Title</font></strong></div></td>
								  <td width="61" bgcolor="#FF6633"><div align="center"><strong><font size="-1" color="#FFFFFF">Date Posted</font></strong></div></td>
								  <td width="61" bgcolor="#FF6633"><div align="center"><strong><font size="-1" color="#FFFFFF">Posted By</font></strong></div></td>
								</tr>
								<?php require_once('myFunctions.php'); displayAnnouncement(date("Y-m-d"));?>
						</table>
						</div>
		  		</div>
				<?php
					}
				?>
		
		<div class="RightBox" align="center">
				
		<?php 
			echo "<img src='".$pic."' width='162' height='178' border='2'>";  
		?>
		<br>
			<div class="inName">
				<?php echo($fullname); ?>
			</div>
			<br>
		  	<div class="inMessage1" align="left">
				<?php include 'includes/infomarquee.txt'; ?>
		  	</div>
  	  </div>
	</div>
	
	
	<!-- FOOTER NAV-->
	<div class="footerNav" align="center" >
		<?php 
			if($level==1)
			{
				include 'includes/footernav_Guest.txt';
			}
			else if ($level==2)
			{
				include 'includes/footernav_student.php';			
			}
		?>
	</div>
	
	<!-- FOOTER -->
	<div class="footer" align="center" >
		Copyright © Camp Crame High School All Rights Reserved 2014.
	</div>
	
</div>

</body>
</html>
