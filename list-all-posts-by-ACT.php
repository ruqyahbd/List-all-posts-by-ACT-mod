<?php
/*
	Plugin Name: List all posts by Author, nested Categories and Titles
	Plugin URI: https://github.com/fmarzocca/List-all-posts-by-ACT
	Description: A plugin to list all posts by Author, nested Categories and Titles
	Version: 0.5
	Author: Fabio Marzocca
	Author URI: http://www.marzocca.net
	Text Domain:   list-all-posts-by-ACT
  	Domain Path:   /languages/
	License: GPL2
	
	Copyright 2015  by Fabio Marzocca  (email : marzoccafabio@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


defined('ABSPATH') or die("No script kiddies please!");
define('ATP_DIR', dirname(__FILE__));

require_once 'include/ACT-displayer.php';

/* Shortcode */

function fullindex( $atts) {
	$atts = shortcode_atts(array(
			'exclude'	=>	null,
			'admin'		=>	0
			 ), $atts);
	return hierarchy_indexes($atts);
	}
add_shortcode( 'ACT-list', 'fullindex' );

/* Localization */

function load_i18n(){
	load_plugin_textdomain( 'list-all-posts-by-ACT', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
	add_action( 'plugins_loaded', 'load_i18n' );

 
/* Add CSS */
	
function ACT_css(){
		wp_register_style( 'ACT_css', plugins_url( 'ACT.css' , __FILE__ ) );
		wp_enqueue_style( 'ACT_css' );
	} // function
add_action( 'wp_enqueue_scripts', 'ACT_css' );

?>