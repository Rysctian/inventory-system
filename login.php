<?php
require 'Database.php';


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $errors = [];

    if (empty($username)) {
        $errors[] = 'Username is required';
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
    }
    if (empty($errors)) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ./views/products/index.php");
            exit();
        } else {
            $errors[] = 'Invalid credentials';
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
            <h1 class="text-4xl font-bold mb-8 text-center">Login</h1>

            <form method="POST">

                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition duration-200">Login</button>
                    <a href="signup.php" class="text-sm mt-4 hover:text-blue-500 hover:underline">Don't have an account?</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>