<?php

/**
*  Plugin Name: Autoloader File
*  Description: This is an autoloader file. It makes use of PHP’s __autoload() function to dynamically pull in the classes being used.
*  Author: Maripac
*  Version: 1.0
*  
*/


/**
*  Better Organization
*
*  Another benefit of OOP is how well it lends itself to being easily packaged and cataloged. Each class can
*  generally be kept in its own separate file, and if a uniform naming convention is used, accessing the
*  classes is extremely simple.
*  Assume you’ve got an application with 150 classes that are called dynamically through a controller
*  file at the root of your application filesystem. All 150 classes follow the naming convention
*  class.classname.inc.php and reside in the inc folder of your application.
*  The controller can implement PHP’s __autoload() function to dynamically pull in only the classes it
*  needs as they are called, rather than including all 150 in the controller file just in case or coming up with
*  some clever way of including the files in your own code:
*
* ___________________________________________________________________________________
* |--------------------------------------------------------------------------------||
* | PHP’s __autoload() function to dynamically pull in only the classes being used ||
* |________________________________________________________________________________||
* |                                                                                ||
* | function __autoload($class_name)                                               ||
* | {                                                                              ||
* | include_once 'inc/class.' . $class_name . '.inc.php';                          ||
* | }                                                                              ||
* |                                                                                ||
* |________________________________________________________________________________||
* -----------------------------------------------------------------------------------
*/


spl_autoload_register(function ($class) {
	
/**
 * If the autoloader gets a Namespaced ClassName it will look something like this "\\Namespace\\Othernamespace\\ClassName" 
 *
 * Namespacing to the rescue! You can declare the same 
 * function, class, interface and constant definitions in
 * separate namespaces without receiving fatal errors. 
 * Essentialy, a namespace is nothing more than a 
 * hierarchically labeled code block holding regular 
 * PHP code.
 *
 * 
 * We have to break the string into these escaped backslashes
 * Then look for the file in folders according to their 
 * namespaces
 *
 * @var array $segments will store the pieces of our Namespace ClassName
 * 
 */

	$segments = array_filter(explode("\\", $class));
	
	$first = array_shift($segments);

	/**
	 * Identify which classes must be searched for running object methods by the namespace WPPlugins 
	 *
	 * Since every class we are going to
	 * call that's in this directory begins
	 * with the namespace WPPlugins. 
	 *
	 * checkout ContentType.php inside of
	 * contenido>classes>WPExtend>ContentType.php
	 *
	 * namespace WPPlugins\WPExtend;
	 */

	if ($first === "WPPlugins") {

		$path = dirname(__DIR__) . "/admin/" . implode("/", $segments) . ".php";

		if (file_exists($path)) {
			include $path;
		}

	} 
	
});
