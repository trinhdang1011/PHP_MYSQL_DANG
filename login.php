<?php
    session_start();
    require_once("database.php");

    if (isset($_POST["btn_submit"])) {
		//lấy thông tin từ các form bằng phương thức POST
		$username = $_POST["username"];
		$password = $_POST["password"];
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $query = $db->prepare($sql);
        $query->execute(
            array(
                ':username'=> $username,
                ':password'=> $password
            )
        );
        $cout = $query->rowCount();
        if($cout>0){
            echo"Đăng nhập thành công";
            $_SESSION['username']= $username;
            header("location:index.php");
        }else{
            echo"Đăng nhập thất bại";
        }
    }
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div style="width:600px; margin:auto; padding-top:100px">
        <h3 style=" text-align:center">ĐĂNG NHẬP</h3>
        <form action="login.php" method="post" >
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Tài khoản:</label>
                <input type="text" class="form-control" id="email" placeholder="Nhập tài khoản" name="username">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password">
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Ghi nhớ mật khẩu
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="btn_submit">Đăng nhập</button>
                <a style="padding-left:60%" href="register.php">Đăng ký tài khoản</a>
            </div>
        </form>
    </div>
</body>
</html>