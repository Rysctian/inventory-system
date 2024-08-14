<?php

session_start();
if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
 header("Location: ../login.php");
 exit();
}

// tawing yung PDO from Database
require 'Database.php';

$id = $_GET["id"] ?? null;

if (!$id) {
 header("Location: index.php"); // ireredirect sa index pag walang id
 exit();
}

// FETCH THE PRODUCT
$statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$statement->bindValue(":id", $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);


// FETCH THE CATEGORIES FOR DROPDOWN
$statement = $pdo->prepare("SELECT * FROM category;");
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);


// STATE
$name =  $product["name"];
$description = $product["description"];
$quantity = $product["quantity"];
$price = $product["price"];
$category_id = $product["category_id"];
$image = $product["image"];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 require "validate_product.php";

 if (empty($errors)) {
     // PREPARE the SQL statement
     $statement = $pdo->prepare("UPDATE  products 
                                 SET name = :name, 
                                     description = :description, 
                                     quantity = :quantity, 
                                     price = :price, 
                                     image = :image, 
                                     category_id = :category_id
                                 WHERE id = :id");

     // BIND parameters
     $statement->bindValue(":id", $id);
     $statement->bindValue(":name", $name);
     $statement->bindValue(":description", $description);
     $statement->bindValue(":quantity", $quantity);
     $statement->bindValue(":price", $price);
     $statement->bindValue(":image", $image);
     $statement->bindValue(":category_id", $category_id);

     // EXECUTE the statement
     $statement->execute();
 }
}


