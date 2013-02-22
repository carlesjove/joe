<?php

/** 
 * Get Post Attachements
 * Must use in the loop
 */
function get_post_attachements($args=array()) {
	global $post;
	
	/*
	$defaults = array(
		'posts_per_page'  => 5,
		'offset'          => 0,
		'category'        => ,
		'orderby'         => 'post_date',
		'order'           => 'DESC',
		'include'         => ,
		'exclude'         => ,
		'meta_key'        => ,
		'meta_value'      => ,
		'post_type'       => 'post',
		'post_mime_type'  => 'image/jpeg',
		'post_parent'     => ,
		'post_status'     => 'publish',
		'suppress_filters' => true
	);
	*/

	$attachments = get_posts(array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'post_parent' => $post->ID,
		'exclude'     => get_post_thumbnail_id()
	));	
	if ( $attachments ) {
		return $attachments;
	}
	return false;
}

/** 
 * Get First Image
 */
function get_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "/path/to/default.png";
  }
  return $first_img;
}
