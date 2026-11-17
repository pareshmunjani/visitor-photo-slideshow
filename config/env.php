
<?php

// Load environment variables from the project root .env file.
$envFile = dirname(__DIR__) . '/.env';

if (!is_file($envFile) || !is_readable($envFile)) {
    throw new RuntimeException(
        'Environment configuration file is missing or unreadable.'
    );
}

$lines = file(
    $envFile,
    FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
);

foreach ($lines as $line) {

    $line = trim($line);

    // Ignore comments and blank lines.
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

    // Accept only valid environment-variable names.
    if (!preg_match('/^[A-Z_][A-Z0-9_]*$/i', $name)) {
        continue;
    }

    // Remove surrounding quotes.
    $value = trim($value, "\"'");

    $_ENV[$name] = $value;
}
