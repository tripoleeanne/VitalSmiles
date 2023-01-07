<?php 
require('./database.php');

if(isset($_POST['register']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if(empty($username) || empty($password) || empty($confirmPassword)){
       $errorMessage = "Please fill all the fields";
    }
    else{
        if($password != $confirmPassword){
           $errorMessage = "Password does not match.";
        }
        else{
            $queryValidate = "SELECT username FROM users WHERE username = '$username'";
            $sqlValidate = mysqli_query($connection, $queryValidate);

            if(mysqli_num_rows($sqlValidate) > 0){
                $errorMessage = "Username already exists.";
            }
            
            else{
                $queryRegister = "INSERT INTO users VALUES (NULL,NULL,$username,md5($password),null,null,null,null,null)";
                $sqlRegister = mysqli_query($connection, $queryRegister);

                if($sqlRegister){
                    $accountCreated = "Account created successfully.";
                }
                else{
                   $errorMessage ="Something went wrong.";
                }
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VitalSmiles</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
    *{
      font-family: 'Quicksand', sans-serif;
    }
  </style>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body style="background-color: #FFF7EC !important;">
  <section>
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <form action="register.php" method="post">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <img src="../assets/image.png" alt="logo" class="img-fluid" style="height:190px;">
              <h4 class="mb-5">Create an Account</h4>

              <div class="form-outline mb-4">
                <input type="text" name="username" class="form-control form-control-lg" />
                <label class="form-label">Username</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" name="password" class="form-control form-control-lg" />
                <label class="form-label">Password</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="password" name="confirmPassword" class="form-control form-control-lg" />
                <label class="form-label">Confirm Password</label>
              </div>

              <?php
                        if(isset($errorMessage)){
                        echo '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
                        } 
                        else{
                            if(isset($accountCreated)){
                                echo '<div class="alert alert-success" role="alert">'.$accountCreated.'</div>';
                            }
                        }
                ?>   

              <input class="btn btn-primary btn-lg btn-block mb-3" name='register' type="submit" style="background-color:#2C64C6; color:white;" value="Register">
             <h6>Already have an account? <a href="./login.php">Log in</a>.</h6>

            </div>
          </div>

        </form>
         
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>