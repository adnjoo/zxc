<?php

function getDbConnection()
{
    // Use DATABASE_URL if it exists, otherwise fallback to individual env vars.
    $databaseUrl = getenv('DATABASE_URL');

    if ($databaseUrl) {
        // Parse DATABASE_URL (e.g., postgresql://user:pass@host:port/dbname)
        $parts = parse_url($databaseUrl);

        $host = $parts['host'];
        $port = $parts['port'];
        $dbname = ltrim($parts['path'], '/'); // Remove leading slash from path
        $user = $parts['user'];
        $password = $parts['pass'];
    } else {
        // Use individual environment variables as fallback
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '5432';
        $dbname = getenv('DB_NAME') ?: 'todoapp';
        $user = getenv('DB_USER') ?: 'andrewnjoo';
        $password = getenv('DB_PASSWORD') ?: '';
    }

    // Create the connection string
    $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

    // Connect to PostgreSQL
    $dbconn = pg_connect($conn_string);

    // Handle connection errors
    if (!$dbconn) {
        $error = "Error in connection: " . pg_last_error();
        error_log($error, 3, '../logs/db_connection.log');
        die($error);
    }

    return $dbconn;
}
