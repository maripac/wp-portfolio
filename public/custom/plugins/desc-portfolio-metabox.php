<?php
/**
 *
 * Plugin Name: Sample Metabox for Portfolio
 * Plugin URI: https://github.com/maripac/wp-distimming
 * Description: This file instantiates objects whose properties and methods are defined in the class ContentType, ContentTax and ContentMeta. Actions are the hooks that the WordPress core launches at specific points during execution, or when specific events occur. Plugins can specify that one or more of its PHP functions are executed at these points, using the Action API.
 * Version: 1.0
 * Author: Maripac
 * Author URI: https://gostak.io
 * License: GPL2
 */
/**
 * Copyright 2015 María Pérez-Pujazón  |maria(@)gostak(.)io|
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
add_action( 'add_meta_boxes', 'add_portfolio_metaboxes' );

// Add the Events Meta Boxes
/**
 * Argument			Data 	Type Required	Optional	Default
 * $id 				string		X						No default
 * $title			string		X						No default
 * $callback		string		X						No default
 * $page			string		X						No default
 * $context			string						X		advanced
 * $priority		string						X		required
 * $callback_args	array						X		null
 */
function add_portfolio_metaboxes() {
	add_meta_box('wpt_portfolio_describe', 'Work Description', 'wpt_portfolio_describe', 'portfolio', 'normal', 'high');
	add_meta_box('wpt_portfolio_year', 'Work Date', 'wpt_portfolio_year', 'portfolio', 'normal', 'high');	
}

// The Event Location Metabox

// The Event Location Metabox

function wpt_portfolio_describe() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="portfoliometa_noncename" id="portfoliometa_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';



//$plugin_path = dirname(plugin_basename(__FILE__));
	
	// Get the location data if its already been entered
	$desc_portfolio = get_post_meta($post->ID, '_desc_portfolio', true);
	
	// Echo out the field
        echo '<p>Enter a Description:</p>';
		echo '<textarea rows="4" cols="50" name="_desc_portfolio" class="widefat"> ' . $desc_portfolio . ' </textarea>';
//Enter text here...</textarea><textarea type="text" name="_location" value="' . $location  . '" class="widefat" />';

}
// The Event Location Metabox

function wpt_portfolio_year() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="portfoliometa_noncename" id="portfoliometa_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';



//$plugin_path = dirname(plugin_basename(__FILE__));
	
	// Get the location data if its already been entered
    $portfolio_year = get_post_meta($post->ID, '_portfolio_year', true);
	
	// Echo out the field

        echo '<p>Year of production</p>';
        echo '<input type="text" name="_portfolio_year" value="' . $portfolio_year  . '" class="widefat" />';

}

// Save the Metabox Data

function wpt_save_portfolio_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !isset( $_POST['portfoliometa_noncename'] ) || !wp_verify_nonce( $_POST['portfoliometa_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	
	$portfolio_meta['_desc_portfolio'] = $_POST['_desc_portfolio'];
	$portfolio_meta['_portfolio_year'] = $_POST['_portfolio_year'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($portfolio_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpt_save_portfolio_meta', 1, 2); // save the custom fields


