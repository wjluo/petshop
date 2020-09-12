<?php

define('DB_SERVER', 'localhost');
define('DB_NAME', 'xenosdb');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$db) {
    die("Connection failed: " . $db->error);
}
