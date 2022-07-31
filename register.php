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
    <?php 
        include('connection.php');
        $conn = DB::getConn();
        if(isset($_COOKIE['login']) && $_COOKIE['login'] =='true'){
            header("location:index.php?controller=members");
            die();
        }
        $usernameErr = $emailErr = $passwordErr = $genderErr = $birthdayErr = $fullnameErr = "";
        $username = $email = $password = $gender = $birthday= $fullname = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty($_POST["username"])){
                $usernameErr = "Vui lòng nhập tên đăng nhập";
            }else{
                $username = input_data($_POST["username"]);
                // Kiểm tra và chỉ cho phép nhập chữ và khoảng trắng 
                if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
                    $usernameErr = "Bạn chỉ được nhập chữ cái và khoảng trắng.";
                }
                $sql = "SELECT username FROM members WHERE username='$username'" ;
                if(mysqli_num_rows(mysqli_query($conn ,$sql))){
                    $usernameErr = " Tên đăng nhập đã tồn tại" ;
                }
            }

            if(empty($_POST['password'])){
                $passwordErr = "Vui lòng nhập mật khẩu" ;
            }else{
                $password = input_data($_POST['password']);
            }

            $password1 = md5($password);

            if(empty($_POST['email'])){
                $emailErr = "Vui lòng nhập email" ;
            }else{
                $email = input_data($_POST['email']);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Email không đúng định dạng" ;
                }
                $sql = "SELECT email FROM members WHERE email='$email'" ;
                if(mysqli_num_rows(mysqli_query($conn , $sql))){
                    $emailErr = "Email đã được sử dụng" ;
                }
            }

            if(empty($_POST['fullname'])){
                $fullnameErr = "Vui lòng nhập tên" ;
            }else{
                $fullname = input_data($_POST['fullname']);
            }

            if(empty($_POST['birthday'])){
                $birthdayErr = "Vui lòng nhập ngày sinh" ;
            }else{
                $birthday = input_data($_POST['birthday']);
                if(!checkDateTime($birthday)){
                    $birthdayErr = "Ngày sinh không đúng định dạng" ;
                }
            }
            
            if(empty($_POST['gender'])){
                $genderErr = "Vui lòng chọn giới tính" ;
            }else{
                $gender = input_data($_POST['gender']);
            }

            $sql = "INSERT INTO members (
                username,
                password,
                email,
                fullname,
                birthday,
                gender
            )
            VALUE (
                '{$username}',
                '{$password1}',
                '{$email}',
                '{$fullname}',
                '{$birthday}',
                '{$gender}'
            )" ;
            $check = "" ;
            if($usernameErr == "" && $passwordErr == "" && $emailErr == "" && $fullnameErr =="" && $birthdayErr == "" && $genderErr ==""){
                mysqli_query($conn , $sql);
                $check = "Đăng kí thành công" ;
            }
        }

        function input_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        function checkDateTime($data){
            if(date('Y-m-d' , strtotime($data)) == $data){  
                return true ;
            } else {
                return false ;
            }
        }
    ?>
        <div id="wrapper">
            <div class="container">
                <div class="row justify-content-around">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="col-md-6 bg-light p-3 my-3">
                        <h1 class="text-center text-uppercase h3 py-3">Đăng kí tài khoản</h1>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $username ; ?>">
                            <span class="error"><?php echo $usernameErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" >
                            <span class="error"><?php echo $passwordErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email ; ?>">
                            <span class="error"><?php echo $emailErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Họ và Tên</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $fullname ; ?>">
                            <span class="error"><?php echo $fullnameErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Ngày Sinh</label>
                            <input type="text" class="form-control" name="birthday" id="birthday" value="<?php echo $birthday ; ?>">
                            <span class="error"><?php echo $birthdayErr; ?> </span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Giới Tính</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" id="male" value="male" 
                                    class="form-check-input">
                                    <label for="male" class="form-check-label">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="gender" id="female" value="male" 
                                    class="form-check-input">
                                    <label for="female" class="form-check-label">Nữ</label>
                                </div>
                            </div>
                            <span class="error"><?php echo $genderErr; ?> </span>
                        </div>
                        <input type="submit" value="Đăng Ký" class="btn-primary btn btn-block">
                        <span class="text-center text-uppercase h3"><?php echo $check; ?> </span>
                        <?php $check = "" ;?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>