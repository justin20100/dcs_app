<?php

$heading = 'Register a user';
$_SESSION['suggested_password'] = generatePassword();
view('userAccount/create.view.php', compact('heading'));