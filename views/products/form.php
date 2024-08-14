

    <form method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">

        <?php if (!empty($errors)) : ?>
            <div class="mb-4 w-full p-4 bg-red-400 text-sm text-white">
                <?php foreach ($errors as $error) : ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name of Product</label>
            <input type="text" value="<?= htmlspecialchars($name) ?>" id="name" name="name" placeholder="Name of product" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea id="description" name="description" placeholder="Description" rows="4" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($description) ?></textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
            <select name="category_id" id="category_id" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Select a category</option>
                <?php foreach ($categories as $category) : ?>
                    <option 
                    value="<?= htmlspecialchars($category['id']) ?>" 
                    <?= $category['id'] == $category_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity</label>
            <input type="number" value="<?= htmlspecialchars($quantity) ?>" id="quantity" name="quantity" placeholder="Quantity" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
            <input type="text" value="<?= htmlspecialchars($price) ?>" id="price" name="price" placeholder="Price" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <?php if (!empty($product["image"])) : ?>
            <img src="<?= htmlspecialchars($product["image"]); ?>" alt="Product Image" class="w-32 h-32 object-cover rounded shadow-md border border-gray-300">
        <?php endif; ?>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image </label>
            <input type="file"  id="image" name="image" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition duration-200">Create</button>
    </form>


