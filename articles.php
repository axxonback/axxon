<?
include("retwis.php");
include("header.php");
?>
<h2>Articles</h2>
<i>Latest 50 articles from users aroud the world!</i><br>
<?
$p = 6;
showArticlesPost($p);
showArticlesPost($p-1);
showArticlesPost($p-2);

include("footer.php");
?>
