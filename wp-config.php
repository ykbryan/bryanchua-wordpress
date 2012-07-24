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
define('DB_NAME', 'bryanchua');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY',         ')(#wZd !pT(exXkPn&HE%`:=*D3l{DJ9<w8KO7.Y{Iw8|s|^^gv>4:+nLj6gUO<t');
define('SECURE_AUTH_KEY',  '{P}LA`h&9 z~E#P8pr(w+fwv!I )+I|O/tg:0xtkAD2]G[ABsEX+frgE-_U4$qdw');
define('LOGGED_IN_KEY',    '#.v-+@q)n-slLxUeWxU;W4|#K}@T$-,yfEZykxk2zHC|wtJ&59EqEma-/t%)?,@+');
define('NONCE_KEY',        '|1-1gQ/^nj&+Gs?W=,+As81R0B9tWtkl#?wZRC)cfO9P#(=o;fIOyBN;]*10A*g|');
define('AUTH_SALT',        'W6nOPS?vQYUdcy>t6xPVy]:vSdE1ENB-|pFZJ3?eb6cZ,_mJZ%E8MG?462BI+cS%');
define('SECURE_AUTH_SALT', 'wYWLS?Y:>+gCFODU)8_5Isd9P&.#hz%Ej1k-%?ChW(Sv+4qYaHa*a-`s-<yWE}O*');
define('LOGGED_IN_SALT',   'd<8uGY!:L:5k}(?PP/R]pXxm_L.;JgRhBR!S,x|jm=>,IVy1(gGxxgJ,cp`:B5 e');
define('NONCE_SALT',       'j6g>bNL$8.)hp$Svzc*g@z>,68DXfd-x+]f[uEo#HXpv^Ua0b]-(c$d|+d~{.6-|');

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
