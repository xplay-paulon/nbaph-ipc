<?phpinclude('sqli.php');$results = mysqli_query($connect, "SELECT AdsDesc, Content FROM ads_list WHERE (AdsDesc='nba_archives_top_leaderboard' or AdsDesc='nba_Archivevs_skyscraper' or AdsDesc='nba_archives_top_medallion' or AdsDesc='nba_archives_bottom_leaderboard') AND Status='s' ");$ads_list = array();while($row = mysqli_fetch_array($results)) {  $ads_list[$row['AdsDesc']]['Content'] = $row['Content'];}$results = mysqli_query($connect, "select * from news where DatePosted >= '" . implode("-", $start_date) . " 00:00:00' and DatePosted <= '" . date("Y-m-d", mktime(0, 0, 0, $start_date[1], $start_date[2] + 6, $start_date[0])) . " 23:59:59' order by DatePosted desc");$news_array = array();$news_total = mysqli_num_rows($results);$count = 0;while($row = mysqli_fetch_array($results)) {  $news_array[$count]['DatePosted'] = $row['DatePosted'];  $news_array[$count]['Source'] = $row['Source'];  $news_array[$count]['NewsID'] = $row['NewsID'];  $news_array[$count]['Title'] = $row['Title'];  $news_array[$count]['Link'] = $row['Link'];  $count += 1;}$results = mysqli_query($connect, "select * from ads where Dimensions = '300x100' order by RAND() limit 0, 1");$row = mysqli_fetch_array($results);$ad = array("Link" => $row['Link'], "Image" => $row['Image']);$grounded = 1;$query_bgads = "SELECT AdsID, Title, Link, Image, BgColor FROM background_ads WHERE Status='s' AND Page='".mysqli_real_escape_string($connect, trim($part_page))."' ORDER BY DateUpdated DESC, DateAdded DESC LIMIT 0, 1 ";$result_bgads = mysqli_query($connect, $query_bgads) or die(mysqli_error());$found_bgads = mysqli_num_rows($result_bgads);mysqli_close($connect);?>