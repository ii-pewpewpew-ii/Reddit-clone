<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reddit-welcome</title>
    <link rel="stylesheet" href="../css/preset.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
</head>
<body>
    <div id="header">
        <img src="../css/reddit-logo-1.png" id="logo">
        <?php
        $username = $_SESSION['username'];
                echo "<a href = 'userprofile.php'>u/$username</a>";
        ?>
        <button onclick = "sessionstop()" class = "show" id = "end">Log out</button>
    </div><br>
    <div id="content">
        <div class="leftpane">
            <h3>Communities joined</h3>
            <ul>
                <?php 
                include 'db.php';
                $sql1 = "SELECT `subreddits` FROM `$username` ";
                $result = mysqli_query($conn,$sql1);
                while($row = mysqli_fetch_assoc($result)){
                echo"<form action = 'subreddit.php' method = 'get' class = 'books'>
                    <input type = 'submit' value = '".$row['subreddits']."' name = 'subreddit' class = 'buttons'>
                </form>";
                }
                mysqli_close($conn);
                ?>   
            </ul>
        <hr>
        
        
        <button id="show" class="show">Create new community</button>
        <div class="form" id = "form">
            <div class = "form-content">
                <form action="#" class="welcome" method="get">
                    <fieldset>
                        <span class="close">&times;</span>
                        <Legend>Create Subreddit</Legend>    
                        <label>Subreddit Name:</label>
                        <input name = "subname" type="text" id="lusername"><br>
                        <label>Description :</label>
                        <input type = "text" name = "description" id="lpassword"><br>
                        <input type="submit" value="Create" name = 'create'>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php
        if(array_key_exists('create',$_GET)){
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
        
        <div class="">
        <button id = "show1" class = "show">Join subreddit</button>
        <div class="form" id = "form2">
            <div class = "form-content">
                <form action="#" class="welcome" method="get">
                    <fieldset>
                        <span class="close">&times;</span>
                        <Legend>Join Subreddit</Legend>    
                        <label>Subreddit Name</label>
                        <input type="text" id="jsubreddit" name = "jsubreddit"><br>
                        <input type="submit" value="Join" name = 'join'>
                    </fieldset>
                </form>
            </div>
        </div>
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
    <div class="middlepane">
        <?php
            $username = $_SESSION['username'];
            include 'db.php';
            $subreddit = $_GET['subreddit'];
            $sql = "SELECT * FROM `posts` WHERE `subreddit`	= '$subreddit' ";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
            echo "<form action = '#' method = 'post' class = 'posts'>
                <fieldset class = 'posts'>
                <legend>'".$row['Caption']."'</legend>
                <p>u/'".$row['user']."'
                on r/'".$row['subreddit']."'</p>
                <p>'".$row['post']."'</p>
                </form>
                </fieldset>";
            }
            mysqli_close($conn);
        ?>
        <form method = "get" action = "post.php">
            <input value = "<?php echo "$subreddit";?>" hidden type = "text" name = "hidden">
            <input type = 'text' name = 'caption' class='post' id = 'caption' placeholder = "caption goes here"><br>
            <input type = 'text' name = 'post' class = 'post' placeholder = "penny for your thoughts"><br>
            <input type = 'submit' value = 'post' name = 'upload' class = "show">    
        </form>

    </div>
    </div>
    
    <script src="../js/Modalform.js"></script>
    <script>
        function sessionstop(){
            window.location="../reddit.php";
        }
    </script>
    </body>
</html>