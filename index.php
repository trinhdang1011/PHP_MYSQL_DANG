<?php
    require_once('database.php');

    // Get category ID
    if (!isset($chuyenNganh_id)) {
        $chuyenNganh_id = filter_input(INPUT_GET, 'chuyenNganh_id', 
                FILTER_VALIDATE_INT);
        if ($chuyenNganh_id == NULL || $chuyenNganh_id == FALSE) {
            $chuyenNganh_id = 1;
        }
    }
    // Get name for selected category
    $queryChuyenNganh = 'SELECT * FROM chuyennganh
                    WHERE chuyenNganhID = :chuyenNganh_id';
    $statement1 = $db->prepare($queryChuyenNganh);
    $statement1->bindValue(':chuyenNganh_id', $chuyenNganh_id);
    $statement1->execute();
    $chuyenNganh = $statement1->fetch();
    $chuyenNganh_name = $chuyenNganh['chuyenNganhName'];
    $statement1->closeCursor();

    // Get all categories
    $query = 'SELECT * FROM chuyennganh
                        ORDER BY chuyenNganhID';
    $statement = $db->prepare($query);
    $statement->execute();
    $chuyenNganhs = $statement->fetchAll();
    $statement->closeCursor();

    // Get products for selected category
    $queryStudents = 'SELECT * FROM students
    WHERE chuyenNganhID = :chuyenNganh_id
    ORDER BY studentID';
    $statement3 = $db->prepare($queryStudents);
    $statement3->bindValue(':chuyenNganh_id', $chuyenNganh_id);
    $statement3->execute();
    $students = $statement3->fetchAll();
    $statement3->closeCursor();
?>

<!DOCTYPE html>
<html>
<!-- the head section -->
    <head>
        <title>Students Manager</title>
        <link rel="stylesheet" type="text/css" href="main.css" />
    </head>

<!-- the body section -->
    <body>
        <header>
                <h1>Quản Lý Sinh Viên</h1>
        </header>
        <main>
            <h1>Danh sách sinh viên</h1>

            <aside>
                <!-- display a list of categories -->
                <h2>Chuyên Ngành</h2>
                <nav>
                <ul>
                    <?php foreach ($chuyenNganhs as $chuyenNganh) : ?>
                    <li><a href=".?chuyenNganh_id=<?php echo $chuyenNganh['chuyenNganhID']; ?>">
                            <?php echo $chuyenNganh['chuyenNganhName']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                </nav>          
            </aside>
            <section>
        <!-- display a table of products -->
            <h2><?php echo $chuyenNganh_name; ?></h2>
            <table>
                <tr>
                    <th>Mã Sinh Viên</th>
                    <th>Họ và Tên</th>
                    <th class="right">Năm Sinh</th>
                    <th>&nbsp;</th>
                </tr>

                <?php foreach ($students as $student) : ?>
                <tr>
                    <td><?php echo $student['studentCode']; ?></td>
                    <td><?php echo $student['studentName']; ?></td>
                    <td class="right"><?php echo $student['birthDay']; ?></td>
                    <td><form action="delete_student.php" method="post">
                        <input type="hidden" name="student_id"
                            value="<?php echo $student['studentID']; ?>">
                        <input type="hidden" name="chuyenNganh_id"
                            value="<?php echo $student['chuyenNganhID']; ?>">
                        <input type="submit" value="Delete">
                    </form></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <p><a href="add_student_form.php">Thêm Sinh Viên</a></p>
            <!--<p><a href="category_list.php">List Categories</a></p>-->
        </section>
        </main>
        <footer>
        <p>&copy; <?php echo date("Y"); ?> TRINHDANG.</p>
        </footer>
    </body>
</html>