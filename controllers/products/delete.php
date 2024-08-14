<?php
require realpath(__DIR__ . '/../../Database.php');

session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_POST["id"] ?? null;

if (!$id) {
    header("Location: index.php"); // Redirect to index if no ID
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // PREPARE
    $statement = $pdo->prepare("DELETE FROM products WHERE id = :id");

    // BIND
    $statement->bindValue(":id", $id);

    // EXECUTE
    $statement->execute();

    // Redirect to index page after deleting
    header("Location: index.php");
}
?>
