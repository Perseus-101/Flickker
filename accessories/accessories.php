<html>
<head>
  <link rel="stylesheet" href="../css/shared.css">
  <title>Accessories</title>
  
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
  <div class="grid-container">
    <?php
    // Connect to the database
    $conn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup");
    
    // Query the database to get all products
    $result = pg_query($conn, "SELECT * FROM product WHERE category = 'accessories'");
    
    // Loop through the results and generate the HTML code
    while ($row = pg_fetch_assoc($result)) {
      echo "<div class='grid-item'>";
        echo "<a href='product.php?product_id=" . $row['product_id'] . "'><img src='pics/" . $row['picture_path'] . "'></a>";
        echo "<div class='product-name'>" . $row['name'] . "</div>";
        echo "</div>";
      }
      
      // Close the database connection
      pg_close($conn);
      ?>
    </div>
    
    <footer>
      <br><br>
      <div class="copyright">
        <p style="color: #fff;">&copy; 2023 Flickker. All rights reserved.</p>
      </div>
    </footer>
    
  </body>
  </html>