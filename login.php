<?php 

$login = false;
$showError =false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'connection.php' ;
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "Select * from account where email='$email'";
    $result=mysqli_query($conn,$sql);

    $num = mysqli_num_rows($result);

    if($num==1){

        while($row = mysqli_fetch_assoc($result)){
            
            $res =password_verify($password,$row['password']);
            if($res){
            
                $login = true;
                
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['email']=$email;
                $_SESSION['date']=$row['reg_date'];
                header("location: welcome.php");
            }
            else{
                $showError = "Invalid Credentials";
            }
        }
        
    }
    else{
        $showError = "Invalid Credentials";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Beautiful Responsive Menu Design By Arjun Ghimire</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- this is v4 fontawesome cdn-->
    <script src="https://use.fontawesome.com/efcb6191f0.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/container.css">
    <script src="js/script.js"></script>
</head>

<body>

    <?php require 'components/_nav.php' ?>

    <div class="content">
        <div class="login-container">
            <form action="login.php" method="POST" id="logform">
                <div class="login-data">
                    <h1>Account Login</h1><hr>
                    <?php if($login){
                       echo " <p>Login success</p>";
                    }
                    if($showError){

                        echo $showError;
                    } ?>
                    <div class="input-field" style="margin-top: 30px;">
                        <i class="fa fa-user"></i>
                        <input type="email" class="inp" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="inp" name="password" placeholder="Enter your password" required>
                    </div>
                    <span style="font-size: 16px; "><input type="checkbox" id="check"><label for="check" style="cursor: pointer;position:relative;bottom:3px;"> Remember Me</label></span>
                   <br><br><button class="btn color-brown" style="margin-bottom: 10px;" type="submit">Login</button><p align="center">OR</p>
                    <button type="button" class="btn color-white" onclick="location.href='https://google.com';">Register</button>
                </div>
            </form>
            
        </div>
    </div>
    
    <?php require 'components/_footer.php' ?>

</body>

</html>