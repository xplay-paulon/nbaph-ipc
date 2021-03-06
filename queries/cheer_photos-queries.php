<?php
include('sqli.php');
include("lib.php");

   if($album_id) {
       $query_pho = "SELECT a.*, b.AlbumName, b.DateAdded FROM cheerphotos AS a
                   LEFT JOIN cheeralbums AS b ON a.AlbumID=b.AlbumID
                  WHERE a.AlbumID='".mysqli_real_escape_string($connect, $album_id)."' AND b.Status='s' ORDER BY a.SortOrder DESC, a.PhotoID ASC ";
       $result_pho = mysqli_query($connect, $query_pho) or die(mysqli_error());
      $found_pho = mysqli_num_rows($result_pho);

      $disp = mysqli_fetch_array($result_pho);
   }
   else {
      $query_pho = "SELECT a.*, b.PhotoID, b.Filename, b.Caption, b.ImageSecond FROM cheeralbums  AS a
                  LEFT JOIN cheerphotos AS b ON a.AlbumID=b.AlbumID
                  WHERE a.Status='s'
                  GROUP BY a.AlbumID
                  ORDER by a.SortOrder DESC, b.SortOrder DESC, a.DateAdded DESC LIMIT 0, 20 ";
      $result_pho = mysqli_query($connect, $query_pho) or die(mysqli_error());
      $found_pho = mysqli_num_rows($result_pho);
   }

   if(($found_pho <= 0) && ($album_id)) {
      header("location: ".$base."cheerdancers-photos");
   }

   $gallery_array = array();

   if ($album_id) {
      $count = 1;
      while($row = mysqli_fetch_array($result_pho)) {
         $gallery_array[$count]['AlbumID'] = $row['AlbumID'];
         $gallery_array[$count]['PhotoID'] = $row['PhotoID'];
         $gallery_array[$count]['Caption'] = $row['Caption'];
         $gallery_array[$count]['Filename'] = $row['Filename'];
         $gallery_array[$count]['Credits'] = $row['Credits'];
         $gallery_array[$count]['AlbumName'] = $row['AlbumName'];
         $gallery_array[$count]['DateAdded'] = $row['DateAdded'];
         $count += 1;
      }
   }
   else {
      $count = 0;
      while($row = mysqli_fetch_array($result_pho)) {
         $gallery_array[$count]['ImageSecond'] = $row['ImageSecond'];
         $gallery_array[$count]['AlbumID'] = $row['AlbumID'];
         $gallery_array[$count]['AlbumName'] = $row['AlbumName'];
         $gallery_array[$count]['DateAdded'] = $row['DateAdded'];
         $count += 1;
      }
   }

   $results = mysqli_query($connect, "SELECT AdsDesc, Content FROM ads_list WHERE (AdsDesc='nba_CheerPhotos_top_leaderboard' or AdsDesc='nba_CheerPhotos_bottom_leaderboard' or AdsDesc='nba_Cheerdancers_medallion1') AND Status='s' ");

   $ads_list = array();

   while ($row = mysqli_fetch_array($results)) {
      $ads_list[$row['AdsDesc']]['Content'] = $row['Content'];
   }

   $grounded = 1;
   $query_bgads = "SELECT AdsID, Title, Link, Image, BgColor FROM background_ads WHERE Status='s' AND Page='".mysqli_real_escape_string($connect, trim($part_page))."' ORDER BY DateUpdated DESC, DateAdded DESC LIMIT 0, 1 ";
   $result_bgads = mysqli_query($connect, $query_bgads) or die(mysqli_error());
   $found_bgads = mysqli_num_rows($result_bgads);

?>