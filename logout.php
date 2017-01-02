<?php
require 'core/init.php';
session_destroy();
Redirect::to('login.php');
?>