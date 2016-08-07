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
define('DB_NAME', 'manhatv8_wor1');

/** MySQL database username */
define('DB_USER', 'manhatv8_wor1');

/** MySQL database password */
define('DB_PASSWORD', 'c0hLCa7s');

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
define('AUTH_KEY',         '+JVq__WyzcY2E{a,iHtrBF$+(V-3pFP+)+X7wH*WZn5#ri9R`s4OAfF9@#,=EK;V');
define('SECURE_AUTH_KEY',  'GH!vw[0Ax]4+q}$C0P9;/%|sXxL^M62qr</-dJ:SPv4x|6S8*]^F-[B|++;eD}zw');
define('LOGGED_IN_KEY',    '??V~81KPr>l?>2+<+>C/D5o{+<<?y3&**8gn-yT@}RAnR@VV+kf*EGY^}@dHF0~O');
define('NONCE_KEY',        'u%3X&aHg#X%4!E0=7G_G9_lSHRKj2a*+L>Z;Is`WOKYu.R(~xSCkZ4.xz[LPzJg#');
define('AUTH_SALT',        'Oapl1.a)u_6-(X>)g4-d9XRsfk3yOanv4w1}s(KiXgpq[{Z|pjkasx1_s?+ j+1j');
define('SECURE_AUTH_SALT', 'C/-2GP`Y)U3O6MRmp|HXE@V:(eaf2[|pDYlY/5P0*Bn[=#mw*@}go+b^.u(W`Q X');
define('LOGGED_IN_SALT',   '6Wop@eNabBdEq,t,`c1ShpC2Hdv A:#+=bB4nyoe$ud`-m|L2/6jO6[oB]dAb{ h');
define('NONCE_SALT',       'Mz4kt2+8|6L-.E?y9Inz&zic2>rF%VXSedFvf)?IF;z1#!-4g`w#V8{`XH^PT=:0');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rep_';

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
