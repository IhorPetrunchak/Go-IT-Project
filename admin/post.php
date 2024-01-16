<?php include "header.php"; ?>
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1 class="admin-heading">Всі пости</h1>
                </div>
                <div class="col-md-2">
                    <a class="add-new" href="add-post.php">Додати пост</a>
                </div>
                <div class="col-md-12">
                    <?php
                    include 'config.php';
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }
                    else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn,$sql) or die('Query failed');
                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <table class="content-table">
                            <thead>
                            <th>ID</th>
                            <th>Заголовок</th>
                            <th>Текст</th>
                            <th>Категорія</th>
                            <th>Дата</th>
                            <th>Автор</th>
                            <th>Фото</th>
                            <th>Змінити</th>
                            <th>Видалити</th>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td class='id'><?php echo $row['post_id']; ?></td>
                                    <td><?php echo $row['title'];?></td>
                                    <td><?php echo $row['description'];?></td>
                                    <td><?php echo $row['category'];?></td>
                                    <td><?php echo $row['post_date'];?></td>
                                    <td><?php echo $row['author'];?></td>
                                    <td><?php echo $row['post_img'];?></td>
                                    <td class='edit'><a href='update-post.php?id=<?php echo $row["post_id"];?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id=<?php echo $row["post_id"];?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    <?php }
                    $sql1 = "SELECT * FROM post";
                    $result1 = mysqli_query($conn, $sql1) or die('Query Failed');
                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);
                        $total_page = ceil($total_records / $limit);
                        echo '<ul class="pagination admin-pagination">';
                        if ($page > 1) {
                            echo '<li><a href="post.php?page='.($page - 1).'">Попередня</a></li>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            }
                            else {
                                $active = "";
                            }
                            echo '<li class="'.$active.'"><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        if ($total_page > $page) {
                            echo '<li><a href="post.php?page='.($page + 1).'">Наступна</a></li>';
                        }
                        echo ' </ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>