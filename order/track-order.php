<html>
<head>
    <link rel="stylesheet" href="../css/track-order.css">
    <title>FAQs & Help</title>
    
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
            <li> <a href="../activewear/activewear.html">Activewear</a> </li>
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
    <br><h1>Track your Order</h1><br><br>

    <?php
$conn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $order_id = $_POST["order_id"];
  $query = "SELECT shipment_status FROM orders WHERE order_id = $order_id";
  $result = pg_query($conn, $query);
  $row = pg_fetch_assoc($result);
  $shipment_status = $row["shipment_status"];
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="text" name="order_id" placeholder="Enter Order ID"required>
  <button type="submit" value="Track Package">Track Package</button>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($shipment_status) {
    echo "<p>Your order status is: " . $shipment_status . "</p>";
  } else {
    echo "<p>Invalid order ID. Please try again.</p>";
  }
}
?>
</form>


      
      <footer>
        <br><br>
        <div class="copyright">
          <p style="color: #fff;">&copy; 2023 Flickker. All rights reserved.</p>
        </div>
      </footer>
      
    </body>
    </html>