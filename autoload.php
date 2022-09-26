<?php

function autoload($class) 
{


    $paths = array(
        'classes',
        '../classes',
    );

    foreach($paths as $path)
    {
        $file_path = sprintf('./%s/%s.classes.php', $path, $class);
        if(is_file($file_path))
        {
            include_once $file_path;
        }

    }
}

spl_autoload_register('autoload');