<?php
/* 
Plugin Name: Multi-url for wordpress 
Plugin URI: http://nttuyen.com 
Description: Show multi-url for wordpress, each url will show content of one category 
Author: nttuyen
Version: 1.0 
Author URI: http://nttuyen.com 
*/  

class MultiUrlPlugin {
	/**
	 * Filter: option_siteurl
	 * This method use to aler current URL when redirect
	 * For example, when you access admin panel, you'll be redirect to login before
	 * @param mixed $siteUrl
	 * @return mixed $siteUrl
	 */
	public function alerSiteUrl($siteUrl) {
		list($protocol, $url) = explode(':', $siteUrl);
		$url = str_replace('//', '', $url);
		
		$urlPaths = explode('/', $url);
		$urlPaths[0] = $_SERVER['SERVER_NAME'];
		
		
		$siteUrl = '';
		$siteUrl .= $protocol;
		$siteUrl .= ':/';
		foreach($urlPaths as $path) {
			$siteUrl .= '/';
			$siteUrl .= $path;
		}
		
		return $siteUrl;
	}
	
	/**
	 * @Filter: option_home
	 * Enter description here ...
	 * @param unknown_type $path
	 */
	public function alerSiteHome($path) {
		$path = $_SERVER['SERVER_NAME'];
	}
	
	public function choiceTemplateForSite($template) {
		global $wpdb;
		$url = $_SERVER['SERVER_NAME'];
		$theme = $wpdb->get_results('SELECT * FROM wp_multiurl u WHERE url LIKE \'%'.$url.'%\'', OBJECT);
		if(!empty($theme)) {
			$tpl = null;
			foreach ($theme as $tpl) {
				if($th = get_theme($tpl->theme)) {
					$template = $th['Template'];
					break;
				}
			}
		}
		return $template;
	}
	
	public static function defaultCategoryOfURL($notused) {
		global $wp_query, $wpdb;
		global $gloss_category;
		
		$url = $_SERVER['SERVER_NAME'];
		$defaultCat = '';
		
		$query = 'SELECT cat_id FROM wp_url_cat c JOIN wp_multiurl u ON u.id = c.url_id WHERE u.url LIKE \'%'.$url.'%\'';
		$cats = $wpdb->get_results($query);
		$cat = array();
		foreach($cats as $c) {
			$cat[] = $c->cat_id;
		}
		
		if(is_home()){
			$wp_query->query_vars['cat'] = implode(',', $cat);
		}
	}
	
	public static function getCategories($args) {
		if(is_admin()) return $args;
		//var_dump($args);
		global $wp_query, $wpdb;
		global $gloss_category;
		
		$url = $_SERVER['SERVER_NAME'];
		$query = 'SELECT cat_id FROM wp_url_cat c JOIN wp_multiurl u ON u.id = c.url_id WHERE u.url LIKE \'%'.$url.'%\'';
		$cats = $wpdb->get_results($query);
		$cat = array();
		foreach($cats as $c) {
			$cat[] = $c->cat_id;
		}
		$args['include'] = $cat;
		
		
		return $args;
	}
	
}

add_filter('option_siteurl', array('MultiUrlPlugin', 'alerSiteUrl'));
add_filter('option_home', array('MultiUrlPlugin', 'alerSiteHome'));
add_filter('stylesheet', array('MultiUrlPlugin', 'choiceTemplateForSite'));
add_filter('get_terms_args', array('MultiUrlPlugin', 'getCategories'));
add_filter('pre_get_posts', array('MultiUrlPlugin', 'defaultCategoryOfURL'));


//

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'wp_multi_url_admin.php';
add_action('admin_menu', array('MultiUrlPluginAdmin', 'adminMenu'));