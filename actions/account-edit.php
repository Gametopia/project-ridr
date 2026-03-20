<?php
session_start();
require_once __DIR__ . "/../database/connection.php";

if (!isset($_SESSION['id'])) {
    header("Location: /login-form");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['id'];

    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("
        UPDATE account 
        SET name = :name, surname = :surname, email = :email 
        WHERE id = :id
    ");

    $stmt->execute([
        ':name' => $name,
        ':surname' => $surname,
        ':email' => $email,
        ':id' => $userid
    ]);

    header("Location: /account?updated=1");
    exit;
}