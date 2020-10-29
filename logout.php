<?php
    echo "oops";
    session_start();
    session_destroy();
    header('location:homepage.html');
?>