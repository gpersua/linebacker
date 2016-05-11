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
define('DB_NAME', 'linebacker_backend');

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
define('AUTH_KEY',         '6b.@-hs!;Jhwmd|iFpBz1-|JU9>20,$Hy}P0{,t`lK[PZ{TaeMR|(faes*d^V[c`');
define('SECURE_AUTH_KEY',  '8ZU4Z%>?|cBCB0tO|(6*aHIkyL5SW4*x|IP[@Nm[}y:f<iHMAW j||L;7:Ss[EEC');
define('LOGGED_IN_KEY',    'xeHyF~_z<&EOoUa!g*`yQ/J$@pCs&6a&eK:~g%3qv!*`?EKts9nbVKPmQ#,ZSdVr');
define('NONCE_KEY',        'mu`4DI!Y*r-c9MHF752]!5VYA5^j}kwUrO]Ic/Fhtze}[T)/-&IC!|9?^cLV7|n}');
define('AUTH_SALT',        'V.j:}gVy#u~!s*8XLC4DJ:56cL_)UN`QZFnEx$&?xQ=;xGE`0rhf4)}#LM$-^15z');
define('SECURE_AUTH_SALT', '-E9*p SmOE3G^w+-[PiFkOT#^*G)`m>y6]cPJ!f[BC<]iiyYm0O3,FM=<&.ldh^*');
define('LOGGED_IN_SALT',   ')k[A$O;z;_D%lJ0tKP@<qXD->R<!9SW*UnMmMxT$5ps({*i XKrbx&hDT)SNPf29');
define('NONCE_SALT',       '-0t6Gb[5x.9K3CDCSH=9<}5qcn<5.9QB)`[GY*PJt)ax#~+y-$-$QL3<ZT=&F$(9');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
