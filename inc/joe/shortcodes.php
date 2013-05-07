<?php

/**
 * Image list
 */
function joe_shortcode_image_list( $atts, $content = null ) {
	$html = str_get_html($content);
	
	foreach($html->find('img') as $element) 
	       $img[] = '<li><img src="'.$element->src.'" alt="" /></li>';
	
	$imgs = implode($img);
	
	return '<ul class="joe-image-list">' . do_shortcode($imgs) . '</ul>';
}
add_shortcode('image_list', 'joe_shortcode_image_list');