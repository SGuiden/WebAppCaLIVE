<?php
require('../db/userdb.php');

// Get POST data from React form
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['error' => 'No data provided']);
    exit();
}

// Server-side validation
$name = trim($data['name']);
$email = trim($data['email']);
$password = trim($data['password']);
$confirmPassword = trim($data['confirmPassword']);

if ($password !== $confirmPassword) {
    echo json_encode(['error' => 'Passwords do not match']);
    exit();
}

// Hash the password before saving it to the database
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
    $query = "INSERT INTO user (usrname, email, firstname, dob, password) VALUES (:name, :email, :firstname, :dob, :password)";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':firstname', $name); // Assuming firstname is the same as name input
    $statement->bindValue(':dob', date('Y-m-d')); // You may want to update this with actual DOB input
    $statement->bindValue(':password', $hashedPassword);
    $statement->execute();
    $statement->closeCursor();

    echo json_encode(['success' => 'User registered successfully']);
} catch (PDOException $ex) {
    echo json_encode(['error' => "Database error: " . $ex->getMessage()]);
}

