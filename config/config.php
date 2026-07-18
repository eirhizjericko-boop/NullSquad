<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Application settings
|--------------------------------------------------------------------------
| Edit these values after importing database/ecommerce_db.sql.
| BASE_URL may be left blank when the project folder is served directly.
*/

define('APP_NAME', 'Null Squad Office Solutions');
define('APP_SHORT_NAME', 'Null Squad');
define('APP_TAGLINE', 'Professional office equipment for productive workspaces.');
define('GROUP_NAME', 'Null Squad');
define('EDUCATIONAL_FOOTER', 'This website is for educational purposes only and is submitted as a requirement for our Final Project.');

define('BASE_URL', '');

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'sql12833365');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

define('MAIL_FROM_EMAIL', 'no-reply@nullsquad.local');
define('MAIL_FROM_NAME', APP_NAME);

define(
    'UPLOAD_DIR',
    dirname(__DIR__) . DIRECTORY_SEPARATOR .
    'uploads' . DIRECTORY_SEPARATOR .
    'products' . DIRECTORY_SEPARATOR
);

define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024);
define('LOW_STOCK_DEFAULT', 5);