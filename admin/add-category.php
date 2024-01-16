<?php include "header.php"; ?>
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="admin-heading">Добавити нову категорію</h1>
                </div>
                <div class="col-md-offset-3 col-md-6">
                    <!-- /Form start -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label>Назва категорії</label>
                            <input type="text" name="cat" class="form-control" placeholder="Name category" required>
                        </div>
                        <input type="submit" name="save" class="btn btn-primary" value="Зберегти" required />
                    </form>
                    <!-- /Form End -->
                </div>
            </div>
        </div>
    </div>
<?php
if (isset($_POST['save'])) {
    include 'config.php';
    $category = mysqli_real_escape_string($conn,$_POST['cat']);

    $sql = "SELECT category_name FROM category WHERE category_name = '{$category}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color: red; text-align: center;margin: 10px 0';>Така категорія вже існує</p>";
    }
    else{
        $sql = "INSERT INTO category(category_name)
  VALUES ('{$category}')";

        if (mysqli_query($conn, $sql)) {
            header("location: {$hostname}/admin/category.php");
        }else{
            echo "<p>Query Failed</p>";
        }
    }
}
mysqli_close($conn);
include "footer.php"; ?>