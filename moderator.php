<link rel="stylesheet" type="text/css" href="css/styles.css">
<title>Moderator</title>
<style type="text/css">
	#login_moderator
	{
		margin-top: 25%;
		margin-left: 30%;
	}
	.logindata
	{	
		height:30px;
		border:solid 2px;
		border-radius:10px;
		width:30%;
	}

</style>
<div class="container">
<?php
session_start();
require_once ('dbconfig.php');
if(!isset($_SESSION['moderator']))
{
	login();
}
else
	moderator_articles();
	if(isset($_POST['modid']))
	{
		if(empty($_POST['modid']) && empty($_POST['modpass']) )
			echo '<center><font color="red" size=+1 style="background-color:yellow;">Please Fill Both Fields</font></center>';
		else if(empty($_POST['modid']) && !empty($_POST['modpass']) )
			echo '<center><font color="red" size=+1 style="background-color:yellow;">Please Fill Moderator Id</font></center>';
		else if(!empty($_POST['modid']) && empty($_POST['modpass']) )
			echo '<center><font color="red" size=+1 style="background-color:yellow;">Please Fill Moderator Password For Your Account</font></center>';

		else
		{
			$id = $_POST['modid'];
			$pass = $_POST['modpass'];
			$query = mysql_query("select * from `users` where `user_id`=".$id." and `user_password` ='$pass' and `user_type` = 0 ") or die(mysql_error());
			if(mysql_num_rows($query)==1)
			{
				while ( $moddet = mysql_fetch_array($query)) 
				{
					$_SESSION['moderator'] = $moddet['1'];
					moderator_articles();
				}
			}
			else
			{
				echo "Invalid User Credentials or You Dont't Have Permission To Access This Page";
			}
		}
	}

function login()
{
	?>
	<div id="form1">
		<div id="login_moderator">
			<form method="post" action="">
				<label style="font-weight:bold; color:#666; font-family:Verdana, Geneva, sans-serif;">Moderator Id&nbsp;&nbsp;&nbsp;
					<input type="text" id="modid" class="logindata"name="modid" placeholder="Modrator Id" autocomplete="on"></label><br /><br />
				<label style="font-weight:bold; color:#666; font-family:Verdana, Geneva, sans-serif;">&nbsp;&nbsp;Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="password" id="modpass" class="logindata"name="modpass" placeholder="Passoword" autocomplete="off"><br /><br /></label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Login">
			</form>
		</div>
	</div>
	<?php
}
function moderator_articles()
{
	?>
	<ul>
		<li><a href="logout.php">Logout</a></li>
		<li><a href="create_articles.php"> Upload Articles</a></li>
		<li><a href="articles.php">View Articles</a></li>
	</ul>
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.js"></script>
	<script type="text/javascript">
	var uid = '<?php echo $_SESSION['moderator']; ?>';
	function vote_check(id)
	{
		$.post('vote_check.php',{aid:id,uidd:uid})
		.done(function(data)
		{
			if(data=="0")
				alert("You've already voted");
			else if(data=="1")
				alert("Voted");
			else if(data=="2")
				alert("Could Not Vote");
		});
	}
	$('#form1').hide();
	</script>
	<div id="alist">
	<?php
	$query1 = mysql_query("select * from `articles` where `votes` <5") or die(mysql_error());
	while($content = mysql_fetch_array($query1) or die(mysql_error()))
	{
		echo '<div class="content_mod"><img src="'.$content[5].'" width="40"> '.$content[4].'<br><div class="content">'.$content[1].'<div class="right_small"><a href="javascript:vote_check('.$content[0].');"); id="vote_mode">Vote</a></div></div></div><br>';
	}
	echo '</div>';
}
?>
</div>
