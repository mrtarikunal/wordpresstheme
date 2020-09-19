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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fictional-university' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'bW8cX3VUCdz2uqp9qQX3UMFvQ4GooV70TCvaq41hHg1nfrA8iZV5CLhP8eGQnwX3' );
define( 'SECURE_AUTH_KEY',  'qXdHMnKjQPBrtYWngKEXHK95nu5yBic3E01QOS4A2ukvvGSiSFtcHIeFgBkw389Q' );
define( 'LOGGED_IN_KEY',    'r0WHPcFfGPSH5ZQeWOthrAtDJYZFCfDRvi6Tq7L4le1CQA2DTot2p9n2FWCFUEAg' );
define( 'NONCE_KEY',        'ubZMgFqozvxyrdYJ5iQZljp4gzGm7oJpMVmtqhFCEkbjBf46QX9i2UdJkIxBsVrj' );
define( 'AUTH_SALT',        'z3oV7M3KwPB1zFlQEaL4oUWkXkaD3KuFs2QyPoLkYLUALGXFJnr4y4JMeV6jHUFZ' );
define( 'SECURE_AUTH_SALT', 'JnOh9QaKC8Qf2MpQAgleS9eb0uZElIg8oAWcqkqniibybouBrmHePhjUSrtpZ44y' );
define( 'LOGGED_IN_SALT',   '33BUKuFzW3ESyLpkkZ9SWQSs1bWYruHsX7QTB2SVDfxOhbw2TIyjJXEsuFlF271D' );
define( 'NONCE_SALT',       's2LPYIxftA3SaDljRl02B4S0xr1Cn5NIbyzFls6XYCYm324V7uZii6Kp6DH6O3td' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
