<?php
session_start();
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 'true') {
	header('Location: login.php');
	die();
}
// if (isset($_SESSION['username'])){
//   echo 'Bạn đã đăng nhập với tên là '.$_SESSION['username']."<br/>";
// }
if(isset($_COOKIE['username'])){
	echo 'Bạn đã đăng nhập với tên là '.$_COOKIE['username']."<br/>";
}
echo 'Click vào đây để <a href="logout.php">Logout</a>';
?>