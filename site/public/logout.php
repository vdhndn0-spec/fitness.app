<?php
/**
 * Logout Page
 */
require __DIR__ . '/../includes/db.php';

logoutUser();

header('Location: login.php');
exit;
