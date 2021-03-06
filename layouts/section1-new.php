<!-- top half container start -->
<div class="container"  style='margin-top:-30px; width:1000px;'>       					
	<div class='section-container' style="float: left; width: 674px; margin-left: 5px; ">
		<div style="width: 674px;">
			<div style="width: 672px; height: 376px; overflow: hidden; border-top:1px solid #d8d8d8; border-left: 1px solid #d8d8d8; border-right: 1px solid #d8d8d8;">
				<?php
				$cthumbs = array(); 
				for ($count = 1; $count <= count($carousel_array); $count++): 						
					$cthumbs[$count-1]['Title'] = stripslashes($carousel_array[$count - 1]['Title']);
					$cthumbs[$count-1]['Main'] = stripslashes($carousel_array[$count - 1]['Image']); 
					$cthumbs[$count-1]['Image'] = stripslashes($carousel_array[$count - 1]['ImageThumb']); 
				?>
					
					<div id="carousel<?php echo $count; ?>" class="carousel" style=" <?php if ($count > 1) echo "display: none"; ?>">
					 	<a href="<?php echo $carousel_array[$count - 1]['Link']; ?>" <?php if ($carousel_array[$count - 1]['Source'] == "US") echo ' target="_blank"'; ?>>
				 			<span id="icarousel<?php echo $count; ?>">				 				
				 				<img src="<?php echo $carousel_array[$count - 1]['Image']; ?>" width="672" height="376" />
				 			</span>
				 		</a>
						<div class="carousel_text">
							<div style="font-family: arial; font-size: 20px; color: #fff; margin: 4px 15px; width: 622px; height: 24px; overflow: hidden">
								<b><a href="<?php echo $carousel_array[$count - 1]['Link']; ?>" style="color: #fff"<?php
								   if ($carousel_array[$count - 1]['Source'] == "US")
									  echo ' target="_blank"';?>><?php echo stripslashes($carousel_array[$count - 1]['Title']); ?></a>
								</b>
							</div>					
							<div id="carousel_intro" style="font-size: 12px; color: #fff; margin: 4px 15px; width: 622px; height: 46px; overflow: hidden">
							   <b><?php echo stripslashes($carousel_array[$count - 1]['Intro']); ?></b>
							</div>
					 	</div>
				  	</div>
				  	
				<?php
   				endfor;					
				$carousel .= '<div class="clear"></div>';
				?>
			</div>    
				
			<div style="width: 652px;  padding: 5px 10px; border-top:1px solid #d8d8d8; border-left: 1px solid #d8d8d8; border-right: 1px solid #d8d8d8;">
				<table cellspacing="0" cellpadding="0" style="width: 650px; padding-top: 10px">
	     			<tr>
	        			<td style="width: 25px">
	           				<!--img src="images/left_btn.png" id="headline_left" class="pointer" /-->
	           				<span id='headline_left' class='arrow-left'></span>
	        			</td>
	        			<td style="width: 600px;">	        				
	           				<div class='news carousel-container' >
	           					<div class='carousel-pics' id='news'>
		           				<?php foreach($cthumbs as $k => $v): ?>
		           					<div class="pics-container" onclick="changeCarouselHeadline(<?php echo $k; ?>);" style='float:left; width:145px; margin-right: 5px;  text-align: center;'>
		           						<div class="pics-thumb">
											<img src="<?php echo $v['Image']; ?>" width="132" height="70" />
										</div>										
										<?php echo stripslashes($v['Title']); ?>
		           					</div>
		           				<?php endforeach; ?>
		           				</div>
	           				</div>	           				
	        			</td>
	                    <td style="width: 25px; text-align: right">
							<!--img src="images/right_btn.png" id="headline_right" class="pointer" /-->
							<span id='headline_right' class='arrow-right'></span>
	                    </td>
	     			</tr>
	     			<tr>
	        			<td colspan="3" style="height: 25px; text-align: center">
	        				<div id='news-circle-indicator'></div>
	        			</td>
	     			</tr>
	  			</table>
	  			<div class="section-more_link">
	               <a href="news-article">More ph.nba.com News</a>
	            </div>
			</div>
			<div class="clear"></div>
			<script>
				changeCarouselHeadline = function(id){
					$(".carousel").each(function(){
						if($(this).attr("id") == ("carousel"+(id+1))){							
							$(this).show('slide', {direction: 'right'}, 500);
						}else{
							$(this).hide('slide',{direction:'left'},500);
						}	
					})
					
				};
				$(function(){
					$("div[id=news]").carousel({circleContainer:$("div[id=news-circle-indicator]"),itemWidth:150,itemCount:12,itemMove:4,btnNext:$("span[id=headline_right]"),btnPrev:$("span[id=headline_left]")});					
				});			
			</script>
		</div>
		</div>
		
		<div class='section-container' style="float: left; width: 300px; margin-left: 10px; " ><!-- top right start -->           
			<div style="width: 300px; height: 250px">
		 	<?php 
		 		if(true){
		 			echo $ads_list['nba_homepage_top_medallion']; 
		 		}else{
		 			?>
		 			<div>
		 				<a href="/pre-season.php?channel=live"><img src="media/2.0/medallion-banner-1-to-2pm.jpg" /></a>
		 			</div>	
		 			<?php
		 		}

		 	?>
			</div>    
			<div style="height: 10px"></div>
			<?php if ($ads_array[0]['Link']): ?>                
			<div style="width: 300px; height: 100px">
					<a href="<?php echo $ads_array[0]['Link']; ?>"><img src="ads/<?php echo $ads_array[0]['Image']; ?>"></a>
					<!--a href="/pre-season.php?register=1"><img src="media/2.0/300x100-banner-4.jpg"></a-->					
					<!--a href="/nbaglobalgamesphilippines2013"><img src="media/2.0/300x100-banner-5.jpg"></a-->					
					<!--a href="/allstar2014"><img src="media/2.0/allstar/2014/300x100-banner-5.jpg"></a-->					
			</div>
			<?php endif; ?>
			<div style="height: 10px"></div>
			<div style="width: 300px; padding: 5px 0 0px 0; height:147px;">
				<div class="article_header" style="background: url('images/rounded_top_300.png'); width: 270px; height: 15px">
		          	Social Connection 
		       	</div>
		       	<div class='box-container-110' style='height:112px; border-left: 1px solid #d8d8d8; border-right: 1px solid #F2F2F2;'>
		       		<ul class='social-icons'>
		       			<li><a href="http://www.facebook.com/philsnba?ref=hl" target="_blank"><img src="/media/2.0/icon_fb.gif"/></a></li>
		       			<li><a href="https://twitter.com/NBA_Philippines" target="_blank"><img src="/media/2.0/icon_twitter.gif"/></a></li>
		       			<li><a href="http://www.youtube.com/nba" target="_blank"><img src="/media/2.0/icon_youtube.gif"/></a></li>
		       			<li><a href="http://pinterest.com/nba/" target="_blank"><img src="/media/2.0/icon_pintrest.gif"/></a></li>
		       			<li><a href="http://nba.tumblr.com/" target="_blank"><img src="/media/2.0/icon_tumblr.gif"/></a></li>
		       		</ul>	
		       	</div>
			</div>
		</div><!-- top right end -->    
	<div class="clear"></div>             
</div><!-- container -->