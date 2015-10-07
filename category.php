<title>Prefered Category</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<div class="container">
<?php
require_once ('dbconfig.php');
if(isset($_SESSION['user_n']))
	header("Location: index.php");
else
{
	if(isset($_GET['category']) && $_GET['category']!="")
	{
		echo '<ul>
					<li><a href="logout.php">Logout </a></li>
			  		<li><a href="create_articles.php">Upload Articles</a></li>
			  </ul>';
		if($_GET['category']==1)
			$category1 = "Import Questions";
		elseif($_GET['category']==2)
			$category1 = "Concepts In Chapters";
		elseif($_GET['category']==3)
			$category1 = "Sports";
		elseif($_GET['category']==4)
			$category1 = "Fests In This Semester";
		elseif($_GET['category']==5)
			$category1 = "Exam Schedule";
		elseif($_GET['category']<1 || $_GET['category']>5)
		{
			echo "Invalid Access<br>";
			$category1="";
		}
		else
		{
			echo "Invalid";
			$category1 = "";
		}
		$query = mysql_query("select * from `articles` where `category`='$category1' and `votes`>=5") or die(mysql_error());
		if(mysql_fetch_array($query))
		{
			while ($row = mysql_fetch_array($query)) 
			{
				echo '<div class="content_mod"><img src="'.$row[5].'" width="40"> '.$row[4].'<br><div class="content">'.$row[1].'<br>'.$row[2].'</div></div><br>';
			}
		}
		else
			echo '<font color="red" size=+1 style="background-color:yellow;">No data found in this category</font>';

	}
	elseif(isset($_GET['category']) && $_GET['category']=="")
	{
		echo "Invalid Category";
	}
	else
	{
		echo "Invalid Access";

	}
}
?>
</div>
