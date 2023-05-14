<?php
  // Start the session
  session_start();

  // Connect to the database
  $dbname = 'tempbase.db';
  $db = new SQLite3($dbname);

  // Check if the login form has been submitted
  if (isset($_POST['submit'])) {
    // Retrieve the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check the username and password against the database
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();

    // If there is a match, log the user in and redirect to the home page
    if ($result->fetchArray()) {
      $_SESSION['loggedin'] = true;
      header('Location: ctrpanel.php');
      exit;
    } else {
      // If there is no match, display an error message
      $error = 'Invalid username or password';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
      }
      h1 {
        text-align: center;
        color: #444;
      }
      form {
        width: 300px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
      label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }
      input[type="text"],
      input[type="password"] {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 3px;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }
      input[type="submit"] {
        display: block;
        background-color: #3498db;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: #2980b9;
      }
      .error {
        color: #c00;
        font-weight: bold;
        margin-bottom: 10px;
      }
    </style>
  </head>
  <body>
    <h1>Login</h1>

    <?php if (isset($error)): ?>
      <div class="error"><?php echo $error ?></div>
    <?php endif ?>

    <form method="post" action="">
      <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div>
        <input type="submit" name="submit" value="Login">
      </div>
    </form>
  </body>
</html>
