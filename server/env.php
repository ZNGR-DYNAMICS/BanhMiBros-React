<?php

function loadEnv($filePath) {
    $envPath = __DIR__ . '/.env';
    if (file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            putenv("$name=$value");
            $_ENV[$name] = $value;
        }
    } else {
        die("Error: .env file not found");
    }
}


?>