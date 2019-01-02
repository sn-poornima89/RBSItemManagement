<?php
/*
Plugin Name: Schools
Description:
Version: 1
Author: sinetiks.com
Author URI: http://sinetiks.com
*/
// function to create the DB / Options / Defaults					
function ss_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "shops";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` varchar(3) CHARACTER SET utf8 NOT NULL,
            `name` varchar(50) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'ss_options_install');

//menu items
add_action('admin_menu','sinetiks_shops_modifymenu');
function sinetiks_shops_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Shops', //page title
	'Shops', //menu title
	'manage_options', //capabilities
	'sinetiks_shops_list', //menu slug
	'sinetiks_shops_list' //function
	);
	
	//this is the main item for the menu
	add_menu_page('Godowns', //page title
	'Godowns', //menu title
	'manage_options', //capabilities
	'sinetiks_godowns_list', //menu slug
	'sinetiks_godowns_list' //function
	);
	
	//this is a submenu
	add_submenu_page('sinetiks_shops_list', //parent slug
	'Add New Shop', //page title
	'Add New Shops', //menu title
	'manage_options', //capability
	'sinetiks_shops_create', //menu slug
	'sinetiks_shops_create'); //function
	
	//this is a submenu for godowns
	add_submenu_page('sinetiks_godowns_list', //parent slug
	'Add New Godowns', //page title
	'Add New Godowns', //menu title
	'manage_options', //capability
	'sinetiks_godowns_create', //menu slug
	'sinetiks_godowns_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Shop', //page title
	'Update', //menu title
	'manage_options', //capability
	'sinetiks_shops_update', //menu slug
	'sinetiks_shops_update'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Godown', //page title
	'Update', //menu title
	'manage_options', //capability
	'sinetiks_godowns_update', //menu slug
	'sinetiks_godowns_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'shops-list.php');
require_once(ROOTDIR . 'shops-create.php');
require_once(ROOTDIR . 'shops-update.php');
require_once(ROOTDIR . 'godowns-list.php');
require_once(ROOTDIR . 'godowns-create.php');
require_once(ROOTDIR . 'godowns-update.php');