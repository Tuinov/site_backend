<?php
namespace app\engine;

class AutoLoad
{
    private $path = [
        'model',
        'engine'
    ];

    public function loadClass($className) {
        // var_dump($className);
        $fileName = str_ireplace(["\\", "app"], ["/", ".."], $className) . '.php';
        // var_dump($fileName);
            if (file_exists($fileName)) {
                include $fileName;
        
            } 
    }
}