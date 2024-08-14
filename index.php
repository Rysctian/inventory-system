


<?php require_once "./controllers/products/create.php"?>
<?php require "views/partials/header.php"; ?>


<div class="relative w-[80vw] h-[90vh] mx-auto mt-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-4">Products</h1>
        <a href="create.view.php" class="bg-blue-500 text-white px-4 py-2">Create Product</a>
    </div>
    <form method="POST" class="flex items-center space-x-2 mb-4">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="submit" name="search_button" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Search
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 border-collapse border-[1px]">
            <thead class="text-xs text-gray-700 h-16 w-full justify-between uppercase bg-gray-50">
                <tr>
                    <th class="px-4 py-2 border-b">Image</th>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Category</th>
                    <th class="px-4 py-2 border-b">Description</th>
                    <th class="px-4 py-2 border-b">Quantity</th>
                    <th class="px-4 py-2 border-b">Price</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
        </table>
        <div class="overflow-y-auto h-[70vh]">
            <table class="w-full text-sm text-left text-gray-500 border-collapse border-[1px]">
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr class="bg-white border-b overflow-x-hidden hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <?php if ($product["image"]) : ?>
                                    <img src="<?= htmlspecialchars($product["image"]) ?>" alt="<?= htmlspecialchars($product["name"]) ?>" class="w-16 h-16 object-cover">
                                <?php else : ?>
                                    No image
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product["name"]) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product["category_name"]) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product["description"]) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($product["quantity"]) ?></td>
                            <td class="px-4 py-2">$<?= htmlspecialchars(number_format($product["price"], 2)) ?></td>
                    
                            <td class="px-4 py-2">
                                <a href="update.php?id=<?= $product["id"]; ?>" class="text-blue-600 hover:underline">Edit</a>
                                <form action="./controllers/products/delete.php" method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?= $product["id"]; ?>">
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php require "views/partials/footer.php"; ?>