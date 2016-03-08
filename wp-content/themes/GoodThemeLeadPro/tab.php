<!-- TABS STARTS --> 
	<div id="tabs">
		
		<ul class="gttTabs tabs">
			<li><a href="#pop">Popular</a></li>
			<li><a href="#feat">Latest</a></li>
            <li><a href="#comm">Comments</a></li>
			<li><a href="#tagcloud">Tags</a></li>
            <li><a href="#sub">Subscribe</a></li>
		</ul>	
		
		<div class="fix"></div>
		
		<div class="inside">
		 <div id="pop">
			<ul>
                <?php include(TEMPLATEPATH . '/includes/popular.php' ); ?>                    
			</ul>
           </div>
           
         <div id="feat"> 
	        <ul>
				<?php 
					$the_query = new WP_Query('cat=' . $ex_feat . '&showposts=10&orderby=post_date&order=desc');	
					while ($the_query->have_posts()) : $the_query->the_post(); $do_not_duplicate = $post->ID;
				?>
				<li>
                <a href="<?php the_permalink(); ?>"><?php dp_attachment_image($post->ID, 'small', 'alt="' . $post->post_title . '"'); ?></a> 
                <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
                
				<?php endwhile; ?>		
			</ul>
          </div>
          <div id="comm">  
			<ul>
                <?php include(TEMPLATEPATH . '/includes/comments.php' ); ?>                    
			</ul>
	      </div>
			<div id="tagcloud">
                <div>
				    <?php wp_tag_cloud('smallest=12&largest=20'); ?>
                </div>
			</div>
		
        <div id="sub">
	        <ul>
				<li><h3>Stay up to date</h3><a href="<?php if ( get_option('gtt_feedburner_url') <> "" ) { echo get_option('gtt_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ico-rss.gif" alt="" /></a></li>
				<li><a href="<?php if ( get_option('gtt_feedburner_url') <> "" ) { echo get_option('gtt_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>">Subscribe to the RSS Feed</a></li>
				<li><a href="http://www.feedburner.com/fb/a/emailverifySubmit?feedId=<?php $feedburner_id = get_option('gtt_feedburner_id'); echo $feedburner_id; ?>" 	target="_blank">Subscribe to the feed via email</a></li>
			</ul>            
        </div>
		</div>
		
	</div>
	
	
	 
	<!-- TABS END -->
