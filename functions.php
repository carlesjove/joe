<?php

get_joe();

function get_joe() {
	$joe_functions = array(
		'get_post_attachements',
		'get_first_image',
		'theme_uri',
		'featured_img_uri',
		'page_title',
		'post_categories',
	);
	
	$errors = array();
	
	foreach ($joe_functions as $function) {
		if ( function_exists('joe_'.$function) ) {
			$errors[] = "<strong>{$function}</strong> already exists.";
		}
	}
	
	if ( count($errors) > 0 ) {
		echo "Some of Joe's functions already exist in your working environment."
			 ."This can lead to issues, so Joe's files have not been included."
			 ."Here's the conflictive functions, in case you want to make something about it:"
			 ."<ul>";
		foreach ($errors as $error) {
			echo "<li>{$error}</li>";
		}
		echo "</ul>";
	} else {
		include 'inc/joe/joe.php';
	}
}