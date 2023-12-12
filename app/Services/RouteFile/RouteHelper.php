<?php
namespace App\Services\RouteFile;

class RouteHelper
{
    public static function includedRouteFiles(string $folder)
    {
        $dirIterator = new \RecursiveDirectoryIterator($folder);

        /**
         * @var  \RecursiveDirectoryIterator
         */
        $it = new \RecursiveIteratorIterator($dirIterator);

        while ($it->valid())
        {
            if (!$it->isDot()
            && $it->isFile()
            && $it->isReadable()
            && $it->current()->getExtension() === 'php')
            {
                require $it->key();
            }
            $it->next();
        }
    }
}


