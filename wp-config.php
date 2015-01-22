<?php




/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
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
define('DB_NAME', 'beatcycl_wp');

/** MySQL database username */
define('DB_USER', 'beatcycl_wp');

/** MySQL database password */
define('DB_PASSWORD', 'B0uldeR2544!');

/** MySQL hostname */
//define('DB_HOST', 'localhost');
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'yaEzLHIv6lYwrrcElS0aXY3jfBw^SFVKP2VHWM(Qq*94%d$hG596q1nRUiTUNaTH');
define('SECURE_AUTH_KEY',  'MM^!S8!)P$*xM1MXJBlUzviAvrXN#kY^gwZndI2jQS^CbY3vxsM9jH&95oa1XeQ1');
define('LOGGED_IN_KEY',    '3JI34CQtF9($8mA8l@cfAEr%hVXKVPz0NjlDX$3K6ZLw*qM!JT3UXprC&7x^Zrj8');
define('NONCE_KEY',        'dq8%aFAmS3nPm1ZCO!dB&QqCsCY7Xo)P7X@TYwVkLkBivmUC4cZXb&qIWVJ!a4VY');
define('AUTH_SALT',        ')rmL*HofuPO$TVi9Z)9NrCjq9ji1Mq%Q*(JEQx5%6sfxzx$41)a&q1Z(7P2k%C*Z');
define('SECURE_AUTH_SALT', '@s%WfurvcJfkRafjcWuP4DNe3rzzj85Yglm$I)!H60fk5JNoPt^k*$hUud2hYjR7');
define('LOGGED_IN_SALT',   '6o^$yJS$XK#yqpzylvP5RJI(zz4Qcg9PKZH*ACfjkMDSmh%3Kz22l%Vo*l2hZrG@');
define('NONCE_SALT',       'J9ghIC2t@T*3hWt8F8BbRYC1H#J2ewZA8JkIgDLOY$hT)pbpU%0hOuK1VoMjfBi(');
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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

define('WP_POST_REVISIONS', 3);



define( 'WP_MEMORY_LIMIT', '600M' );
define('FORCE_SSL_ADMIN', true);

define('WP_HOME','http://beatcycle.com');
define('WP_SITEURL','http://beatcycle.com');

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );



?>
