<?php
           session_start();           
           $username = $_SESSION['username'];
           include 'db.php';
           $caption = $_GET['caption'];
           $subreddit = $_GET['hidden'];
           $post = $_GET['post'];
           $sql4 = "INSERT INTO `posts`(`user`, `subreddit`, `post`,`Caption`) VALUES ('$username','$subreddit','$post','$caption')";
           $result = mysqli_query($conn,$sql4);
           header("Location:".$_SERVER['HTTP_REFERER']."");
       
?>