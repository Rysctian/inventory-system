<?php



    // Retrieve form inputs
    $name = $_POST["name"] ?? null;
    $description = $_POST["description"] ?? null;
    $quantity = $_POST["quantity"] ?? null;
    $price = $_POST["price"] ?? null;
    $category_id = $_POST["category_id"] ?? null;

    // Initialize errors array
    $errors = [];

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($description)) {
        $errors[] = "Description is required";
    }
    if (empty($quantity)) {
        $errors[] = "Quantity is required";
    }
    if (empty($price)) {
        $errors[] = "Price is required";
    }
    if (empty($category_id)) {
        $errors[] = "Category is required";
    }

    if (empty($errors)) {
        // Handle file upload
        $image = null;
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES["image"]["tmp_name"];
            $imageName = $_FILES["image"]["name"];
            $imagePath = 'images/' . $imageName;

            // Move the uploaded file to the desired location
            move_uploaded_file($imageTmpPath, $imagePath);
            $image = $imagePath;
        }
    }
