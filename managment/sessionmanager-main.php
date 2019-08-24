<?php
  // If user not logged in, redirect to log in page.
  if(!(isset($_SESSION['studentLoggedIn']) && isset($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn']==1)){
    echo "<meta http-equiv='refresh' content='0;/login.php?redir=" . urlencode($_SERVER['REQUEST_URI']) . "'>";
    exit;
  }
?>
