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
define('DB_NAME', 'wp_multisite');

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


/**
 * #nttuyen multi-site 
 */
define('WP_ALLOW_MULTISITE',true);


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'OVo]A4JbVpJ,I^|*<y}`8;gX6mAFS{d%1#R}|lwuF01E5o<I).qr$C){AcjV4BFC');
define('SECURE_AUTH_KEY',  'sSfa9vzI39E*2a&3a[ig5dthFEA6$dDM_51V88A:z[nz$_wJQ6RNK5 e{4zgk=0/');
define('LOGGED_IN_KEY',    '?[Mh8c+$F%Lvtmj$3-7^<1}S>2QMT4[E{y#jC!Y~`=nSF+xSeCWGKwZu:Nad$ZCv');
define('NONCE_KEY',        'J_WzAdCJemtV-p]iBm{1[vlfUzp-3Z=n-^~WyQ&@HQb&~tB]@`YFz?n*y7ej``UR');
define('AUTH_SALT',        'lt=YTki4uDtN?Jg:pd1Jg`IIC`*<`t$ydo7Z`<OT{Cn`|v0$=9g>^dSz290,}]$u');
define('SECURE_AUTH_SALT', '{OTdo)J|zpvMk94L_;!DWbrsvd&-|BM`@@wh`Ao)J/&[=}`hX<f%B_,7K2{}{$91');
define('LOGGED_IN_SALT',   '`+(0=Zyb4(;; )icMQk-nN^ju7Q5egN,LFcWP0_PBd.,8}jZs~R*trAu8P32Dups');
define('NONCE_SALT',       '!lab<aEP0)qQR-sA-_QkIBR*gI$TY r*ElH4~8z%#2+#Pr/z/~/{k71q=,V(|-*%');

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
