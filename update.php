<?php
require_once "connection.php";
 
$fullname = $email = $birthday = $gender = "";
$fullname_err = $email_err = $birthday_err = $gender_err = "";
$conn = DB::getConn();
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
    $input_fullname = trim($_POST["fullname"]);
    if(empty($input_fullname)){
        $fullname_err = "Vui lòng nhập tên";
    } elseif(!filter_var($input_fullname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fullname_err = "Vui lòng nhập tên hợp lệ";
    } else{
        $fullname = $input_fullname;
    }
    
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Vui lòng nhập email";     
    } else{
        $email = $input_email;
    }

    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Vui lòng nhập giới tính";     
    } else{
        $gender = $input_gender;
    }
    
    $input_birthday = trim($_POST["birthday"]);
    if(empty($input_birthday)){
        $birthday_err = "Vui lòng nhập ngày sinh";     
    } else{
        $birthday = $input_birthday;
    }
    if(empty($fullname_err) && empty($email_err) && empty($birthday_err) && empty($gender_err)){
        $sql = "UPDATE members SET fullname=?, email=?, birthday=?, gender=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_birthday ,$param_gender, $param_id);
            
            $param_name = $fullname;
            $param_email = $email;
            $param_birthday = $birthday;
            $param_gender = $gender;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location:index.php?controller=members");
                exit();
            } else{
                echo "Xảy ra lỗi. Vui lòng thử lại";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($conn);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM members WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $fullname = $row["fullname"];
                    $email = $row["email"];
                    $birthday = $row["birthday"];
                    $gender = $row["gender"];

                } else{
                    header("location: index.php?controller=members&action=error");
                    exit();
                }
                
            } else{
              echo "Xảy ra lỗi. Vui lòng thử lại";
            }
        }
        
        mysqli_stmt_close($stmt);
        
        mysqli_close($conn);
    }  else{
        header("location: index.php?controller=members&action=error");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật thông tin</title>
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
                    <h2 class="mt-5">Cập nhật thông tin nhân viên</h2>
                    <p>Nhập các thông tin cần cập nhật</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php?controller=members" class="btn btn-secondary ml-2">Huỷ</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>