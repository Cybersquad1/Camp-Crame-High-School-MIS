<?php



session_start();

if($_POST['term']=='')
{
	header('location:view_student.php');
}

else
{
	$term=$_POST['term'];
	$criteria=$_POST['criteria'];
	if($criteria=="lrn")
	{
		$criteria="sm.".$criteria;
	}
	else
	{
		$criteria="um.".$criteria;
	}
?>

<meta HTTP-EQUIV="REFRESH" content="0; url=edit_grade.php?term=<?php echo $term ?>&&criteria=<?php echo($criteria); ?>">
<?php
}
?>
