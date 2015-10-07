<link rel="stylesheet" type="text/css" href="styles.css">
<title>Create Articles</title>
<style type="text/css">
.articledata
	{	
		height:30px;
		border:solid 2px;
		border-radius:10px;
		width:20%;
	}
</style>
<?php
session_start();
require_once ('dbconfig.php');

if(!isset($_SESSION['user_n']) && !isset($_SESSION['moderator']))
{
	header("Location: index.php");
}
else
{
	if(isset($_POST['submit1']))
	{
		echo '<ul>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="create_articles.php">Upload Articles</a></li>
					<li><a href="articles.php">Home</a></li>
			   </ul>';
		if(empty($_POST['article_name']) && $_POST['category']==0 && empty($_POST['articles']))
		{
			echo '<font color="red" size=+1 style="background-color:yellow;">Fill All Fields.</font>';
		}
		else if(empty($_POST['article_name']) && $_POST['category']==0 && !empty($_POST['articles']))
		{
			echo '<font color="red" size=+1 style="background-color:yellow;">Write some Article.</font>';
		}
		else if(!empty($_POST['article_name']) && $_POST['category']==0 && empty($_POST['articles']))
		{
			echo '<font color="red" size=+1 style="background-color:yellow;">Enter Article Name.</font>';
		}
		else if(!empty($_POST['article_name']) && $_POST['category']==0 && !empty($_POST['articles']))
		{
			echo '<font color="red" size=+1 style="background-color:yellow;">Select Category.</font>';
		}
		else
		{
			if($_POST['category']==1)
				$category1 = "Import Questions";
			elseif($_POST['category']==2)
				$category1 = "Concepts In Chapters";
			elseif($_POST['category']==3)
				$category1 = "Sports";
			elseif($_POST['category']==4)
				$category1 = "Fests In This Semester";
			elseif($_POST['category']==5)
				$category1 = "Exam Schedule";
			if(isset($_SESSION['user_pic']))
				$user_pic = $_SESSION['user_pic'];
			$article_name = $_POST['article_name'];
			if(isset($_SESSION['user_n']))
				$user_name = $_SESSION['user_n'];
			$article = $_POST['articles'];
			if($_SESSION['moderator'])
				$query = mysql_query("insert into `articles` (`name`,`articles`,`category`,`user_name`,`votes`) values ('$article_name','$article','$category1','$user_name',5)") or die(mysql_error());
			else
				$query = mysql_query("insert into `articles` (`name`,`articles`,`category`,`user_name`,`user_pic`) values ('$article_name','$article','$category1','$user_name','$user_pic')") or die(mysql_error());
			if($query)
				echo '<font color="green" size=+1 style="background-color:yellow;">Data Uploaded Successfully</font>';
			else
				echo '<font color="red" size=+1 style="background-color:yellow;">Could Not Upload Article</font>';
		}
	}

	?>
	<form id="post_articles" method="post" action="">
		<lable style="font-weight:bold; color:#666; font-family:Verdana, Geneva, sans-serif;">Article Name
			<input type="text" class="articledata" name="article_name" placeholder="Article Name"></label><br /><br />
		<label style="font-weight:bold; color:#666; font-family:Verdana, Geneva, sans-serif;">Choose:- <select id="category" name="category" id="category">
			<option value="0">Select Category</option>
			<option value="1">Import Questions</option>
			<option value="2">Concepts In Chapters</option>
			<option value="3">Sports</option>
			<option value="4">Fests In This Semester</option>
			<option value="5">Exam Schedule</option>
		</select></label>
		<br /><br />
		<label style="font-weight:bold; color:#666; font-family:Verdana, Geneva, sans-serif;">Article:- </label><br />
			<textarea id="articles" style="border-radius: 5px;" rows="4" cols="50" name="articles" placeholder="Write your article here...">
		</textarea>
		<br /><br />
		<input type="submit" value="Post Article" name="submit1" id="submit1">
	</form>
	<?php
}
?>
