<?php

$pdo = new PDO('mysql://ba0a05146a31b1:503df4c5@us-cdbr-east-03.cleardb.com/heroku_82998037b0d052c?reconnect=true;dbname=heroku_82998037b0d052c;charset=utf8', 'ba0a05146a31b1', '503df4c5');

$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);