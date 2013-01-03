<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nttuyen_product_catalog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'bOI0C(6Lb5-oG?V/xntv`#wiuz,@`P$`XWKg7k %0SHxg~}W+b5|L(Qec?{zLa*N');
define('SECURE_AUTH_KEY',  'tlda=naS2uc=|2_@)^^D(;AlqWER04jY`oQ-L~~?br {3eC[uk@#:@NhjV:<F5d3');
define('LOGGED_IN_KEY',    'U39PE[PgZ5TusGLOL)J8]q;s?#%>F?t3M+)T9E00o;IoU!Dz-CQSwv^@~9T.@7.S');
define('NONCE_KEY',        'fuANX&,SJF4oCSh`?N1k~z-oyWlS]$!>Ojf3*4;M(%iaY90Yyb3J`Wl.<Aunw33E');
define('AUTH_SALT',        '[$faY]QCpL=jf^`u:iw:s$xp8Jx`PoGKO&30&TY8[DB{0mG]Z)xi$ONdDL,VGBv#');
define('SECURE_AUTH_SALT', 'A.nfcjwy)ElB5y2b;sH5)7)Kf;0Fv0>SHx<db6twVW2Mt+V}]QHy/NHnyxoK`9&S');
define('LOGGED_IN_SALT',   '$Dvw,TC?dhNi}307V1Uug?i/yD*T5ZU8SFhmS^  SHCaEi~2k@GB:E`Jbc/T9F+S');
define('NONCE_SALT',       ';~hcS3fx(-UC1*`t*e5!,ENwRhBOgP,}zBV>sYM{Am8>/d#t?)O@gMg%4zD-[jYJ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
