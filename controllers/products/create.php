<?php
// Include the PDO connection
        require 'Database.php';

        session_start();
        if (empty($_SESSION['user_id']) || empty($_SESSION['username'])) {
            header("Location: ../login.php");
            exit();
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validator for the product properties
            require "validate_product.php";

            // Prepare the SQL statement
            $statement = $pdo->prepare("INSERT INTO products (name, description, quantity, price, image, category_id) 
                                        VALUES (:name, :description, :quantity, :price, :image, :category_id)");

            // Bind parameters
            $statement->bindValue(":name", $name);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":quantity", $quantity);
            $statement->bindValue(":price", $price);
            $statement->bindValue(":image", $image);
            $statement->bindValue(":category_id", $category_id);

            // Execute the statement
            $statement->execute();
        }

        // Fetch categories for the dropdown
        $statement = $pdo->prepare("SELECT * FROM category;");
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Set default values for the form variables
        $name = $_POST["name"] ?? '';
        $description = $_POST["description"] ?? '';
        $quantity = $_POST["quantity"] ?? '';
        $price = $_POST["price"] ?? '';
        $category_id = $_POST["category_id"] ?? '';
        $image = $_POST["image"] ?? '';