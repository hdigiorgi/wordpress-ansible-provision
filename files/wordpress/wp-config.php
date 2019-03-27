<?php

define('DB_NAME',                '__REPLACE_WITH_DB_NAME__');
define('DB_USER',                '__REPLACE_WITH_DB_USER__');
define('DB_PASSWORD',            '__REPLACE_WITH_DB_PASSWORD__');
define('DB_HOST',                'localhost');
define('IMAGE_EDIT_OVERWRITE',   true);
define('WP_DEBUG',               false);
define('DISALLOW_FILE_EDIT',     true);

$table_prefix = 'wp_';

# LOGIN
define('AUTH_KEY',         '__REPLACE_WITH_WP_AUTH_KEY__' );
define('SECURE_AUTH_KEY',  '__REPLACE_WITH_WP_SECURE_AUTH_KEY__' );
define('LOGGED_IN_KEY',    '__REPLACE_WITH_WP_LOGGED_IN_KEY__' );
define('NONCE_KEY',        '__REPLACE_WITH_WP_NONCE_KEY__' );
define('AUTH_SALT',        '__REPLACE_WITH_WP_AUTH_SALT__' );
define('SECURE_AUTH_SALT', '__REPLACE_WITH_WP_SECURE_AUTH_SALT__' );
define('LOGGED_IN_SALT',   '__REPLACE_WITH_WP_LOGGED_IN_SALT__' );
define('NONCE_SALT',       '__REPLACE_WITH_WP_NONCE_SALT__' );
# LOGIN

# Allow any domain
if(!isset($_SERVER['SERVER_PORT'])) $_SERVER['SERVER_PORT'] = 80;
if(!isset($_SERVER['SERVER_NAME'])) $_SERVER['SERVER_NAME'] = "localhost";
$domain = sprintf('%s://%s',
        $_SERVER['SERVER_PORT'] == 80 ? 'http' : 'https',
        $_SERVER['SERVER_NAME']);
define('WP_SITEURL',       $domain);
define('WP_HOME',          $domain);

# Load other settings
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');