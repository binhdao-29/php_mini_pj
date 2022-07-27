<!-- views/posts/show.php -->

<!DOCTYPE html>
<html>
  <head>
    <title>Bài viết</title>
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
                    <h2 class="pull-left">Danh sách bài viết</h2>
                </div>
                <?php
                echo "<h4>" . "Tiêu đề:  $post->title" . "</h4>";
                echo "<div>";
                  echo "<strong>Nội dung: </strong>";
                  echo $post->content;
                echo "</div>";
                ?>
            </div>
        </div>        
    </div>
</html>
