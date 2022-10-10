<?php
require('database.php');
$query = 'SELECT *
          FROM chuyennganh
          ORDER BY chuyenNganhID';
$statement = $db->prepare($query);
$statement->execute();
$chuyenNganhs = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Students Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Quản Lý Sinh Viên</h1></header>

    <main>
        <h1>Thêm Sinh Viên</h1>
        <form action="add_student.php" method="post"
              id="add_student_form">

            <label>Chuyên Ngành:</label>
            <select name="chuyenNganh_id">
            <?php foreach ($chuyenNganhs as $chuyenNganh) : ?>
                <option value="<?php echo $chuyenNganh['chuyenNganhID']; ?>">
                    <?php echo $chuyenNganh['chuyenNganhName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Mã Sinh Viên:</label>
            <input type="text" name="code"><br>

            <label>Tên Sinh Viên:</label>
            <input type="text" name="name"><br>

            <label>Năm Sinh:</label>
            <input type="text" name="birthday"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Thêm Sinh Viên"><br>
        </form>
        <p><a href="index.php">Xem Danh Sách Sinh Viên</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Quản Lý Sinh Viên, Inc.</p>
    </footer>
</body>
</html>