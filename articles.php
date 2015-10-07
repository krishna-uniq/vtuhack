<link rel="stylesheet" type="text/css" href="styles.css">
<title>Home</title>
<style type="text/css">
	#college
	{	
		height:30px;
		border:solid 2px;
		border-radius:10px;
		width:25%;
	}
	
</style>
<div class="container">
<?php
session_start();
require_once ('dbconfig.php');
if(!isset($_SESSION['user_n']) && !isset($_SESSION['moderator']))
	header("Location: index.php");
else
{
	if(!isset($_SESSION['moderator']))
		echo $_SESSION['user_n'].'<ul><li><a style="float: left;" href="logout.php">Logout</a></li></ul>';
	else
		echo '<ul> 
				<li><a href="logout.php">Logout </a></li>
				<li><a href="create_articles.php" >Create Articles</a> </li>
				<li><a href="moderator.php">Vote Articles</a></li><br>
			</ul>';
	?>
	<br />
	<select name="formal"  onchange="javascript:handleSelect(this)" style="border:1px solid black; border-radius:5px;">
		<option value="category.php?category=0">Select Category</option>
		<option value="category.php?category=1">Import Questions</option>
		<option value="category.php?category=2">Concepts In Chapters</option>
		<option value="category.php?category=3">Sports</option>
		<option value="category.php?category=4">Fests In This Semester</option>
		<option value="category.php?category=5">Exam Schedule</option>
	</select>
	<br />
	<br />
	<label style="font-weight:bold; color:#666; font-family:Verdana, Geneva, sans-serif;">College 
		<input type="text" id="college" name="college" placeholder="College Name">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Save" name="save">
	</label>
	<?php
	  $college='';
	  $query='';
	  if (isset($_POST['save']))
 	  {
 			if (($_POST['college']))
 				$query = mysql_query("insert into `colleges` (`college_name`) values ('$college')") or die(mysql_error());
 	  }
 	  if($query)
				echo '<font color="green" size=+1 style="background-color:yellow;">College Name Updated Successfully</font>';
	  else
				echo '<font color="red" size=+1 style="background-color:yellow;">Could Not Upload College Name</font>';
 				$query = mysql_query("select * from `colleges` ");
				if(mysql_num_rows($query)<1)
					echo '<br /><font color="red" size=+2 style="background-color:yellow;">Error</font>';
				else
				{
					while ($row = mysql_fetch_array($query)) 
					{
						echo '<div align="right">
						'.$row[1].'</div>';
					}
				}	 
	?>
	<br />
	<br />
	<?php

	$query = mysql_query("select * from `articles` where `votes`>=5 order by `id` desc");
	if(mysql_num_rows($query)<1)
		echo '<br /><font color="red" size=+2 style="background-color:yellow;">No Articles Found</font>';
	else
	{
		while ($row = mysql_fetch_array($query)) 
		{
			echo '<div class="content_mod">
					<img src="'.$row[5].'" width="40">'.$row[4].'<div class="content"><font size=-1>Article Name:- </font>'.$row[1].'<br>'.$row[2].'</div></div>';
		}
	}
}
?>
<script type="text/javascript">
function handleSelect(elm)
{
window.location = elm.value;
}
</script>
</div>
