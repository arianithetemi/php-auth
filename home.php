<?php
    session_start();

    if(isset($_SESSION['success'])) {
        echo "logged in";
    } else {
        echo "not logged in";
    }
?>
<h1>HOME</h1>
