<?php

namespace App\Core;

class Config {
    private static $vars = [];

    public static function load($path) {
        if (!file_exists($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '#') === 0) continue;
            
            if (strpos($line, '=') !== false) {
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
                
                // Remove inline comments
                if (strpos($value, '#') !== false) {
                    $value = trim(explode('#', $value)[0]);
                }
                
                // Remove quotes if present
                $value = trim($value, '"\'');
                
                self::$vars[$name] = $value;
            }
        }
    }

    public static function get($key, $default = null) {
        return self::$vars[$key] ?? $default;
    }
}
