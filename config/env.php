
<?php

// Load environment variables from the project root .env file.

$envFile = dirname(__DIR__) . '/.env';

if (!file_exists($envFile)) {
    throw new RuntimeException('.env file not found.');
}

$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {

    $line = trim($line);

    // Ignore comments.
    if ($line === '' || str_starts_with($line, '#')) {
        continue;
    }

    // Separate variable name and value.
    if (!str_contains($line, '=')) {
        continue;
    }

    [$name, $value] = explode('=', $line, 2);

    $name = trim($name);
    $value = trim($value);

    // Remove surrounding quotes if present.
    $value = trim($value, "\"'");

    if ($name !== '') {
        $_ENV[$name] = $value;
    }
}
