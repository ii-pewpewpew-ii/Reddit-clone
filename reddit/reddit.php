<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reddit-welcome</title>
    <link rel="stylesheet" href="css/reddit.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
</head>
<body>
    <div id = "header">
        <img src="css/img/reddit-logo-1.png" id = "logo">   
    </div>
    <div class = "center">
    <button id = "show" class = "main">Log-in</button>
    <button id = "show1" class = "main">Sign-in</button>
    </div>
    <div class="form" id = "form">
        <div class = "form-content">
            <form action="#" class="welcome" method="POST">
                <fieldset>
                    <span class="close">&times;</span>
                    <Legend>Login</Legend>    
                    <label>Username :</label>
                    <input name = "lusername" type="text" id="lusername"><br>
                    <label>Password :</label>
                    <input type = "password" name = "lpassword" id="lpassword">
                    <input type="checkbox" onclick="show()"><br>
                    <input type="submit" value="Log in" name='lsubmit' onclick='store()' >
                </fieldset>
            </form>
        </div>
    </div>
    
    <div class="form" id = "form2">
        <div class = "form-content">
            <form action="#" class="welcome" method="POST">
                <fieldset>
                    <span class="close">&times;</span>
                    <Legend>Sign-in</Legend>    
                    <label>Username :</label>
                    <input type="text" id="lusername" name = "susername" required><br>
                    <label>Password :</label>
                    <input type = "password" id="lpassword" name = "spassword" required>
                    <input type="checkbox" onclick="show()"><br>
                    <label>Bio :</label>
                    <input name='bio' type = "text">
                    <input type="submit" value="Sign in" name="ssubmit">
                </fieldset>
            </form>
        </div>
    </div>
    <?php
        if(array_key_exists('ssubmit',$_POST)){
            include 'php/db.php';       
            $username = $_POST["susername"];
            $password = $_POST["spassword"];
            $bio = $_POST["bio"];
            $query4 = "SELECT * FROM `users` WHERE `username` = '$username' ";
            $result = mysqli_query($conn,$query4);
            if(mysqli_num_rows($result)==1){
            echo "<script> alert('username already exists')</script>";    
            }else{ 
            $query = "INSERT INTO `users`(`username`, `password`, `Bio`) VALUES ('$username','$password','$bio')";
            $result = mysqli_query($conn,$query);
            $query1 = "CREATE TABLE `$username` ( `subreddits` VARCHAR(255) NOT NULL , PRIMARY KEY (`subreddits`))";
            $result = mysqli_query($conn,$query1);
            }
            mysqli_close($conn);            
            }
        if(array_key_exists('lsubmit',$_POST)){
            include 'php/db.php';       
            $username = $_POST["lusername"];
            $password = $_POST["lpassword"];
            $query3 = "SELECT `username`, `password`, `Bio` FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
            $result = mysqli_query($conn,$query3);
            if(mysqli_num_rows($result)==1){
                $_SESSION['username']=$username;
                header("Location:php/userprofile.php");
            }else{
                echo "<script>alert('invalid credentials')</script>";
            }
            mysqli_close($conn);
            }       
            ?>
    <script src="js/Modalform.js"></script>
</body>
</html>