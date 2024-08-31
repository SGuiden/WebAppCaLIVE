<?php
$dsn = "mysql:host=localhost;dbname=postsdb";
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

// Create the 'post' table
$sql = "CREATE TABLE IF NOT EXISTS post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usrname VARCHAR(12) NOT NULL,
    postfilename VARCHAR(255) NOT NULL,
    comment VARCHAR(100) NOT NULL,
    DOP DATE NOT NULL,  /* Date of post */
    likes INT(10) NOT NULL DEFAULT 0,
    CHECK (LENGTH(usrname) BETWEEN 4 AND 12),
    FOREIGN KEY (usrname) REFERENCES user(usrname)
)";

try {
    $db->exec($sql);
    echo "Table 'post' created successfully.<br>";
} catch (PDOException $ex) {
    echo "Error creating table: " . $ex->getMessage();
}

// Create the 'comments' table
$sql = "CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usrname VARCHAR(12) NOT NULL,
    postfilename VARCHAR(20) NOT NULL,
    comment VARCHAR(100) NOT NULL,
    DOP DATE NOT NULL,  /* Date of post */
    likes INT(10) NOT NULL DEFAULT 0,
    liked TINYINT(1) DEFAULT 0,
    CHECK (LENGTH(usrname) BETWEEN 4 AND 12),
    FOREIGN KEY (usrname) REFERENCES user(usrname)
)";

try {
    $db->exec($sql);
    echo "Table 'comments' created successfully.<br>";
} catch (PDOException $ex) {
    echo "Error creating table: " . $ex->getMessage();
}
