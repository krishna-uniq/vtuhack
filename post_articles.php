<?php
session_start();
if(!isset($_SESSION['user_n']))
	header("Location: index.php");
else
{
	if($_POST['article_name'])
	{
		echo $_POST['article_name']." ".$_POST['category']." ".$_POST['articles'];
	}
	else
		echo "not posted";
}
?>
