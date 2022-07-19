<?php
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "ketnoi.php";
    
    $sql = "SELECT * FROM member WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                $fullname = $row["fullname"];
                $email = $row["email"];
                $birthday = $row["birthday"];
                $gender = $row["gender"];
            } else{
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Xảy ra lỗi. Vui lòng thử lại";
        }
    }
     
    mysqli_stmt_close($stmt);
    
    mysqli_close($conn);
} else{
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết nhân viên</title>
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
                    <h1 class="mt-5 mb-3">Chi tiết nhân viên</h1>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <p><b><?php echo $row["fullname"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <p><b><?php echo $row["birthday"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <p><b><?php echo $row["gender"]; ?></b></p>
                    </div>
                    <p><a href="trangchu.php" class="btn btn-primary">Quay lại</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>