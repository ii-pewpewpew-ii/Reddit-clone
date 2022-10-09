<?php
    $theme = $_POST['color'];
    setcookie("color", $theme, time()+2*24*60*60,"/");
    echo $theme;
?>