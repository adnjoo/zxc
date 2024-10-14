<?php

function getDbConnection()
{
    $host = getenv('DB_HOST') ?: 'localhost';
    $port = getenv('DB_PORT') ?: '5432';
    $dbname = getenv('DB_NAME') ?: 'todoapp';
    $user = getenv('DB_USER') ?: 'andrewnjoo';
    $password = getenv('DB_PASSWORD') ?: '';

    $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
    $dbconn = pg_connect($conn_string);

    if (!$dbconn) {
        error_log("Error in connection: " . pg_last_error(), 3, '../logs/db_connection.log');
        die("Error in connection: " . pg_last_error());
    }
    return $dbconn;
}
