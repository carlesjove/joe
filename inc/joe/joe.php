<?php
/** 
 * Honest Joe's Custom WordPress Functions
 * Just a set of useful WordPress functions for your everyday life
 *
 * @version 0
 * @author Carles Jove i Buxeda | http://joanielena.cat
 */

/** 
 * Get Post Attachements
 * Must use in the loop
 */
function joe_get_post_attachements($args=array()) {
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
function joe_get_first_image() {
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

/**
 * Theme URI
 * Shorter way to get the theme URI
 */
function joe_theme_uri($path=null) {
	$uri = get_stylesheet_directory_uri(); 	
	if (isset($path)) {
		$uri .= '/'.$path;
	}
	return $uri;
}

/**
 * Featured img URI
 * Just get the featured img URI. No stupid mark-up
 */
function joe_featured_img_uri() {
	global $post;
	return wp_get_attachment_url(get_post_thumbnail_id($post->ID));
}

/**
 * Page title
 * Returns the actual page title
 */
function joe_page_title() {
	$title = get_bloginfo( 'name' );
	wp_title( '|', true, 'right' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";
	return $title;
}

/**
 * Post Categories
 * Returns the slug of all post categories as plain text
 * 
 * @return string
 */
function joe_post_categories(){
	global $post;
	$cats = wp_get_post_categories($post->ID);
	foreach($cats as $c){
		$cat = get_category( $c );
		$categories[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
	}
	
	$post_cats = '';
	foreach($categories as $c){
		$post_cats .= $c['slug'].' ';
	}
	
	return $post_cats;
}
