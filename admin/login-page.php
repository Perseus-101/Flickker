<html>
<head>
    <link rel="stylesheet" href="../css/login-page.css">
    <title>Home</title>

    <div class="header">
        <div class="header-section">
            <div class="logo">
                <h1><a href="../index.html" style="color: white;">Flickker</a></h1>
            </div>
            <ul class="theme">
                <a><li>Everything you need!</li></a>
            </ul>
        </div>
    </div>
</head>
<body>
    <br><br><br><br><br>
    <div class="login-container">
        <h2>Login</h2>
        <br>
        <form action="login-page.php" method="POST">
          <label for="username"></label>
          <input type="text" id="username" name="username" placeholder="Enter username" required>
  
          <label for="password"></label>
          <input type="password" id="password" name="password" placeholder="Enter password" required>
            <br>
          <button type="submit">Login</button>
        </form>
      </div>

     <?php
  // Set up database connection
  $host = "localhost";
  $dbname = "flickker";
  $user = "denil";
  $password = "mothercup";

  $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");
  
  // Check if form was submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to check if user exists
    $query = "SELECT * FROM users WHERE username = $1 AND password = $2";
    $result = pg_prepare($conn, "", $query);
    $result = pg_execute($conn, "", array($username, $password));

    // Check if login was successful
    if (pg_num_rows($result) == 1) {
      // Redirect to admin control page
      header("Location: admin-home.html");
      exit();
    } else {
      // Display error message
      echo "Invalid username or password";
    }
  }
?>


  <footer>
    <br><br><br><br><br>
    <div class="copyright">
      <p style="color: #fff;">&copy; 2023 Flickker. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>