<?php
/*
Plugin Name: Ultimate Video Player
Plugin URI: http://codecanyon.net/user/FWDesign/portfolio
Description: This is the WordPress plugin with a CMS menu for the installation and configuration of the Ultimate Video Player.
Text Domain: fwduvp
Author: FWDesign
Version: 9.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

include_once "php/FWDUVP.php";
include_once "php/FWDUVPData.php";
define('FWDUVP_TEXT_DOMAIN',  wp_get_theme()->get('TextDomain'));


function fwduvp_check_if_admin(){
	$roles = wp_get_current_user()->roles;
	$role = "administrator";
	 
	return in_array($role, $roles);
}

function fwduvp_admin_init(){
	if (fwduvp_check_if_admin()){
		$role = get_role("administrator");
		$role->add_cap(FWDUVP::CAPABILITY);
	}
}

function fwduvp_init_plugin(){	
	$uvp = new FWDUVP();
	$uvp->init();
}

add_action("init", "fwduvp_init_plugin");
add_action("admin_init", "fwduvp_admin_init");
add_filter("plugin_action_links_" . plugin_basename(__FILE__), array("FWDUVP", "fwduvp_set_action_links"));
?>