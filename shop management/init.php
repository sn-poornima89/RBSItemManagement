<?php
/*
Plugin Name: Shop Management
Description: RBS shop management
Version: 0.3
Author: SharadhiInfotech
Author URI: https://www.sharadhiinfotech.com 
*/

//function to run on activation
function rbs_woocommerce_addon_activate() {
  
    if( !class_exists( 'WooCommerce' ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) );
        wp_die( __( 'This PlugIn Requires WooCommerce. Please install and Activate WooCommerce.', 'woocommerce-addon-slug' ), 'Plugin dependency check', array( 'back_link' => true ) );
    }
}

//sets up activation hook
register_activation_hook(__FILE__, 'rbs_woocommerce_addon_activate');


// function to create the DB / Options / Defaults					
function rbs_options_install() {

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
register_activation_hook(__FILE__, 'rbs_options_install');


//menu items
add_action('admin_menu','rbs_shops_modifymenu');
function rbs_shops_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Shops', //page title
	'Shops', //menu title
	'manage_options', //capabilities
	'rbs_shops_list', //menu slug
	'rbs_shops_list' //function
	);
	
	//this is the main item for the menu
	add_menu_page('Godowns', //page title
	'Godowns', //menu title
	'manage_options', //capabilities
	'rbs_godowns_list', //menu slug
	'rbs_godowns_list' //function
	);
	
	//this is the main item for the menu
	add_menu_page('Items Report', //page title
	'Items Report', //menu title
	'manage_options', //capabilities
	'rbs_items_list', //menu slug
	'rbs_items_list' //function
	);
	
	//this is a submenu
	add_submenu_page('rbs_shops_list', //parent slug
	'Add New Shop', //page title
	'Add New Shops', //menu title
	'manage_options', //capability
	'rbs_shops_create', //menu slug
	'rbs_shops_create'); //function
	
	//this is a submenu for godowns
	add_submenu_page('rbs_godowns_list', //parent slug
	'Add New Godowns', //page title
	'Add New Godowns', //menu title
	'manage_options', //capability
	'rbs_godowns_create', //menu slug
	'rbs_godowns_create'); //function
	
	//this is a submenu for items report
	add_submenu_page('rbs_items_list', //parent slug
	'Add New Item Report', //page title
	'Add New Item Report', //menu title
	'manage_options', //capability
	'rbs_items_create', //menu slug
	'rbs_items_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Shop', //page title
	'Update', //menu title
	'manage_options', //capability
	'rbs_shops_update', //menu slug
	'rbs_shops_update'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Item Report', //page title
	'Update', //menu title
	'manage_options', //capability
	'rbs_items_update', //menu slug
	'rbs_items_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'shops-list.php');
require_once(ROOTDIR . 'shops-create.php');
require_once(ROOTDIR . 'shops-update.php');
require_once(ROOTDIR . 'godowns-list.php');
require_once(ROOTDIR . 'godowns-create.php');
require_once(ROOTDIR . 'godowns-update.php');
require_once(ROOTDIR . 'items-list.php');
require_once(ROOTDIR . 'items-create.php');
require_once(ROOTDIR . 'items-update.php');
