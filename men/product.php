<html>
<head>
  <link rel="stylesheet" href="../css/product.css">
  <title>Product</title>

  <div class="top-bar">
    <div class="top-bar-container">
      <div class="logo-container">
        <a href="../index.html"><img src="../picture/icon.png" alt="Logo"></a>
      </div>
      <div class="links-container">
        <a href="../additional/help.html">Help</a> 
        <a>|</a>
        <a href="html-pages/track.php">Track Order</a>
      </div>
    </div>
</div>
  
<nav>
    <div class="nav-container">
      <div class="nav-left">
        <ul>
          <li> <a href="../activewear/activewear.php">Activewear</a>   </li>
          <li> <a href="../men/men.php">Mens</a>         </li>
          <li> <a href="../women/women.php">Womens</a>       </li>
          <li> <a href="../accessories/accessories.php">Accessories</a>  </li>
        </ul>
      </div>
      <div class="nav-center">
        <a href="../index.html" class="logo">Flickker</a>
      </div>
      <div class="nav-right">
        <ul>
          <li> <a href="view-cart.php">Your Cart</a> </li>
        </ul>
      </div>
    </div>
  </nav>


</head>
<body>
  <br><br>
  
  <?php
$host = "localhost";
$dbname = "flickker";
$user = "denil";
$password = "mothercup";

// Connect to the database
$db = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Check if the product_id is set
//if (!isset($_GET['product_id'])) {
//    echo "Product not found.";
//    exit;
//}

$product_id = $_GET['product_id'];

// Retrieve the product information from the database
$query = "SELECT * FROM product WHERE product_id = '$product_id'";
$result = pg_query($query);
if (!$result) {
  echo "An error occurred.\n";
  exit;
}
if (!$result || pg_num_rows($result) == 0) {
    echo "Product not found.";
    exit;
}

$product = pg_fetch_assoc($result);

// Generate the product webpage
echo '<div class="product">';
echo '<div class="product-image">';
echo '<img src="pics/' . $product['picture_path'] . '" alt="Product Image">';
echo '</div>';
echo '<div class="product-info">';
echo '<h1>' . $product['name'] . '</h1>';
echo '<p class="product-description">' . $product['description'] . '</p>';
echo '<form action="../order/add-to-cart.php" method="post" onsubmit="return addItemToCart()">';
echo '<input type="hidden" name="product_id" value="' . $product['product_id'] . '">';
echo '<input type="hidden" name="product_name" value="' . $product['name'] . '">';
echo '<input type="hidden" name="picture_path" value="' . $product['picture_path'] . '">';
echo '<div class="product-price">';
echo '<p style="margin-top: 20px; margin-bottom: 20px;">MRP : ₹ ' . $product['price'] . '</p>';
echo '</div>';
echo '<input type="hidden" name="price" value="' . $product['price'] . '">';
echo '<span style="font-size: 20px; margin-top: 10px; margin-bottom: 10px;">Select Size</span>';
echo '<div class="size-options">';
echo '<input type="radio" id="small" name="size" value="small">';
echo '<label for="small">S</label>';
echo '<input type="radio" id="medium" name="size" value="medium">';
echo '<label for="medium">M</label>';
echo '<input type="radio" id="large" name="size" value="large">';
echo '<label for="large">L</label>';
echo '<input type="radio" id="xlarge" name="size" value="xlarge">';
echo '<label for="xlarge">XL</label>';
echo '<input type="radio" id="xxlarge" name="size" value="xxlarge">';
echo '<label for="xxlarge">2XL</label>';
echo '</div>';
echo '<div style="margin-top: 20px; margin-bottom: 0px;" class="quantity-dropdown">';
echo '<span >Quantity:</span>';
echo '<select name="quantity">';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '<option value="3">3</option>';
echo '<option value="4">4</option>';
echo '</select>';
echo '</div>';
echo '<button style="margin-top: 20px; margin-bottom: 20px;" type="submit">Add to Bag</button>';
echo '<button type="button">Favorite &nbsp;♡</button>';
echo '</form>';
echo '</div>';
echo '</div>';
?>
  
  <footer>
    <br><br>
    <div class="copyright">
      <p style="color: #fff;">&copy; 2023 Flickker. All rights reserved.</p>
    </div>
  </footer>

</body>

<script>
function addItemToCart() {
  // Get the selected size
  var selectedSize = document.querySelector('input[name="size"]:checked');
  if (!selectedSize) {
    // Display an error message if size is not selected
    alert("Please select a size.");
    return false;
  }

  // Get the selected quantity
  var selectedQuantity = document.querySelector('select[name="quantity"]').value;
  if (selectedQuantity === "") {
    // Display an error message if quantity is not selected
    alert("Please select a quantity.");
    return false;
  }

  // Display a success message if both size and quantity are selected
  alert("Item added to cart.");

  // Submit the form
  return true;
}
</script>

</html>