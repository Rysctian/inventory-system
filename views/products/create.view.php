<?php

    require_once "./controllers/products/create.php";
    require "views/partials/header.php";
    ?>

<div class="container mx-auto p-8">
    <h1 class="text-4xl font-bold mb-8">Create Product</h1>
    <a href="index.php">Go back</a>
    <?php require "views/products/form.php" ?>
</div>
<?php require "views/partials/footer.php"; ?>
