<?php if(!IsUserLoggedIn()) : ?>
	<center><h1>This is the home page for everybody.</h1></center>
<?php else :?>
    <center><h1> Welcome back <?=$_SESSION['name_first'].' '.$_SESSION['name_last'].' !'?></h1></center>
<?php endif; ?>