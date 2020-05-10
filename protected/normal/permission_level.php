<?php if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] < 1) : ?>
    <center><h1>Your access level is USER!</h1></center>
<?php else : ?>
    <center><h1>Your access level is ADMINISTRATOR!</h1></center>
<?php endif; ?>