<?php
/*
Plugin Name:  Ywig Events
Plugin URI:   http://youthworkgalway.ie/
Description:  Display Posts by category in Bootstrap friendly way
Version:      1.0
Author:       moh
Author URI:   http://youthworkgalway.ie/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

if(!defined('ABSPATH')){
	exit;
}

//include scripts
require_once(plugin_dir_path(__FILE__).'/includes/ywigevents-scripts.php');

//include class
require_once(plugin_dir_path(__FILE__).'/includes/ywigevents-class.php');

//register widget
function register_ywigevents(){
	register_widget( 'Ywig_Events_Widget' );

}

add_action( 'widgets_init', 'register_ywigevents');