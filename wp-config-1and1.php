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
define('DB_NAME', 'db397959348');

/** MySQL database username */
define('DB_USER', 'dbo397959348');

/** MySQL database password */
define('DB_PASSWORD', 'jl1234567890!');

/** MySQL hostname */
define('DB_HOST', 'db397959348.db.1and1.com');

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
define('AUTH_KEY',         'DjBpYNBBr.c6KK>yC02!T(bT;r4r-ZOMEEWu*M@q8dSXN]+g-7mW#N|fMieD^<+#');
define('SECURE_AUTH_KEY',  'x-t|AQ8Y-J<H&~B<}AwGOG,ePe$SzB](Q <*L[)N|Y+1b|m0NLbZHAaQt=Z?p15V');
define('LOGGED_IN_KEY',    'w=?UtKgi?a>!A:p>2TC`-K|pkNId6QE/|D77y=z9%z*t65T#~8_Cy.,6EAHhK#%y');
define('NONCE_KEY',        '4vgRzCrHAcBj4j)s&LJah5q V,0+But %)2WZVKP>U||N0m:l77MMh3cIGZB$;-S');
define('AUTH_SALT',        'V#YM))KU&9)2cW?S`OU4pi-GO8/wSrivi;;b#KD2_=)n_!(I[/E}Zko5&nTFg;HW');
define('SECURE_AUTH_SALT', 'J02F(dwMJ)g/[$7EKf&)F))<!Q9I~|a_u/|Vi1*-V3%^]]B%=7Lrjd RpZG&o/~G');
define('LOGGED_IN_SALT',   'M*ON{6&ZzRl)GV>N)<k~bun1t&6sruHuG;uf[$JXfd|)-6(A1A$Sp|DpW1n/xt(o');
define('NONCE_SALT',       'h/:tioaiqw.pU_1:=FY#I}N O.c2|dmY+Vd?(Cp|N$`vxK]n`C|uO3uRU||}/m2h');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'crysawp_01_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'fr_FR');

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
