<?php
require 'Database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    
    $errors = [];

    if (empty($username)) {
        $errors[] = 'Username is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
    }
    if (empty($confirm_password)) {
        $errors[] = 'Please confirm your password';
    }

    

    if ($password !== $confirm_password) {
        $errors['password_mismatch'] = "Passwords do not match";
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $statement->bindValue(":username", $username);
        $statement->bindValue(":email", $email);
        $statement->execute();
        $count = $statement->fetchColumn();

        if ($count > 0) {
            $errors['duplicate'] = 'Username or email already exists';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $statement = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $statement->bindValue(":username", $username);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $hashed_password);

            if ($statement->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $errors['database'] = 'Error inserting into database';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>

<div class="container mx-auto p-8 flex justify-center items-center min-h-screen">
    <div class="bg-white p-6 rounded shadow-md max-w-lg w-full">
        <h1 class="text-4xl font-bold mb-8 text-center">Sign Up</h1>

        <form method="POST">

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>


            <?php if (!empty($errors)) : ?>
                    <div class="flex flex-col gap-2 mb-4 ">
                        <?php foreach ($errors as $error) : ?>
                            <p class="px-3 py-2 bg-red-400 text-sm text-white rounded">
                                <?= htmlspecialchars($error) ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <div class="flex flex-col items-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition duration-200">Sign Up</button>
                <a href="login.php" class="text-sm mt-4 hover:text-blue-500 hover:underline">Already have an account?</a>
            </div>
        </form>
    </div>
</div>


</body>
</html>
