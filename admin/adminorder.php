<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../css/adminorder.css">
    <title>Document</title>

    <div class="top-bar">
        <div class="top-bar-container">
          <div class="logo-container">
            <a href="index.html"><img src="../picture/icon.png" alt="Logo"></a>
          </div>
        </div>
    </div>
    <nav>
          <div class="nav-center">
            <a href="#" class="logo">Flickker Admin</a>
          </div>
      </nav>

</head>
<body>
  <br>
  <h1>Orders Placed</h1><br>
    
<?php
    // Connect to the database
    $dbconn = pg_connect("host=localhost dbname=flickker user=denil password=mothercup")
        or die("Could not connect to database");

    // Retrieve all orders from the database
    $query = "SELECT * FROM orders";
    $result = pg_query($query) or die("Query failed: " . pg_last_error());

    // Display the orders in a table
    echo "<table>";
    echo "<tr><th>Order ID</th><th>Name</th><th>Email</th><th>Address</th><th>Phone</th><th>Total Price</th><th>Order Date</th></tr>";
    while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["total_price"] . "</td>";
        echo "<td>" . $row["order_date"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";

    // Free up resources
    pg_free_result($result);
    pg_close($dbconn);
?>

  <div class="back">
    <a href="admin-home.html">Go Back</a>
  </div>
</body>
</html>