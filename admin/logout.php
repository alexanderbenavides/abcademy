<?php
    session_start();
    unset($_SESSION['AdminLoggedIn']);
    unset($_SESSION['AdminUsername']);
?>

<meta http-equiv="refresh" content="0;/admin/login.php?logout=true">
