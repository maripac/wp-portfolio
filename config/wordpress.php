<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('APP_ROOT', dirname(__DIR__));
//define('APP_ENV', getenv('APPLICATION_ENV'));
define('APP_ENV', apache_getenv('APPLICATION_ENV'));
/**define('APP_ENV', 'development'); */

/** Require environment specific configuration */
/** For this to work the local.php file must be added to the gitignore file */
/** so that it does not exist in the production or staging environment */
if (file_exists(APP_ROOT . '/config/env/local.php')) {
	require APP_ROOT . '/config/env/local.php';
} else if (APP_ENV){
	require APP_ROOT . '/config/env/' . APP_ENV . '.php';
} else {
	require APP_ROOT . '/config/env/production.php';
}

define('WP_DEFAULT_THEME', 'Digstatic-o-theme');
/* Require composer autoload file*/
/* require APP_ROOT . '/vendor/autoload.php'; */

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

/**
 * define('WP_DEBUG', false);
 */


/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(dirname(__FILE__)) . '/public/wp-core/');
/** Sets up WordPress vars and included files. */
// var_dump(ABSPATH); die();
// weird hack because otherwise wp-cli won't load when this wp-settings.php file is loaded
if (!empty($_SERVER['HTTP_HOST']))
	require_once(ABSPATH . 'wp-settings.php');