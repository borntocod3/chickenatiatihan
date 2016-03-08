<?php

$includes_path = TEMPLATEPATH . '/includes/';
require_once(TEMPLATEPATH . '/dashboard.php'); 


if ( function_exists('register_sidebars') )
    register_sidebars(6);
?>
<?php
function widget_mytheme_search() {
?>
<h2>Search</h2>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/"> <input type="text" value="Search: type and hit enter!" onfocus="if (this.value == 'Search: type and hit enter!') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search: type and hit enter!';}" size="18" maxlength="50" name="s" id="s" /> </form> 
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_mytheme_search');
?>
<?php
add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if(!function_exists('wp_list_comments')) : // WP 2.7-only check
		$file = TEMPLATEPATH . '/legacy.comments.php';
	endif;
	return $file;
}

function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');

# Displays a list of pages
function dp_list_pages() {
	global $wpdb;
	$querystr = "SELECT $wpdb->posts.ID, $wpdb->posts.post_title FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'page' ORDER BY $wpdb->posts.post_title ASC";
	$pageposts = $wpdb->get_results($querystr, OBJECT);
	if ($pageposts) {
		foreach ($pageposts as $post) {
			?><li><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></li><?php 
		}
	}
}

# Displays a list of categories
function dp_list_categories($num=0, $exclude='') {
	if (strlen($exclude)>0) $exclude = '&exclude=' . $exclude;
	$categories = get_categories('hide_empty=1'.$exclude);
	$first = true; $count = 0;
	foreach ($categories as $category) {
		if ($num>0) { $count++; if ($count>$num) break; } // limit
		if ($category->parent<1) {
			if ($first) { $first = false; $f = ' class="f"'; } else { $f = ''; }
			?><li<?php echo $f; ?>>
			<a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->name ?><?php echo $raquo; ?></a></li>
			<?php
		}
	}
}

# Displays a list of popular posts
function dp_popular_posts($num, $pre='<li>', $suf='</li>', $excerpt=true) {
	global $wpdb;
	$querystr = "SELECT $wpdb->posts.post_title, $wpdb->posts.ID, $wpdb->posts.post_content FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' ORDER BY $wpdb->posts.comment_count DESC LIMIT $num";
	$myposts = $wpdb->get_results($querystr, OBJECT);
	foreach($myposts as $post) {
		echo $pre;
		?><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title ?></a><?php
		if ($excerpt) {
			?><p><?php echo dp_clean($post->post_content, 120); ?>...</p><?php
		}
		echo $suf;
	}
}

# Displays a list of recent categories
function dp_recent_comments($num, $pre='<li>', $suf='</li>') {
	global $wpdb, $post;
	$querystr = "SELECT $wpdb->comments.comment_ID, $wpdb->comments.comment_post_ID, $wpdb->comments.comment_author, $wpdb->comments.comment_content, $wpdb->comments.comment_author_email FROM $wpdb->comments WHERE $wpdb->comments.comment_approved=1 ORDER BY $wpdb->comments.comment_date DESC LIMIT $num";
	$recentcomments = $wpdb->get_results($querystr, OBJECT);
	foreach ($recentcomments as $rc) {
		$post = get_post($rc->comment_post_ID);
		echo $pre;
		?><strong><a href="<?php the_permalink() ?>#comment-<?php echo $rc->comment_ID ?>"><?php echo $rc->comment_author ?></a></strong> on <a href="<?php the_permalink() ?>#comment-<?php echo $rc->comment_ID ?>"><?php echo $post->post_title; ?></a><?php
		echo $suf;
	}
}


# Displays post image attachment (sizes: thumbnail, medium, full)
function dp_attachment_image($postid=0, $size='thumbnail', $attributes='') {
	if ($postid<1) $postid = get_the_ID();
	if ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
		foreach($images as $image) {
			$attachment=wp_get_attachment_image_src($image->ID, $size);
			?><img src="<?php echo $attachment[0]; ?>" <?php echo $attributes; ?> /><?php
		}
}

# Removes tags and trailing dots from excerpt
function dp_clean($excerpt, $substr=0) {
	$string = strip_tags(str_replace('[...]', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
}

# Displays the comment authors gravatar if available
function dp_gravatar($size=50, $attributes='', $author_email='') {
	global $comment, $settings;
	if (dp_settings('gravatar')=='enabled') {
		if (empty($author_email)) {
			ob_start();
			comment_author_email();
			$author_email = ob_get_clean();
		}
		$gravatar_url = 'http://www.gravatar.com/avatar/' . md5(strtolower($author_email)) . '?s=' . $size . '&amp;d=' . dp_settings('gravatar_fallback');
		?><img src="<?php echo $gravatar_url; ?>" <?php echo $attributes ?>/><?php
	}
}

# Retrieves the setting's value depending on 'key'.
function dp_settings($key) {
	global $settings;
	return $settings[$key];
}


// Load Javascript in wp_head
require_once ($includes_path . 'theme-js.php');
?>