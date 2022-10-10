<?php
    require_once("database.php");

    if (isset($_POST["btn_submit"])) {
		//lấy thông tin từ các form bằng phương thức POST
		$username = $_POST["username"];
		$password = $_POST["password"];
    $repassword = $_POST["repassword"];
    if($password != $repassword){
       echo"Mật khẩu không trùng khớp. Vui lòng nhập lại";   
    }else if ($username == "" || $password == "") {
       echo "Bạn vui lòng nhập đầy đủ thông tin";
    }else{
    //thực hiện việc lưu trữ dữ liệu vào db
          // $password = md5($password);
          $query = "INSERT INTO user(username,password) VALUES (:username, :password)";
          $statement = $db->prepare($query);
          $statement->bindValue(':username', $username);
          $statement->bindValue(':password', $password);
          $statement->execute();
          $statement->closeCursor();
          header('location:login.php');
          }
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Đăng ký</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div style="width:600px; margin:auto; padding-top:100px">
            <h3 style=" text-align:center">ĐĂNG KÝ TÀI KHOẢN</h3>
            <form action="register.php" method="post">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Tên tài khoản:</label>
                    <input type="text" class="form-control" id="email" placeholder="Nhập tài khoản" name="username">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Nhập lại mật khẩu:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Nhập lại mật khẩu" name="repassword">
                </div>
                
                <button type="submit" class="btn btn-primary" name="btn_submit">Đăng ký</button>
                
            </form>
        </div>
    </body>
</html>