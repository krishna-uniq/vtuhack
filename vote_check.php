<?php
require_once ('dbconfig.php');
$article_id = $_POST['aid'];
$uid = $_POST['uidd'];

$vote_count = mysql_query("select * from `articles` where `id` = $article_id") or die(mysql_error());
while($votes = mysql_fetch_array($vote_count))
{
	$voted = $votes[6];
}

$ucheck = mysql_query("select * from `votes` where `article_id` = $article_id and `user_id` = $uid ");
if(mysql_num_rows($ucheck)==1)
	$stat = 0;
else
{
	$voted++; 

	$update_vote = mysql_query("update `articles` set `votes`= $voted where `id`=$article_id ") or die(mysql_error());
	if($update_vote)
		$stat = 1;
	else
		$stat = 2;
	$update_voted = mysql_query("insert into `votes` (article_id,user_id,voted) values($article_id,$uid,1) ") or die(mysql_error());
}
echo $stat;
?>
