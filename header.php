<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project training - website ban hang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div id="wrapper" style="padding-left:0px">
        <h2>Project training - Xay Dung Website ban hang</h2>

        <?php
            session_start();
            if(isset($_SESSION['user'])!=""){
                echo "<h2>Xin Chào ".$_SESSION['user']."<a href='/logout.php'>Logout</a></h2>";
            }else{
                echo"<h2> Bạn chưa đăng nhập <a href='login.php'>Login</a> - <a href='register.php'>Register</a></h2>";
            }
        ?>


        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="/list_product.php" class="navbar-brand">Danh sách sản phẩn</a>
                    <a href="/add_product.php" class="navbar-brand">Thêm sản phẩn</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>