<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// $pdo = new PDO('mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_82998037b0d052c;charset=utf8', 'ba0a05146a31b1', '503df4c5');

$pdo = new PDO(
    'mysql:host=localhost;dbname=ijdb;charset=utf8',
    'ijdbuser',
    'password1234'
);


$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);