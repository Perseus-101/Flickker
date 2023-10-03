
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../css/process-order.css">
    <title>Order Placed!</title>

    <div class="top-bar">
        <div class="top-bar-container">
          <div class="logo-container">
            <a href="../index.html"><img src="../picture/icon.png" alt="Logo"></a>
          </div>
          <div class="links-container">
            <a href="../additional/help.html">Help</a> 
            <a>|</a>
            <a href="track-order.php">Track Order</a>
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
    
<?php
// connect to the database
$dbconn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup");

// get the order information from the form
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$payment_method = $_POST['payment_method'];

// calculate the total price from the cart table
$result = pg_query($dbconn, "SELECT SUM(price * quantity) AS total_price FROM cart");
$row = pg_fetch_assoc($result);
$total_price = $row['total_price'];

// generate a unique order ID
$order_id = time() . mt_rand(1000, 9999);
echo "<div class='order'>";
echo "Your Order Number: ".$order_id;
echo "</div>" ;

// get the current date and time
$order_date = date('Y-m-d H:i:s');

// insert the order into the orders table
pg_query($dbconn, "INSERT INTO orders (order_id, name, email, address, phone, payment_method, total_price, order_date) VALUES ('$order_id', '$name', '$email', '$address', '$phone', '$payment_method', $total_price, '$order_date')");

// clear the cart
pg_query($dbconn, "DELETE FROM cart");

// close the database connection
pg_close($dbconn);

?>

</body>
</html>