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
define('DB_NAME', 'xetnghie_xetnghiemadnnet');

/** MySQL database username */
define('DB_USER', 'xetnghie_adnnet');

/** MySQL database password */
define('DB_PASSWORD', '@abcd1234');

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
define('AUTH_KEY',         '9;:fbCSl$UVGlJ7.4|ojlD|(k5l&-:-}t~4 D+TF})Z_LRnyI];Zu)4J&gxQi9z?');
define('SECURE_AUTH_KEY',  '+(~E,2{Di|xk6R<EMi+#8l{&&w=DrX]wZfA#T_%ad?sjo2=je9yVcN(SGNeQI {M');
define('LOGGED_IN_KEY',    '~]/ybdBSP/xlh<-@sUU.OWzI1j3QJYl^1:%S^oqIE9PiVtUN<x>o9/|FS7cpD_#b');
define('NONCE_KEY',        'xlmjKV4jcsdY4V|/3#oLSeDEZ:<:.}+]gBK]:|D^,5*kh7[g.N$rV3]LWSb]H/=]');
define('AUTH_SALT',        'Q1hjil+[1d8>&U0rPFz+?,4P|^B}Pf7@a(f{!_31&|}HOZpASbEs/|E21lNGo&yS');
define('SECURE_AUTH_SALT', '2+q(LT=Y$VN4}vg~R8ZxP7cdCyP({2(5JEq9I<W/(<*U1+[agz!<;>u!{ )5m(!r');
define('LOGGED_IN_SALT',   'M$}P-.;=CMQ#.W*+Mo-FXYQ#|m-W;kYI{&&JwK`+$}W|(!U2S!hGE.+T27xSyWKh');
define('NONCE_SALT',       '>Rd=6a3F5fh$4)%h9PcQL8a.ou}!e3^(mj28N5+G#sm,5=o>n4g}Sn?1GRB]Amcu');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'drrt7_';

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
