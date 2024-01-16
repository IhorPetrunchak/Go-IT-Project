<?php include "header.php";
include 'config.php';
if (isset($_POST['submit'])) {

    $postid = mysqli_real_escape_string($conn,$_POST['post_id']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $postdate = mysqli_real_escape_string($conn,$_POST['post_date']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);
    $postimg = mysqli_real_escape_string($conn,$_POST['post_img']);


    $sql = "UPDATE post SET title = '{$title}',description = '{$description}', category = '{$category}', post_date = '{$postdate}', author = '{$author}', post_img = '{$postimg}' WHERE post_id = {$postid}";
    $result = mysqli_query($conn,$sql) or die('Query failed');

    if (mysqli_query($conn,$sql)) {
        header("Location: {$hostname}/admin/post.php");
    }
}
?>
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="admin-heading">Змінити пост</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <?php

                    $post_id = $_GET['id'];
                    $sql = "SELECT * FROM post WHERE post_id = {$post_id}";
                    $result = mysqli_query($conn,$sql) or die('Query failed');
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-group">
                                    <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'];?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTile">Заголовок</label>
                                    <input type="text" name="title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Текст</label>
                                    <input type="text" name="description" class="form-control"  required rows="5" value="<?php echo $row['description'];?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Категорія</label>
                                    <select class="form-control" name="category">
                                        <option disabled>Виберіть категорію</option>
                                        <?php
                                        include "config.php";
                                        $sql1 = "SELECT * FROM category";

                                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed");
                                        if(mysqli_num_rows($result1) > 0){
                                            while($row1 = mysqli_fetch_assoc($result1)){
                                                if($row['category'] == $row1['category_id']){
                                                    $selected = "selected";
                                                }else{
                                                    $selected ="";
                                                }
                                                echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Завантажити фото</label>
                                    <input type="file" name="new-image">
                                    <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                                    <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
                                </div>
                                <input type="submit" name="submit" class="btn btn-dark" value="Зберегти" />
                            </form>
                        <?php }
                    }?>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>