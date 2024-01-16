<?php include "header.php"; 
if (isset($_POST['save'])) {
    include 'config.php';

    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['postdesc']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("d M, Y");
    $author = $_SESSION['user_id'];

    $sql = "SELECT title FROM post WHERE title = '($title)'";
    $result = mysqli_query($conn, $sql) or die('Query failed');

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: red; text-align: center;margin: 10px 0';>Такий пост вже існує</p>";
    } else {
        $sql1 = "INSERT INTO post(title, description, category, post_date, author)
  VALUES ('{$title}','{$description}','{$category}','{$date}','{$author}')";
        $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

        if (mysqli_query($conn, $sql1)) {
            header("location: {$hostname}/admin/post.php");
        } else {
            echo "<p>Query Failed</p>";
        }
    }
}
?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Додати новий пост</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Заголовок</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Текст</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Категорія</label>
                          <select class="form-control" name="category">
                              <option disabled selected>Виберіть категорію</option>
                              <?php
                              include "config.php";
                              $sql = "SELECT * FROM category";
                              $result = mysqli_query($conn, $sql) or die("Query Failed");
                              if(mysqli_num_rows($result) > 0){
                                  while ($row = mysqli_fetch_assoc($result)){
                                      echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                                  }
                              }
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Завантажити фото</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Зберегти" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
