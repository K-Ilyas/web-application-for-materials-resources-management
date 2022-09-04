<?php
session_start();
if (isset($_SESSION['ppr_admin'])) {
	$_SESSION = array();
	session_destroy();
	$_POST = array();
	$_GET = array();
	$_COOKIE = array();
	setcookie("ppr_admin", "", time() - 3600);
	setcookie("image_admin", "", time() - 3600);
	header('Location:index.php');
} else {
	header('Location:error.php');
}
