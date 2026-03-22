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
    $phone = trim($_POST['phone']);
    
    $stmt = $conn->prepare("
        UPDATE account 
        SET name = :name, surname = :surname, email = :email, phone = :phone
        WHERE id = :id
    ");

    $stmt->execute([
        ':name' => $name,
        ':surname' => $surname,
        ':email' => $email,
        ':phone' => $phone,
        ':id' => $userid
    ]);

    header("Location: /account");
    exit;
}