<?php

function getDBConnection() {
    try {
        // Define the path to your SQLite file
        $path = __DIR__ . '/../database/LOL.db';

        // Create a new connection
        $db = new PDO("sqlite:$path");

        // Set error mode
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    } catch (PDOException $e) {
        // If something goes wrong, display the error
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}
?>

