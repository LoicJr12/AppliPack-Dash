<?php 
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
        header("Location: login.inc.php");
        exit();  
    } else {
        echo "aUCUNE SESSION EN COUR";
    }
?>