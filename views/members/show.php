<!-- views/members/show.php -->

<!DOCTYPE html>
<html>
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
                        <p><b><?php echo $member->fullname; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $member->email; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <p><b><?php echo $member->birthday; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <p><b><?php echo $member->gender; ?></b></p>
                    </div>
                    <p><a href="index.php?controller=members" class="btn btn-primary">Quay lại</a></p>
                </div>
            </div>        
        </div>
    </div>
</html>
