<?
include("retwis.php");

if (!isLoggedIn() || !gt("articles")) {
    header("Location:index.php");
    exit;
}

$r = redisLink();
$articles_postid = $r->incr("next_articles_post_id");
$articles = str_replace("<","&lt;",gt("articles"));
$articles = str_replace(" ","&nbsp",$articles);
$articles = str_replace("\n","<br>",$articles);
$r->hmset("articles_post:$articles_postid","user_id",$User['id'],"time",time(),"articles_body",$articles);
$followers = $r->zrange("followers:".$User['id'],0,-1);
$followers[] = $User['id']; /* Add the post to our own posts too */

foreach($followers as $fid) {
    $r->lpush("posts:$fid",$postid);
}
# Push the post on the timeline, and trim the timeline to the
# newest 1000 elements.
$r->lpush("timeline",$articles_postid);
$r->ltrim("timeline",0,1000);

header("Location: articles.php");
?>
