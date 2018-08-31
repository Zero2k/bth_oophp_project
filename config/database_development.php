<?php
/**
 * Config file for Database.
 *
 * Example for MySQL.
 *  "dsn" => "mysql:host=localhost;dbname=test;",
 *  "username" => "test",
 *  "password" => "test",
 *  "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
 *
 * Example for SQLite.
 *  "dsn" => "sqlite:memory::",
 *
 */
return [
    "dsn"             => "mysql:host=localhost;dbname=oophp_project",
    "username"        => "root",
    "password"        => "12345",
    "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => "oophp_",
    "session_key"     => "Anax\Database",
    // True to be very verbose during development
    "verbose"         => null,
    // True to be verbose on connection failed
    "debug_connect"   => false,
];
