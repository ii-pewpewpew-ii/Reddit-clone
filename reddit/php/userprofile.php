<?php
    session_start();
?>
<html lang="en">
<head>

        <?php 
        if(isset($_COOKIE['color'])){
           $theme = $_COOKIE['color']; 
        }else{
            $theme =  'black';
        } ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reddit-welcome</title>
    <link rel="stylesheet" href="../css/preset.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
</head>
<body onload = 'theme("<?php echo $theme; ?>")'>
    <div id="header">
        <img src="../css/reddit-logo-1.png" id="logo">
        <button id = "Dark" onclick="theme('black')" class="buttons">Dark mode</button>
        <button id = "Light" onclick="theme('white')" class = "buttons">Light mode</button>
        <button onclick = "sessionstop()" class = "show" id = "end">Log out</button>    
    </div><br>
    <div id="content">
    <div class="leftpane">
        <h3>Communities joined</h3>
        <?php 
        include 'db.php';
        $username = $_SESSION['username'];
        $sql1 = "SELECT `subreddits` FROM `$username` ";
        $result = mysqli_query($conn,$sql1);
        while($row = mysqli_fetch_assoc($result)){
        echo"<form action = 'subreddit.php' method = 'get'>
            <input type = 'submit' value = '".$row['subreddits']."' name = 'subreddit' class = 'buttons'>
        </form>";
        }
        mysqli_close($conn);
        ?>   
        <hr>
        <button id="show" class = "show">Create new community</button><br>
        <div class="form" id = "form">
            <div class = "form-content">
                <form action="#" class="welcome" method="Get">
                    <fieldset>
                        <span class="close">&times;</span>
                        <Legend>Create Subreddit</Legend>    
                        <label>Subreddit Name:</label>
                        <input name = "subname" type="text" id="lusername"><br>
                        <label>Description :</label>
                        <input type = "text" name = "description" id="lpassword"><br>
                        <input type="submit" value="Create" name = "Create">
                    </fieldset>
                </form>
            </div>
        </div>
        <?php
        if(array_key_exists('Create',$_GET)){
        $username = $_SESSION['username'];
        $subreddit = $_GET['subname'];
        $description = $_GET['description'];
        include 'db.php';
        $sql = "SELECT * FROM `subreddits` WHERE `Name`	= '$subreddit'";
        $result = mysqli_query($conn,$sql);    
        if(mysqli_num_rows($result)==1){
            echo "<script>alert('Subreddit already exists')</script>";
        }else{ 
            $sql1 = "INSERT INTO `subreddits`(`Name`, `admin`, `Description`) VALUES ('$subreddit','$username','$description')";
            $sql2 = "INSERT INTO `$username`(`subreddits`) VALUES ('$subreddit')";
            $result = mysqli_query($conn,$sql1);
            $result = mysqli_query($conn,$sql2);
        }
         }
        ?>
        <button id = "show1" class="show">Join subreddit</button>
        <div class="form" id = "form2">
            <div class = "form-content">
                <form action="#" class="welcome" method="get">
                    <fieldset>
                        <span class="close">&times;</span>
                        <Legend>Join Subreddit</Legend>    
                        <label>Subreddit Name</label>
                        <input type="text" id="jsubreddit" name = "jsubreddit"><br>
                        <input type="submit" value="Sign in" name = "join">
                </fieldset>
            </form>
        </div>
        <?php
        if(array_key_exists('join',$_GET)){
        $username = $_SESSION['username'];
        $subreddit = $_GET['jsubreddit'];
        include 'db.php';
        $sql = "SELECT * FROM `subreddits` WHERE `Name`	= '$subreddit'";
        $result = mysqli_query($conn,$sql);    
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
            $join = $row['Name'];
            $sql3 = "INSERT INTO `$username`(`subreddits`) VALUES ('$join')";
            $result = mysqli_query($conn,$sql3);
        }else{
            echo "<script>alert('Subreddit does not exist')</script>";
        }
    }
        ?>
    </div>
    </div>
    <div class="middlepane">
        <?php
            $username = $_SESSION['username'];
            include 'db.php';
            $sql = "SELECT * FROM `posts`WHERE `user` = '$username' ";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
            echo "<form action = '#' method = 'post' class = 'post'>
                <p>'".$row['user']."' on '".$row['subreddit']."'</p>
                <p>'".$row['post']."'</p>
                </form>";
            }
            mysqli_close($conn);
        ?>
    </div>
    </div>
    <script src="../js/Modalform.js"></script>
    <script>
        function theme(mode){
            var change = document.querySelector('.middlepane');
            switch (mode){
                case 'white' : change.style.backgroundColor = 'white';
                change.style.color = "black";
                $.post('changetheme.php',{color:mode},function(d){alert(d)});
                break;
                case 'black' : change.style.backgroundColor = 'black';
                change.style.color = "white";
                $.post('changetheme.php',{color:mode});
                break;
            } 
        }
    </script>
</body>
</html>
        

