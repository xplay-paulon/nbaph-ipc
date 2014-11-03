<?php
include('sql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title>NBA Philippines | Bloggers</title>
<?php
include('head.php');
?>
<link rel="stylesheet" href="news.css" />
</head>

<body>
<?php
include('header.php');
?>

<div style="max-width: 993px; margin: 10px auto">
   <div class="nbaph_recent_content">
      RECENT CONTENT
   </div>

   <div class="nbaph_article_wide">
      <div class="nbaph_article_content">
<?php
$results = $connect->query("select * from blog where DisplayOn <= NOW() order by DisplayOn desc limit 0, 8");

$count = 0;

while($row = $results->fetch_array()) {
?>
         <div class="nbaph_news-writers_cell">
            <div class="nbaph_news-writers_padding">
               <table>
                  <tr>
                     <td>
                        <div class="nbaph_news-writers_image">
                           <img src="http://ph.nba.com/images/blogs/<?php echo strtolower(str_replace(" ", "", $row['Blogger'])); ?>.jpg" />
                        </div>
                     </td>
                     <td>
                        <div class="nbaph_news-writers_name">
                           <?php echo stripslashes($row['Blogger']); ?>
                        </div>

                        <div class="nbaph_news-writers_site">
                           <?php echo stripslashes($row['BlogAffiliation']); ?>
                        </div>
                     </td>
                  </tr>
               </table>

               <div class="nbaph_news-writers_title">
                  <a href="<?php
                  if ($row['BlogLink']) {
                     echo $row['BlogLink'];
                  }
                  else {
                     echo 'bloggers_article.php?id=' . $row['BlogID'];
                  }
                  ?>" target="_blank"><?php echo stripslashes($row['BlogTitle']); ?></a>
               </div>

               <div class="nbaph_news-writers_summary">
                  <?php echo stripslashes($row['BlogExcerpt']); ?>
               </div>

               <div class="nbaph_news-writers_links">
                  <a href="<?php echo $row['BlogLink']; ?>" target="_blank">Full Story</a>
                  <div style="margin: 0 10px; display: inline-block">|</div>
                  <a href="bloggers-archive.php?blog=<?php echo urlencode($row['Blogger']); ?>">Archive</a>
               </div>
            </div>
         </div>
<?php
   $count += 1;

   if ($count % 2 == 0) {
      echo '<div class="clear"></div>' . "\n";
   }
}
?>

         <div style="clear: both"></div>
      </div>

      <div class="nbaph_article_more_link"></div>
   </div>
<?php
include('mrec.php');
?>
   <div style="clear: both"></div>
</div>

<?php
include('footer.php');
?>
</body>
</html>
<?php
$connect->close();
?>