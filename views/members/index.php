<!--  views/members/index.php -->

<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Trang chủ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      .wrapper{
          width: 600px;
          margin: 0 auto;
      }
      table tr td:last-child{
          width: 120px;
      }
    </style>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      })
    </script>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Quản lý Nhân viên</h2>
                    <a href="views/pages/create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Thêm mới nhân viên</a>
                </div>
                <?php
                if (isset($_SESSION['username']) && $_SESSION['username']){
                  echo 'Bạn đã đăng nhập với tên là '.$_SESSION['username']."<br/>";
                  echo 'Click vào đây để <a href="logout.php">Logout</a>';
                }
                else{
                  echo 'Bạn chưa đăng nhập';
                }

                require_once "connection.php";
                
                echo '<table class="table table-bordered table-striped">';
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Mã NV</th>";
                            echo "<th>Họ và tên</th>";
                            echo "<th>Email</th>";
                            echo "<th>Ngày sinh</th>";
                            echo "<th>Giới tính</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($members as $member) {
                      echo "<tr>";
                        echo "<td>" . $member->id . "</td>";
                        echo "<td>" . $member->fullname . "</td>";
                        echo "<td>" . $member->email . "</td>";
                        echo "<td>" . $member->birthday ."</td>";
                        echo "<td>" . $member->gender . "</td>";
                        echo "<td>";
                          echo '<a href="index.php?controller=members&action=showMember&id='. $member->id .'" class="mr-3" title="Xem chi tiết" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                          echo '<a href="update.php?id='. $member->id .'" class="mr-3" title="Cập nhật thông tin" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                          echo '<a href="delete.php?id='. $member->id .'" title="Xoá nhân viên" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                        echo "</td>";
                      echo "</tr>";
                    }
                    echo "</tbody>";                            
                echo "</table>";
                ?>
            </div>
        </div>        
    </div>
</body>
  <body>
    <?php 
    
    ?>
  </body>
</html>