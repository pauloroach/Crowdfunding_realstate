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
define( 'DB_NAME', 'wordpress_database' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'c3QH,EzbsdD>v{fv#Y~6@JJHE -.<+w3])fsEv/dBPI*|`~8(?Y^K`3>zc=U%Z7f' );
define( 'SECURE_AUTH_KEY',  'YF79|%7%f+.Tsw::Vsfa+^r{y+z-qbPirH>1#vrQh+bcY()Br@!nF{=6!tP/$^Y|' );
define( 'LOGGED_IN_KEY',    '-5%Ei8JFTZz>3eTjexU8=W!IV-Z#bqyRNDymOKp-3`0-Ypu918JUbYxD%{!9,,9O' );
define( 'NONCE_KEY',        'Z}zBTQB)1E#4VSe!}FpQw5vLX~EEIg-iOMY-OS/Tj>^zLUcDCfQ?s?YnGS.*Ap=I' );
define( 'AUTH_SALT',        '/ jllFP~-@DXa&GVZuha]:dDO,8d_3L)+g;;EWNzv chdH%CvA_u(f8&:4qLo@R;' );
define( 'SECURE_AUTH_SALT', '7h086**l) JT.`s$rn/IDx)x2#vYc!u`!vZhaG/a=+y1:|+?3Ek*VSftv[(KOs0n' );
define( 'LOGGED_IN_SALT',   'g|lQzs:^sC=h2KvU%j*|)Xtxc/::~.[|}8TUIB(!pyE~TKu%QS@EX>%/>!D8FE^i' );
define( 'NONCE_SALT',       '`6VJ(S6!N}5`W7qA$aWQp(hKPYFvz#qjEU!iy3&*Vy5LE% Q/(Xqa1Mowuhglk7a' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
