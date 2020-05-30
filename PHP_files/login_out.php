<?php
session_start();
session_destroy();
unset($_SESSION);
header("location: http://localhost/Organization/index.html");
?>