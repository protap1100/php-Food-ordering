<?php

include '../config/connection.php';	

session_destroy(); // $_session[]

header('location:'.SITEURL.'admin/login.php')

?>