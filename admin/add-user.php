<?php
if (isset($_POST['save'])) {
include 'config.php';
$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST['lname']);
$user = mysqli_real_escape_string($conn,$_POST['user']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$role = mysqli_real_escape_string($conn,$_POST['role']);

$sql = "SELECT username FROM user WHERE username = '($user)'";
$result = mysqli_query($conn, $sql) or die('Query failed');

if (mysqli_num_rows($result) > 0) {
  echo "<p>Такий користувач вже зареєстрований</p>";
}
else{
  $sql1 = "INSERT INTO user(first_name, last_name, username, password, role)
  VALUES ('{$fname}', '{$lname}', '{$user}', '{$password}', '{$role}')";
  if (mysqli_query($conn, $sql1)) {
    header("Location: {$hostname}/admin/users.php");
  }else{
      echo "<p style='color: red;text-align: center;margin: 10px 0;'>Не вдається увійти</p>";
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN-панель</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-offset-4 col-md-4">
                  <img class="logo" src="images/news.jpg">
                  <h3 class="admin-heading text-center">Додати користувача</h3>
                  <form  action="" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Ім'я</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Прізвище</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>Ім'я користувача</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                          <label>Пароль</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>Admin/User</label>
                          <select class="form-control" name="role" >
                              <option value="0">User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Зареєструватися" required />
                      <div style="text-decoration: underline">
                          <a href="index.php" class="text-muted">В мене вже є акаунт, увійти</a>
                      </div>
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>