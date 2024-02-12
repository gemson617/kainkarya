<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = true;
$root = true;

if ($_SERVER['HTTP_HOST'] == 'localhost') 
{
    $hostname = 'localhost';
    $username = 'root';
    $password = 'root@123;';
    $database = 'kainkarya';
    $environment = 'production';
}
else 
{
    $hostname = 'localhost';
    $username = 'u686310498_kainkaryatrust';
    $password = '7[bIwo9uxUh';
    $database = 'u686310498_kainkarya';
    $environment = 'production';
}

$db['default'] = array(
    'dsn' => '',
    'hostname' => $hostname,
    'username' => $username,
    'password' => $password,
    'database' => $database,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== $environment),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => array(),
    'save_queries' => true,
);
