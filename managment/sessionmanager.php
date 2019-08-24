<?php
  // If user not logged in, redirect to log in page.
  if(!(isset($_SESSION['AdminLoggedIn']) && isset($_SESSION['AdminUsername']) && $_SESSION['AdminLoggedIn']==1)){
    echo "<meta http-equiv='refresh' content='0;/admin/login.php?redir=" . urlencode($_SERVER['REQUEST_URI']) . "'>";
    exit;
  }
?>
