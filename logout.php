<?php
setcookie("SESSION_HIS","");
unset($_COOKIE["SESSION_HIS"]);

header('location:login.php');