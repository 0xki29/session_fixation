<?php 
require "auth.php";

auth();
echo "Welcome " . $_SESSION['username'] . "!";

?>