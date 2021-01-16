<?php
// start session 
session_start();
// unset session
session_unset();
// redirect to the login page
header('location:../index.php');