<html>
<head>
	<title>Checkout Form</title>

    <link rel="stylesheet" href="../css/checkout.css">
    <title>Document</title>

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
              <li> <a href="view-cart.php">Checkout</a> </li>
            </ul>
          </div>
        </div>
      </nav>

</head>
<body>
	<h1>Checkout Form</h1>
	<div class="checkout">
	<form action="process-order.php" method="post" onsubmit="return validateForm()">

		<label for="name">Name:</label>
		<input type="text" id="name" name="name" required><br><br>

		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required><br><br>

		<label for="address">Address:</label>
		<input type="text" id="address" name="address" required><br><br>

		<label for="phone">Phone:</label>
		<input type="tel" id="phone" name="phone" required><br><br>

		<label for="payment">Payment Method:</label>
		<select id="payment" name="payment" required>
			<option value="">-- Select Payment Method --</option>
			<option value="credit">Credit Card</option>
			<option value="debit">Debit Card</option>
			<option value="paypal">PayPal</option>
		</select><br><br>

		<label for="total">Total Price:</label>
		<?php
			$dbconn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup")
				or die("Could not connect: " . pg_last_error());
			$query = "SELECT SUM(price*quantity) AS total_price FROM cart";
			$result = pg_query($query) or die("Query failed: " . pg_last_error());
			$row = pg_fetch_array($result, null, PGSQL_ASSOC);
			$total_price = $row["total_price"];
			echo "<input type=\"text\" id=\"total\" name=\"total\" value=\"$total_price\" readonly>";
			pg_free_result($result);
			pg_close($dbconn);
		?><br><br>

		<button type="submit" value="Place Order">Place Order</button>
	</form>
	</div>
</body>

<script>
	function validateForm() {
		var name = document.getElementById("name").value;
		var email = document.getElementById("email").value;
		var address = document.getElementById("address").value;
		var phone = document.getElementById("phone").value;
		var payment = document.getElementById("payment").value;
		
		if (name == "" || email == "" || address == "" || phone == "" || payment == "") {
			alert("Please select all options.");
			return false;
		}
	}
</script>

</html>
