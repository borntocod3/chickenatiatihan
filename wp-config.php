<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'chickenatiatihan');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&huN3ED!U4]zHDF:JP{MBDixX H=urL)Xqj/,~_@40-RlEI63k2HMK<|~eJA:]f(');
define('SECURE_AUTH_KEY',  '.h8;F(?)p=+V%4e5<*?})ToMtfU%x@NA<*_4k.T F6m{G!&ATOF- JT<Y+|(F0z#');
define('LOGGED_IN_KEY',    'fq1dg@<[&Cu=5oHdH{`U%Ll g1+LlF]:]DB6_;xw.uX~Qk~gVZ)A`eqC(D&bDir*');
define('NONCE_KEY',        '>93ZBTNBrA@_Eh+0HUK/Zy|^.-gP5WgwVn%)]:EfDR!- m=C-#<,n2hiE($pY_,Y');
define('AUTH_SALT',        'G|{@s2Tjmkz.?2z|^#U;DU-_- 8a+ouX<f_ng*O|3kfA3*4ObR:Oazpv?|q1#$R$');
define('SECURE_AUTH_SALT', '3xB>uSPWZ,V1|DN]h+H;o)z-0`5r;2Qb]7a!-F`t;0;D+`}P,w$5?16.Kds79<ch');
define('LOGGED_IN_SALT',   '-/jLB@-S~74rt`^3%7/x#,F?E?hIIL^|JyU`2,l^|[TvEB|ij;|~6M(tr*n7VG}`');
define('NONCE_SALT',       'O*ux[Zu[g|$c>NON-iv9e)J/@Q2^|o-x2x@@3n(>gTW`16b)0?nr%c/vRr!/@Vr|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

// define('FS_METHOD','direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
