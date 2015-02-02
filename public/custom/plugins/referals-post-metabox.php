<?php
/**
 *
 * Plugin Name: Metaboxes for Snippets
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
add_action( 'add_meta_boxes', 'add_gig_metaboxes_b' );

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
function add_gig_metaboxes_b() {
	add_meta_box('wpt_gig_referal', 'URI Location', 'wpt_gig_referal', 'snippets', 'normal', 'high');
	add_meta_box('wpt_gig_referal_alias', 'alias for the URI', 'wpt_gig_alias', 'snippets', 'normal', 'high');
	add_meta_box('wpt_gig_description', 'Description', 'wpt_gig_description', 'snippets', 'normal', 'high');	
}

// The Event Location Metabox

// The Event Location Metabox

function wpt_gig_referal() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="gigmeta_noncename2" id="gigmeta_noncename2" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';



//$plugin_path = dirname(plugin_basename(__FILE__));
	
	// Get the location data if its already been entered
	$referal = get_post_meta($post->ID, '_referal', true);

	
	// Echo out the field
        echo '<p>Enter the Source URL:</p>';
		echo '<input type="url" name="_referal" value="' . $referal  . '" class="widefat" />';


}
function wpt_gig_alias() {
	global $post;

	echo '<input type="hidden" name="gigmeta_noncename2" id="gigmeta_noncename2" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$alias = get_post_meta($post->ID, '_alias', true);
	echo '<p>Enter an alias for the URL:</p>';
	echo '<input type="text" name="_alias" value="' . $alias  . '" class="widefat" />';
// The Event Location Metabox
}
function wpt_gig_description() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="gigmeta_noncename2" id="gigmeta_noncename2" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';



//$plugin_path = dirname(plugin_basename(__FILE__));
	
	// Get the location data if its already been entered
    $description = get_post_meta($post->ID, '_description', true);
	
	// Echo out the field

        //echo '<p>Please enter a Description for this Snippet:</p>';
        //echo '<textfield type="text" name="_description" value="' . $dresscode  . '" class="widefat" placeholder="Describe Snippet usage..." />';
        echo '<textarea name="_description" class="widefat" placeholder="Describe Snippet usage...">' . $description  . '</textarea>';

}

// Save the Metabox Data

function wpt_save_gig_meta_b($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !isset( $_POST['gigmeta_noncename2'] ) || !wp_verify_nonce( $_POST['gigmeta_noncename2'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	
	$gig_meta['_referal'] = $_POST['_referal'];
	$gig_meta['_alias'] = $_POST['_alias'];
	$gig_meta['_description'] = $_POST['_description'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($gig_meta as $key => $value) { // Cycle through the $events_meta array!
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

add_action('save_post', 'wpt_save_gig_meta_b', 1, 2); // save the custom fields


