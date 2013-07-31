<?php 

putenv("TZ=US/Eastern");
define('_ISO','charset=UTF-8');

include "/PATH/data/lastRSS.php";

$rss = new lastRSS; // Create lastRSS object 

$args = getopt("year:month:day");

$year = date('Y');
$month = date('m');
$day = date('d');
$hour = date('H');

$query = "";

$connection = mysql_connect("DATABASE", "USERNAME", "PASSWORD") or die("Unable to connect to database\n");

if (mysql_select_db ("squarepop", $connection)) { }
else { echo "Unable to find table."; }


$rssurl = '/PATH/data/rss/delicious.popular.' . $year . '.' . $month . '.' . $day . '.' . $hour . '00.rss';
$datetime = $year . '-' . $month . '-' . $day . ' ' . $hour . ':00:00';

if ($feed = $rss->get($rssurl)) { 
	foreach ($feed['items'] as $item) { 
		$title = mysql_real_escape_string($item[title]);
		$query = $query . "('', '$title', '$item[link]', '$item[comments]', '$datetime'),";
	}
} 

$query = "INSERT INTO `delicious` VALUES" . substr($query, 0, -1);
$insert = mysql_query($query) or die("Failed to insert line\n");

mysql_close;

?>