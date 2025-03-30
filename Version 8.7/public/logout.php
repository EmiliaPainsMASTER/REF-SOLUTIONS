<?php
require_once('../src/Core/Utilities/session.php');
$session = new session();
$session->forgetSession();
header('Location: login.php');
exit();