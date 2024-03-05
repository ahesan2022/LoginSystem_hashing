<?php

//know about the session then you can start 
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include 'partials/dbconnect.php'; //database code

    $username = $_POST["username"];
    $password = $_POST["password"];

        //!!!!!! LOGIC

        $sql = "SELECT * from data1 where username='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 1){
          while($row = mysqli_fetch_assoc($result)){
            
            if(password_verify($password, $row['password'])){
              $login = true;
              session_start(); //session is started 
              $_SESSION['loggedin'] = true; //use to welcome page
              $_SESSION['username'] = $username; 
              header("location: welcome.php"); //header define where page going

            }
            else{
              $showError = true;
      
          }
        }
      }
        
    
    
        else{
            $showError = true;
    }
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php require('partials/navbar.php'); ?>
    <?php
    if($login){
        echo '<div class="alert alert-primary" role="alert">
        You Are Login Sucessfully
      </div>';

    }
    if($showError){
        echo '<div class="alert alert-danger" role="alert">
        Please Correct your Password
      </div>';

    }
    ?>

    
    <div class="container mt-5">
        <h1 class="text-center">Login</h1>

        <form action="/Loginsystem/login.php" method="POST">
        <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>

        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" aria-describedby="passwordHelpBlock">
        <div id="passwordHelpBlock" class="form-text">
        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
        </div>
        </div>
        <div style="text-align: center">
            <button class="btn btn-primary text-center" type="submit">Submit</button>
        </div>
</div>


</form>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>