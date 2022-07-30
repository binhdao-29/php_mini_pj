<?php session_start(); 
 
if (isset($_SESSION['username'])){
    unset($_SESSION['username']);
    unset($_SESSION['password']); 
    
}
if(isset($_COOKIE['login']) && isset($_COOKIE['username'])){
    setcookie('login' , 'false' ,time() -1) ;
    setcookie('username' ,'' , time() -1) ;
}
header("location:login.php");
?>
