<?php
/* 
Plugin Name: Multi-url for wordpress 
Plugin URI: http://nttuyen.com 
Description: Show multi-url for wordpress, each url will show content of one category 
Author: nttuyen
Version: 1.0 
Author URI: http://nttuyen.com 
*/  

function rootURL($path){
	//var_dump($path);die;
	$path = $_SERVER['SERVER_NAME'];
}

function defaultCategoryOfURL($notused){
	global $wp_query;
  	global $gloss_category;
	
	$url = $_SERVER['SERVER_NAME'];
	$defaultCat = '';
	
	switch ($url){
		case 'wordpress1.nttuyen.com':
			$defaultCat = 3;
			break;
		case 'wordpress2.nttuyen.com':
			$defaultCat = 4;
			break;
		default:
			break;
	}
	
	if(is_home()){
		$wp_query->query_vars['cat'] = $defaultCat;
	}
}

function templateOfURL(){
	$url = $_SERVER['SERVER_NAME'];
	$template = 'twentyeleven';
	switch ($url){
		case 'wordpress2.nttuyen.com':
			$template = 'bluesky';
			break;
		default:
			break;
	}
	//return 'bluesky';
	return $template;
}

add_filter('option_home', 'rootURL');
add_filter('pre_get_posts', 'defaultCategoryOfURL');
add_filter('stylesheet', 'templateOfURL');
