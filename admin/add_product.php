<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
  <label for="name">Product Name:</label>
  <input type="text" id="name" name="name" required><br><br>

  <label for="description">Description:</label>
  <textarea id="description" name="description" required></textarea><br><br>

  <label for="price">Price:</label>
  <input type="number" id="price" name="price" min="0.01" step="0.01" required><br><br>

  <label for="picture">Picture:</label>
  <input type="file" id="picture" name="picture" required><br><br>

  <label for="stock">Stock:</label>
  <input type="number" id="stock" name="stock" min="1" required><br><br>

  <label for="category">Category:</label>
  <select id="category" name="category" required>
    <option value="" selected disabled>Select a category</option>
    <option value="activewear">Activewear</option>
    <option value="men">Men</option>
    <option value="women">Women</option>
    <option value="accessories">Accessories</option>
  </select><br><br>

  <button type="submit">Add Product</button>
</form>


     <?php
        // Define constants for image folders
        define('UPLOAD_DIR', '../order/pics');
        define('CATEGORY1_DIR', '../activewear/pics/');
        define('CATEGORY2_DIR', '../men/pics/');
        define('CATEGORY3_DIR', '../women/pics/');
        define('CATEGORY4_DIR', '../accessories/pics/');

        // Connect to the database
        $dbconn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup")
            or die("Could not connect to database");

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve form data
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $stock = $_POST['stock'];

            // Prepare SQL statement to insert product
            $query = "INSERT INTO product(name, description, price, picture_name, picture_type, picture_path, stock, category)
                      VALUES($1, $2, $3, $4, $5, $6, $7, $8)";
            $result = pg_prepare($dbconn, "", $query);

            // Handle file upload
            if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
                // Retrieve file information
                $file_name = $_FILES['picture']['name'];
                $file_tmp_name = $_FILES['picture']['tmp_name'];
                $file_type = $_FILES['picture']['type'];

                // Set up image path and filename
                $timestamp = time();
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $image_name = $file_name;
                $upload_path = $image_name;
                $upload_path_o = UPLOAD_DIR . $image_name;

                // Save image to upload folder
                move_uploaded_file($file_tmp_name, $upload_path_o);

                // Save image to category folder
                if ($category == "activewear") {
                    $category_path = CATEGORY1_DIR . $image_name;
                } else if ($category == "men") {
                    $category_path = CATEGORY2_DIR . $image_name;
                } else if ($category == "women") {
                    $category_path = CATEGORY3_DIR . $image_name;
                } else {
                    $category_path = CATEGORY4_DIR . $image_name;
                }
                copy($upload_path_o, $category_path);

                // Insert product into database
                $result = pg_execute($dbconn, "", array($name, $description, $price, $image_name, $file_type, $upload_path, $stock, $category));

                // Check if product was successfully added
                if ($result) {
                    echo "Product added successfully";
                } else {
                    echo "Failed to add product";
                }
            } else {
                echo "Failed to upload image";
            }
        }
    ?>

</body>
</html>
