<?php
// tawing yung PDO from Database
require 'Database.php';


    session_start();


    if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }

    $search = '';
    if (isset($_POST["search_button"])) {
        $search = $_POST["search"] ?? '';


        // Prepare and execute the query with a LIKE clause
        $statement = $pdo->prepare("SELECT products.*, category.name as category_name FROM products 
                                    INNER JOIN category 
                                    ON products.category_id = category.id
                                    WHERE products.name LIKE :search");
        $statement->bindValue(":search", '%' . $search . '%');
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Prepare and execute the query to get all products
        $statement = $pdo->prepare("SELECT products.*, category.name as category_name FROM products 
                                    INNER JOIN category 
                                    ON products.category_id = category.id");
        $statement->execute();
        $products = $statement->fetchAll(PDO::FETCH_ASSOC); // PDO ASSOC will give you a result that is associative array

     
}