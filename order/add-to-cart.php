<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $path = $_POST['picture_path'];
    $product_name = $_POST['product_name']; 

    // Create a connection to the database
    $conn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup");

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    // Create the SQL query to insert the form data into the database
    $sql = "INSERT INTO cart (product_id, price, size, quantity, picture_path, product_name) VALUES ('$product_id', $price, '$size', $quantity, '$path', '$product_name')";

    // Execute the query
    $result = pg_query($conn, $sql);
    echo '<script>showPopup();</script>';

    // Check if the query was successful
    if (!$result) {
        die("Error: " . pg_last_error());
    }

    // Close the database connection
    pg_close($conn);
    header("Location: ../index.html");
}
?>
