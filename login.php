<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['psw'];

    
    $db = new SQLite3('database.db');

    
    $db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, email TEXT, password TEXT)');

    
    $user = $db->querySingle("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

   
    $db->close();

    if ($user) {
        
        header('Location: dashboard.php'); 
        exit();
    } else {
        
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #f2f2f2;
}

form {
  border: 3px solid #f1f1f1;
  background-color: #ffffff;
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
}


.container {
  display: flex;
  flex-direction: column; 
  justify-content: center; 
  align-items: center; 
  min-height: 100vh; 
}

span.psw {
  float: right;
  padding-top: 16px;
}

@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<div class="container">
  <form action="login.php" method="post">
    <div class="imgcontainer">
      <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" alt="Avatar" class="avatar">
    </div>

    <div>
      <label for="email"><b>Email</b></label>
      <input type="text" id="email" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" id="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>
</body>
</html>