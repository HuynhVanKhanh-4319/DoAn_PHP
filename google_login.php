<?php
require_once 'config.php';

$auth_url = $gClient->createAuthUrl();
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
exit();
?>
