<?php
$heading = 'Register a user';
$currentUserId = 1;
$suggested_password = generatePassword();
view('userAccount/create.view.php',compact('heading','currentUserId','suggested_password'));