<?
include("retwis.php");

# Form sanity checks
# if (!gt("username") || !gt("password") || !gt("password2") || !gt("email"))
#    goback("Every field of the registration form is needed!");
# if (gt("password") != gt("password2"))
#    goback("The two password fileds don't match!");

# The form is ok, check if the username is available
$username_1 = gt("username_1");
$email_1 = gt("email_1");
$language = gt("language");
$database = gt("database");
$application = gt("application");
$function = gt("function");
$r = redisLink();
# if ($r->hget("users",$username))
#    goback("Sorry the selected username is already in use.");

# Everything is ok, Register the user!
$requestid = $r->incr("next_request_id");
# $authsecret = getrand();
$r->hset("requests",$username_1,$requestid);
$r->hmset("request:$requestid",
    "username_1",$username_1,
    "email_1",$email_1,
#    "auth",$authsecret,
    "language",$language,
    "database",$database,
    "application",$application,
    "function",$function);
# $r->hset("auths",$authsecret,$userid);

 $r->zadd("requests_by_time",time(),$username_1);

# User registered! Login her / him.
# setcookie("auth",$authsecret,time()+3600*24*365);

include("header.php");
?>
<h2>Welcome aboard!</h2>
Hey <?=utf8entities($username_1)?>, now you have posted a requist, <a href="form.php">Post another request!</a>.
<?
include("footer.php")
?>
