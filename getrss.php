<?php

putenv("TZ=US/Eastern");

ini_set('display_errors',true);

$delicious_url = 'http://feeds.delicious.com/v2/rss/popular';

$curl = curl_init($delicious_url);
$localfile = fopen(dirname(__FILE__) . "/rss/delicious.popular." . date("Y.m.d.Hi") . ".rss" , "w+");
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 50);
curl_setopt($curl, CURLOPT_FILE, $localfile);
curl_exec($curl);
curl_close($curl);

fclose($localfile)

?>