<?php
require_once "connection.php";
 
$fullname = $email = $birthday = $gender = "";
$fullname_err = $email_err = $birthday_err = $gender_err = "";
$conn = DB::getConn();
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_fullname = trim($_POST["fullname"]);
    if(empty($input_fullname)){
        $fullname_err = "Vui lòng nhập tên";
    } elseif(!filter_var($input_fullname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fullname_err = "Vui lòng nhập lại tên đúng định dạng";
    } else{
        $fullname = $input_fullname;
    }
    
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Vui lòng nhập email";     
    } else{
        $email = $input_email;
    }
    
    $input_birthday = trim($_POST["birthday"]);
    if(empty($input_birthday)){
        $birthday_err = "Vui lòng nhập ngày sinh";     
    } else{
        $birthday = $input_birthday;
    }

    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Vui lòng nhập giới tính";     
    } else{
        $gender = $input_gender;
    }
    
    if(empty($fullname_err) && empty($email_err) && empty($birthday_err) && empty($gender_err)){
        $sql = "INSERT INTO members (fullname, email, birthday, gender) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_fullname, $param_email, $param_birthday, $param_gender);
            
            $param_fullname = $fullname;
            $param_email = $email;
            $param_birthday = $birthday;
            $param_gender = $gender;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php?controller=members");
                exit();
            } else{
                echo "Xảy ra lỗi. Vui lòng thử lại.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tạo nhân viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Tạo nhân viên</h2>
                    <p>Vui lòng nhập đầy đủ thông tin thành viên</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" name="fullname" class="form-control <?php echo (!empty($fullname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullname; ?>">
                            <span class="invalid-feedback"><?php echo $fullname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <textarea name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"><?php echo $email; ?></textarea>
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Ngày sinh</label>
                            <textarea name="birthday" class="form-control <?php echo (!empty($birthday_err)) ? 'is-invalid' : ''; ?>"><?php echo $birthday; ?></textarea>
                            <span class="invalid-feedback"><?php echo $birthday_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Giới tính</label>
                            <input type="text" name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gender; ?>">
                            <span class="invalid-feedback"><?php echo $gender_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php?controller=members" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>