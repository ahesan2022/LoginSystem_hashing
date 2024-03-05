<?php
$showAlert = false; //alert message
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include 'partials/dbconnect.php'; //database connect code

    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    //$exists=false;  //check whether account is created or not. or password match with cpassword.

    //check whether its exists or not
    $existsSql = "SELECT * FROM `data1` WHERE username ='$username'";
    $result = mysqli_query($conn,$existsSql);
    $row = mysqli_num_rows($result);
    if($row > 0){
        $showError = true;
    }
    else{
        $exists = false;
        if(($password == $cpassword) && $exists==false){

          $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `data1` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())"; //sql query to insert the data //apply hashing
            $result = mysqli_query($conn, $sql);
    
            if ($result){
                $showAlert = true;
            }
        }
        
            else{
                $showError = true;
        }
    }  
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php require('partials/navbar.php'); ?>
    <?php
    if($showAlert){
        echo '<div class="alert alert-primary" role="alert">
        You Are Sign Up Sucessfully
      </div>';

    }
    if($showError){
        echo '<div class="alert alert-danger" role="alert">
        Please Correct Your Password and user already exists
      </div>';

    }
    ?>

    
    <div class="container mt-5">
        <h1 class="text-center">Signup our Web Page</h1>

        <form action="/Loginsystem/signup.php" method="POST">
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
        <div class="mb-3">
        <label for="cpassword" class="form-label">Confirm Password</label>
        <input type="password" id="cpassword" name="cpassword" class="form-control" aria-describedby="passwordHelpBlock">
        <div id="passwordHelpBlock" class="form-text">
        Make sure to type the same password 
        </div>
</div>

        <div style="text-align: center">
            <button class="btn btn-primary text-center" type="submit">Submit</button>
        </div>
</form>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>