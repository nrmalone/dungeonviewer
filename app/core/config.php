<?php
define("WEBSITE_NAME", "Dungeon Viewer");


define("DB_TYPE", 'mysql');
define("DB_NAME", 'dungeonviewer');


/*
dbSetup.sql sets the DB user info
In production, DB credentials can be stored in & accessed from  a separate .csv
*/
define("DB_USER", 'dungeonmaster');
define("DB_PASS", 'rollforinitiative1d20');


//localhost would be replaced w/ server path in production
define("DB_HOST", 'localhost');

//using http for the time being since trying to use cURL and newer certs won't get along with https
define("PROTOCOL", 'http');
//define("PROTOCOL", 'https');


/*
$path is used to establish the filepath to the public portion of the server
ROOT is then defined  as the root directory of the app's public components
*/
$path = str_replace('\\', '/', PROTOCOL . '://' . $_SERVER['SERVER_NAME'] . __DIR__ . '/');
$path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
define('ROOT', str_replace('app/core', 'public', $path));
define('PRIVATEROOT', str_replace('app/core', 'app', $path));