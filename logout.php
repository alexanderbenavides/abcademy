<?php
    session_start();
    unset($_SESSION['studentUsername']);
    unset($_SESSION['studentLoggedIn']);
    if(isset($_GET['logout'])) {
        echo '<meta http-equiv="refresh" content="0;/login?logout=forced&u='.$_SESSION['u'].'">';
        unset($_SESSION['u']);
        exit;
    } else {
       echo '<meta http-equiv="refresh" content="0;/login?logout=true">';
        unset($_SESSION['u']);
        exit;
    }
?>
