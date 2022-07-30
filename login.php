<?php
    session_start();
    include('connection.php');
    $conn = DB::getConn();
    if(isset($_COOKIE['login']) && $_COOKIE['login'] =='true'){
        header("location:trangchu.php");
        die();
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        $f_username = $_POST['username'];
        $f_password = $_POST['password'];
    }
    $error = "" ;
    $usernameErr = $passwordErr = $check = "" ;
    if(isset($_POST['dangnhap'])){
        if(!$f_username || !$f_password){
            $error = "Vui lòng nhập đủ tài khoản và mật khẩu";
        }else{
            $sql = "SELECT username, password FROM member WHERE username='$f_username'" ;
            if(mysqli_num_rows(mysqli_query($conn , $sql)) == 0){
                $usernameErr = "Tên đăng nhập không tồn tại" ;
            }else{
                $password = md5($f_password);
                $row = mysqli_fetch_array(mysqli_query($conn , $sql));
                if($row['password'] != $password){
                    $passwordErr = "Mật khẩu không đúng";
                }else{
                    $check = "Đăng nhập thành công" ;
                    $_SESSION['username'] = $f_username;
                    $_SESSION['password'] = $f_password;
                    if(isset($_POST['remember'])){
                        setcookie('login' , 'true' , time() + 60*60*7);
                        setcookie('username' , $f_username , time() + 60*60*7);
                    }
                    header("location:trangchu.php");
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <style>
            .error {color: #ff0001;} 
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div class="container">
                <div class="row justify-content-around">
                    <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="col-md-6 bg-light p-3 my-3">
                        <h1 class="text-center text-uppercase h3 py-3">Đăng Nhập</h1>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username">
                            <span class="error"><?php echo $usernameErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <span class="error"><?php echo $passwordErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="remember">Remember me</label>
                            <input type="checkbox" class="form-control" name="remember" id="remember">
                        </div>
                        <input type="submit" value="Đăng Nhập" name="dangnhap" class="btn-primary btn btn-block">
                        <?php echo $check ; ?>
                        <?php echo $error ; ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>