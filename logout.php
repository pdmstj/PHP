<?php
session_start();
session_unset();
session_destroy();
header('Location: membership.php?page=login');
exit;
?>
