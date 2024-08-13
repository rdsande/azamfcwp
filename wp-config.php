<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'azamfc' );

/** Database username */
define( 'DB_USER', 'rootadmin' );

/** Database password */
define( 'DB_PASSWORD', 'rootadmin' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'rG4!}qEzT@H<>8!zI w,0QzLc8j6tKph A]I=qcQHUM[=cc/i#HK?C3,UN@+|)wV' );
define( 'SECURE_AUTH_KEY',  '1fv#$*=rVd0a>i9q=2;cD_g=}CQTn1U),N x}2/5Jcz%[hD~jH!3w?*gqbN;umP ' );
define( 'LOGGED_IN_KEY',    'ds]ksQ3TwZ:}FFmY}3q-0I.uX:K8j<}08j)8$u:O6JY?hy6|q4MuC*.K&2(hHQPm' );
define( 'NONCE_KEY',        '3M@8tGpa-vLOPy-]gU~M-;gLU-g07S(gW.}V/_XgsdKG2V$::U@TSYRiz1S6OO#y' );
define( 'AUTH_SALT',        '<TMbO4poxmnpXXBLYlskTzXv+U<.no9NcpI<_<)!Djw~IBrn%4#@}HwtH}xL`8+?' );
define( 'SECURE_AUTH_SALT', '`KZU]Nl6F/S+5?lklsn0IYG@d[p|I?r)t{b.8==nbq{+_K$qgIV-pqex0yIFvzs2' );
define( 'LOGGED_IN_SALT',   '0}hQ@AuE3e9D][(ZN:JM8p>J[/!UB;|||9k^*$eP=3{X3Or<<B>>{#r_ufPJ)./-' );
define( 'NONCE_SALT',       'h|tKr?b&*KATPFU#&M?*orBPUFE?n2,L4X)W1#_@95I)PV3MFi)_8VvXje ueg>X' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';