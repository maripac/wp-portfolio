<?php
/**
 *
 * Plugin Name: WP App Bootstraping
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


add_action('plugins_loaded', function () {

	$snippets = new WPPlugins\WPExtend\ContentType('snippets', [
	    'supports' => ['editor', 'title', 'custom-fields', 'author', 'thumbnail', 'comments'],
	    'taxonomies' => ['languages']
	], [
	    'singular_name' => "Snippet"
    ]);
	$portfolio = new WPPlugins\WPExtend\ContentType('portfolio', [
	    'supports' => ['editor', 'title', 'custom-fields', 'author', 'thumbnail'],
	    'taxonomies' => ['fields']
	], [
	    'singular_name' => "Work",
	    'plural_name' => "Portfolio"
    ]);

	$languages = new WPPlugins\WPExtend\ContentTax('languages', ['post', 'snippets'], [], [
	    'singular_name' => "Language",
	    'plural_name' => "Languages"
    ]);

	$languages = new WPPlugins\WPExtend\ContentTax('fields', ['portfolio'], [], [
	    'singular_name' => "Field",
	    'plural_name' => "Fields"
    ]);
});

