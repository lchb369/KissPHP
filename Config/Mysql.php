<?php

$mysql['default'] = array(
    'dsn'	=> '',
    'hostname' => '127.0.0.1',
    'port' => 3306,
    'username' => 'root',
    'password' => 'root',
    'database' => 'demo',
    'dbdriver' => 'pdo',
    'pconnect' => FALSE,
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
);


$mysql['dev'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'hostport' => 3306,
    'username' => 'root',
    'password' => 'root',
    'database' => 'test',
    'dbdriver' => 'pdo',
    'pconnect' => FALSE,
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
);



return $mysql;

?>