<?
include("retwis.php");
if (!isLoggedIn()) {
    header("Location: index.php");
    exit;
}
include("header.php");
$r = redisLink();
if ($User['username'] != 'admin') {
    header("Location: index.php");
    exit;
}
?>
<div id="postform">
<form method="POST" action="articles_post.php">
<?=utf8entities($User['username'])?>, Post your articles for website coding.
<br>
<table>
<tr><td><textarea cols="70" rows="3" name="articles"></textarea></td></tr>
<tr><td align="right"><input type="submit" name="doit" value="Update"></td></tr>
</table>
</form>
<div id="homeinfobox">
<?=$r->zcard("followers:".$User['id'])?> followers<br>
<?=$r->zcard("following:".$User['id'])?> following<br>
</div>
</div>
<?
include("footer.php")
?>
