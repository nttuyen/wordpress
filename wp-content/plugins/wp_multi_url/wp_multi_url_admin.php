<?php
class MultiUrlPluginAdmin {
	protected static $errors = array();
	protected static $templates;
	protected static $categories;
	protected static $urls;
	protected static $url;
	
	public static function adminMenu() {
		add_options_page('Multi-url admin', 'Multi-url admin', 'manage_options', 'multi-url-admin', array('MultiUrlPluginAdmin', 'adminHome'));
	}
	
	public static function adminHome() {
		if(!current_user_can('manage_options')) {
			wp_die('You have not permission to access this page');
		}
		
		
		self::adminProcess();
		
		//List all URL
		self::getAllData();
		$task = $_REQUEST['task'];
		if('edit' == $task) { 
			include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'url_edit.php';
		} else {
			include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'url.php';
		}
	}
	
	public static function adminProcess() {
		$action = $_REQUEST['action'];
		if(empty($action)) return true;
		
		switch ($action) {
			case 'add':
				return self::addURL();
			case 'update':
				return self::updateURL();
			case 'delete':
				return self::deleteURL();
			default: return true;
		}
	}
	
	protected static function getAllData() {
		self::$categories = get_categories('all');
		self::$templates = get_themes();
		
		//TODO: Get All URL
		global  $wpdb;
		self::$urls = $wpdb->get_results('SELECT u.* FROM wp_multiurl u', OBJECT_K);
		$id = $_REQUEST['id'];
		
		foreach (self::$urls as &$u) {
			$catIds = $wpdb->get_results('SELECT cat_id FROM wp_url_cat WHERE url_id = ' . $u->id, OBJECT);
			$catId = array();
			foreach($catIds as $cat) {
				$catId[] = $cat->cat_id;
			}
			$u->cat_ids = $catId;
			$u->categories = get_categories($catId);
			if(!empty($id) && $u->id == $id) {
				self::$url = $u;
			}
		}
	}
	protected static function addURL() {
		global $wpdb;
		
		$url = $_REQUEST['url'];
		$cats = $_REQUEST['cat'];
		$theme = $_REQUEST['theme'];
		if(empty($url) || empty($cats) || empty($theme)) {
			array_push(self::$errors, 'You must input: URL, Categories and theme in a valid format');
		}
		
		$wpdb->insert('wp_multiurl', array('url' => $url, 'description'=>'', 'theme' => $theme));
		$urlID = $wpdb->insert_id;
		$wpdb->query('DELETE FROM wp_url_cat WHERE url_id = '.(int)$urlID);
		foreach($cats as $cat) {
			$wpdb->insert('wp_url_cat', array('url_id' => $urlID, 'cat_id' => $cat));
		}
	}
	
	protected static function updateURL() {
		global $wpdb;
		
		$url = $_REQUEST['url'];
		$cats = $_REQUEST['cat'];
		$theme = $_REQUEST['theme'];
		$id = $_REQUEST['id'];
		if(empty($url) || empty($cats) || empty($theme)) {
			array_push(self::$errors, 'You must input: URL, Categories and theme in a valid format');
		}
		
		$wpdb->update('wp_multiurl', array('url' => $url, 'description'=>'', 'theme' => $theme), array('id' => $id));
		$urlID = $id;
		$wpdb->query('DELETE FROM wp_url_cat WHERE url_id = '.(int)$urlID);
		if(!empty($cats)) {
			foreach($cats as $cat) {
				$wpdb->insert('wp_url_cat', array('url_id' => $urlID, 'cat_id' => $cat));
			}
		}
		
		$wpdb->update('', $data, $where);
	}
	
	protected static function deleteURL() {
		
	}
	
	//edit_category_form_pre
	public static function alerCategoryForm() {
		var_dump(func_get_args());die;
	}
}