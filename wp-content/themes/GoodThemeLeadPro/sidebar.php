<?
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<!-- BEGIN sidebar -->
<div id="side">

<?php if ($pov_distabs == "true") { } else { ?>
<?php include(TEMPLATEPATH."/tab.php");?>
<?php } ?>




<div id="sidebar">

	<!-- begin search -->
    <?php if ($pov_search == "true") { } else { ?>
    
	<div class="box">
	<h2>Search</h2>
	<div class="sear">
    <?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div> 	
	</div>
    
    <?php } ?>
	<!-- end search -->
	
    
    
    
    
    
	<!-- begin abut -->
    <?php if ($pov_dispop == "true") { } else { ?>
    
    
	<div class="box">
	<h2>About</h2>
	
	
		<div id="about">
		<?php 
		$img = get_option('pov_img'); 
		$about = get_option('pov_about'); 
		?>			
		<p class="text">
		<img src="<?php echo ($img); ?>" class="avatar" alt="About Me!" />
		<?php echo ($about); ?> 
		</p>
		</div>
    
        </div>
    
    	<?php } ?>
		<!-- end about -->
	
    
    
    
   
    <!-- begin ads -->
    <?php if ($pov_disads == "true") { } else { ?>
    
    
	<div class="box">    
	<h2>Ads</h2>    
	<div id="rekla">
	<div class="rekla">

	<ul>
	<li>
	<?php 
	$ban1 = get_option('pov_banner1'); 
	$url1 = get_option('pov_url1'); 
	?>
	<a href="<?php echo ($url1); ?>" rel="bookmark" title=""><img src="<?php echo ($ban1); ?>" alt="" /></a>
	</li>	

	<li>
	<?php 
	$ban2 = get_option('pov_banner2'); 
	$url2 = get_option('pov_url2'); 
	?>
	<a href="<?php echo ($url2); ?>" rel="bookmark" title=""><img src="<?php echo ($ban2); ?>" alt="" /></a>
	</li>

	<li>
	<?php 
	$ban3 = get_option('pov_banner3'); 
	$url3 = get_option('pov_url3'); 
	?>
	<a href="<?php echo ($url3); ?>" rel="bookmark" title=""><img src="<?php echo ($ban3); ?>" alt="" /></a>
	</li>

	<li>
	<?php 
	$ban4 = get_option('pov_banner4'); 
	$url4 = get_option('pov_url4'); 
	?>
	<a href="<?php echo ($url4); ?>" rel="bookmark" title=""><img src="<?php echo ($ban4); ?>" alt="" /></a>
	</li>

	</ul>

	</div>
	</div>
	</div>
    
    
    
    <?php } ?>
	<!-- end ads -->
    
    
    
    
    <!-- begin flickr photos -->
    <?php if ($pov_disflickr == "true") { } else { ?>
	<div class="box">
	<h2>Flickr Photos</h2>
	<p class="flickr">
    
    
    
    
    <!-- 
    
    for displaying flickr photos, just install and set up flickrRSS plugin; DOWNLOAD: http://wordpress.org/extend/plugins/flickr-rss/
    
    -->
    
    
	<?php if (function_exists('get_flickrRSS')) get_flickrRSS(); ?>
	</p>
	</div>
    <?php } ?>
	<!-- end flickr photos -->
    
    
    
	
	
	
	<!-- begin follow -->
    
    
	<div class="box">
    <?php if ($pov_disfollow == "true") { } else { ?>
	<h2>Follow Me!</h2>
<div id="social">

      <a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png" alt="Follow Me!" /></a>
      
      <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>"><img src="<?php bloginfo('template_directory'); ?>/images/stumbleupon.png" alt="Follow Me!" /></a>
      <a href="http://del.icio.us/post?url=<?php the_permalink() ?>"><img src="<?php bloginfo('template_directory'); ?>/images/delicious.png" alt="Follow Me!" /></a>
      
<?php $twit_user_name="#" ?>
<?php if (get_settings('pov_twitter_user_name')) { $twit_user_name = get_settings('pov_twitter_user_name') ; } ?>
<a href="http://twitter.com/<?php echo $twit_user_name; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="Follow Me!" /></a>

<?php $fac_user_name="#" ?>
<?php if (get_settings('pov_facebook_user_name')) { $fac_user_name = get_settings('pov_facebook_user_name') ; } ?>
<a href="http://facebook.com/<?php echo $fac_user_name; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="Follow Me!"/></a>

<?php $fli_user_name="#" ?>
<?php if (get_settings('pov_flickr_user_name')) { $fli_user_name = get_settings('pov_flickr_user_name') ; } ?>
<a href="http://flickr.com/<?php echo $fli_user_name; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/flickr.png" alt="Follow Me!" /></a>

      
</div>
	<?php } ?>
	<!-- end follow -->




	<!-- begin featured video -->
	<?php if ($pov_disvideo == "true") { } else { ?>
    
    
	<div class="box">
	<h2>Featured Video</h2>
	<div class="video">
	<?php 
	$video = get_option('pov_video_category'); // Number of other entries to be shown
	
	$my_query = new WP_Query('category_name= '. $video .'&showposts=1');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
	?>

	<?php the_content('Continue...'); ?>
 	<div class="fat"></div>
	<?php endwhile; ?>
	</div>
	</div>
    
    <?php } ?>
	<!-- end featured video -->
    


	<div class="dynamicsidebar">
	<ul>
    <li></li>
	<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(1) ) : ?>
        
			
        



	<?php endif; ?>
	</ul>
	
	</div>


	
	
	<!-- BEGIN half sidebars -->
	<?php include(TEMPLATEPATH."/left.php");?>
	<?php include(TEMPLATEPATH."/right.php");?>
	<!-- END half sidebars -->

</div>

</div>
<!-- END sidebar -->
