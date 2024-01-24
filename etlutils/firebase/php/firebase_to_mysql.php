<?php

require_once 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Firebase configuration
$firebaseConfig = [
    'databaseUrl' => 'https://your-firebase-database-url.firebaseio.com/',
    'keyFile' => 'credentials.json',
];

// MySQL configuration
$mysqlConfig = [
    'host' => 'your_mysql_host',
    'user' => 'your_mysql_user',
    'password' => 'your_mysql_password',
    'database' => 'your_mysql_database',
];

function initializeFirebase($config)
{
    $serviceAccount = ServiceAccount::fromJsonFile($config['keyFile']);
    $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri($config['databaseUrl'])
        ->create();

    return $firebase->getDatabase();
}

function initializeMySQL($config)
{
    $mysqli = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    return $mysqli;
}

function migrateData($firebase, $mysqli)
{
    // Assuming 'your_firebase_path' is your Firebase database path
    $firebasePath = '/your_firebase_path';

    $data = $firebase->getReference($firebasePath)->getValue();

    // Assuming 'your_table' is your MySQL table name
    $tableName = 'your_table';

    foreach ($data as $key => $value) {
        $field1 = $value['field1'];
        $field2 = $value['field2'];

        // Add more fields as needed

        // Insert data into MySQL
        $query = "INSERT INTO $tableName (field1, field2) VALUES ('$field1', '$field2')";
        $mysqli->query($query);
    }

    // Close MySQL connection
    $mysqli->close();
}

// Main migration process
$firebase = initializeFirebase($firebaseConfig);
$mysqli = initializeMySQL($mysqlConfig);

migrateData($firebase, $mysqli);

?>
