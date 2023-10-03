<html>
<head>
  <link rel="stylesheet" href="../css/view-cart.css">
  <title>Activewear</title>
  
  <div class="top-bar">
    <div class="top-bar-container">
      <div class="logo-container">
        <a href="../index.html"><img src="../picture/icon.png" alt="Logo"></a>
      </div>
      <div class="links-container">
        <a href="../additional/help.html">Help</a> 
        <a>|</a>
        <a href="../order/track-order.php">Track Order</a>
      </div>
    </div>
  </div>
  
  <nav>
    <div class="nav-container">
      <div class="nav-left">
        <ul>
          <li> <a href="../activewear/activewear.php">Activewear</a> </li>
          <li> <a href="../men/men.php">Mens</a> </li>
          <li> <a href="../women/women.php">Womens</a> </li>
          <li> <a href="../accessories/accessories.php">Accessories</a> </li>
        </ul>
      </div>
      <div class="nav-center">
        <a href="../index.html" class="logo">Flickker</a>
      </div>
      <div class="nav-right">
        <ul>
          <li> <a href="../order/view-cart.php">Your Cart</a> </li>
        </ul>
      </div>
    </div>
  </nav>
  
</head>
<body>

	  <br><br>
	<h1 style="text-align: center;">Cart</h1><br>

	<table class="my-table">
  <thead>
    <tr>
      <th>Item</th>
      <th>Product Name</th>
      <th>Price</th>
      <th>Size</th>
      <th>Quantity</th>
      <th>Total Price</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $conn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup");
    $query = "SELECT * FROM cart";
    $result = pg_query($conn, $query);

    $total_price = 0;

    while ($row = pg_fetch_assoc($result)) {
      $picture = $row['picture_path'];
      $product_name = $row['product_name'];
      $price = $row['price'];
      $size = $row['size'];
      $quantity = $row['quantity'];
      $total = $price * $quantity;
      $total_price += $total;

      echo "<tr>";
      echo '<td class="bordered"><img height="100" src="pics/'.$picture.'"></td>';
      echo "<td class='bordered'>$product_name</td>";
      echo "<td class='bordered'>$price</td>";
      echo "<td class='bordered'>$size</td>";
      echo "<td class='bordered'>$quantity</td>";
      echo "<td class='bordered'>$total</td>";
      echo '<td class="bordered"><form method="POST" action=""><button type="submit" name="delete" value="'.$product_name.'">Delete</button></form></td>';
      echo "</tr>";
    }

    if (isset($_POST['delete'])) {
      $product_name = $_POST['delete'];
      $query = "DELETE FROM cart WHERE product_name ='$product_name'";
      pg_query($conn, $query);
      header("Location: view-cart.php");
    }


    pg_close($conn);
    ?>
    <tr>
      <td colspan="5" class="total-price1"><b>Total Price:</b></td>
      <td class="total-price2"><?php echo $total_price; ?></td>
    </tr>
  </tbody>
</table>
<br>

	<a style="margin-left: 1220px;" href="checkout.php">Proceed to Checkout</a>

  

</body>
</html>
