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

	//registrar
	if ($level==4)
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
	//guest
	elseif ($level==1)
	{
?>
	<script type="text/javascript">
		//window.location="index_student.php";
		<?php header("location:index_student.php"); ?>
	</script>
<?php
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
	//student
	elseif ($level==2)
	{
?>
	<script type="text/javascript">
		//window.location="index_registrar.php";
		<?php header("location:index_student.php"); ?>
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
<?php
	include ('dbconfig.php');
	
	if( (empty($_GET['gradeid'])) || (empty($_GET['sectionid'])))
	{
?>
	<script type="text/javascript">
		window.location="section_management.php";
	</script>
<?php	
	}
	else
	{
		$gradeid=$_GET['gradeid'];
		$sectionid=$_GET['sectionid'];
		
		require_once('fpdf/fpdf.php');
		require_once('fpdi/fpdi.php');

		// initiate FPDI
		$pdf = new FPDI();

		// set the sourcefile
		$sourceFileName = 'PDF Template/list.pdf';

		//Set the source PDF file
		$pagecount = $pdf->setSourceFile($sourceFileName);

		$i = 1;
		do {
		
			// add a page
			$pdf->AddPage();
			// import page
			$tplidx = $pdf->ImportPage($i); 

			 $pdf->useTemplate($tplidx, 10, 10, 200);
			 
			 $pdf->SetFont('courier');
			 $pdf->SetTextColor(0,0,0);
			 $pdf->SetFontSize(12);		

			 $result =mysql_query("SELECT glm.description, sm.section FROM gradelevelmaster as glm, sectionmaster as sm WHERE glm.gradeid=sm.gradeid AND sm.gradeid=$gradeid AND sm.sectionid=$sectionid");
			while ($row=mysql_fetch_array($result))
			{
				$grade=$row['description'];
				$section=$row['section'];
			}
		
			 $pdf->SetXY(21.5, 50);
			 $pdf->Write(1, "Grade Level: ".$grade);		
		
			 $pdf->SetXY(21.5, 57);
			 $pdf->Write(1, "Section: ".$section);			

			 $pdf->SetFont('courier');
			 $pdf->SetTextColor(0,0,0);
			 $pdf->SetFontSize(10);	
			 
			$result = mysql_query("SELECT sm.lrn, um.lname, um.fname, um.mname FROM usermaster as um, studentmaster as sm WHERE um.userid=sm.userid and sm.gradeid=$gradeid and sm.sectionid=$sectionid order by um.lname asc");
			$num=mysql_num_rows($result);
			$number=0;	
			$pos=70;
			while($row = mysql_fetch_array($result))
			{
				if($number<=$num)
				{
					$a=$number+1;
					$number =$number+1;
				}
				
				$str = $number.". ". $row['lname'] .', '. $row['fname'] .' ' . $row['mname'] . "\r\n";
				// write line to PDF
				
				$pdf->SetXY(21.5, $pos);
				$pdf->Write(1,$str);		
				$pos= $pos+6;
			}			 
			 $i++;

			} while($i <= $pagecount);
		$pdf->Output();

	}
	
?>