<?php
$dsn = "mysql:host=localhost;dbname=userdb";
$username = "root";
$password = "";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
} catch (PDOException $ex) {
    echo "Connection failure Error: " . $ex->getMessage();
    header("Location: ../view/error.php?msg=" . $ex->getMessage());
    exit();
}

// Create the 'user' table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS user (
    usrname VARCHAR(12) NOT NULL PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    firstname VARCHAR(22) NOT NULL,
    dob DATE NOT NULL,
    password VARCHAR(255) NOT NULL,  /* Store hashed password */
    CHECK (LENGTH(usrname) BETWEEN 4 AND 12),
    CHECK (LENGTH(password) BETWEEN 8 AND 20)
)";

try {
    $db->exec($sql);
    echo "Table 'user' created successfully.<br>";
} catch (PDOException $ex) {
    echo "Error creating table: " . $ex->getMessage();
}
