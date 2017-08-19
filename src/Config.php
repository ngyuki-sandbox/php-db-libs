<?php
namespace Example;

class Config
{
    public static function get()
    {
        $files = [
            __DIR__ . '/../config.php',
            __DIR__ . '/../config.php.dist',
        ];
        foreach ($files as $file) {
            if (file_exists($file)) {
                return require $file;
            }
        }
        return [];
    }
}
