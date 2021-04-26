<?php
    function autoloader($className)
    {
        $fileName = str_replace('\\', '/', $className) . '.php';

        //$file = __DIR__ . '/../classes/' . $fileName ;
        
        $file = '/app/classes/' . $fileName;

        include $file;
    }
    spl_autoload_register('autoloader');