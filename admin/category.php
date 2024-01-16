<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">Всі категорії</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">Додати категорію</a>
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
                  };
                  $offset = ($page - 1) * $limit;
                  $sql = "SELECT * FROM category ORDER BY category_id DESC Limit $offset,$limit";
                  $result = mysqli_query($conn,$sql);
                  if (mysqli_num_rows($result) > 0) {
                      $table = '<table class="content-table">';
                      $table .= '<thead>
                      <th>ID</th>
                        <th>Назва категорії</th>
                        <th>Кількість постів</th>
                        <th>Змінити</th>
                        <th>Видалити</th>
                        </thear>
                        <tbody>';
                      $serial = $offset + 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                          $table .= "<tr>
                          <td class='id'>{$serial}</td>
                          <td>{$row["category_name"]}</td>
                          <td>{$row["post"]}</td>
                          <td class='edit'><a href='update-category.php?id= {$row['category_id']}'><i class='fa fa-edit'></i></a></td>
                          <td class='delete'><a href='delete-category.php?id= {$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>
                          </tr>";
                          $serial++;
                          }
                      $table .= '</tbody></table>';
                      echo $table;
                  }else {
                      echo "<h3>Немає результату</h3>";
                  }
                  $sql1 = "SELECT COUNT(category_id) FROM category";
                  $result_1 = mysqli_query($conn, $sql1);
                  $row_db = mysqli_fetch_row($result_1);
                  $total_record = $row_db[0];
                  $total_page = ($total_record/$limit);
                  echo "<ul class='pagination admin-pagination'>";
                     if ($page > 1) {
                         echo '<li><a href="category.php?page='.($page - 1).'">Попередня</a></li>';
                     }
                     if($total_record > $limit){
                      for ($i = 1; $i <= $total_page; $i++) {
                          if ($i == $page) {
                              $cls = "active";
                          }
                          else {
                              $cls = "";
                          }
                          echo "<li><a href='category.php?page=".$i."' class='{$cls}'>$i</a></li>";
                      }
                      }
                      if ($total_page > $page) {
                          echo '<li><a href="category.php?page='.($page + 1).'">Наступна</a></li>';
                      }
                      echo "</ul>";
                      ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
