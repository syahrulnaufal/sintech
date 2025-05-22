<?php
session_start();
require_once 'helper/connection.php';

if (isset($_POST['submit'])) {
    $input = $_POST['username'];
    $password = $_POST['password'];

    $sqlUser = "SELECT * FROM tbl_user WHERE username='$input' LIMIT 1";
    $resultUser = mysqli_query($connection, $sqlUser);
    $rowUser = mysqli_fetch_assoc($resultUser);

    if ($rowUser && $password == $rowUser['password']) {
        $_SESSION['login'] = $rowUser;
        $user_level = $rowUser['level'];

        if ($user_level == 'kepala') {
            header('Location: kepala/dashboard2/index.php');
        } elseif ($user_level == 'admin') {
            header('Location: dashboard/index.php');
        } elseif ($user_level == 'user') {
          header('Location: pengguna/dashboard/index.php'); 
        }exit;
    } else {
        header('Location: login.php?error=1');
        exit;
    }
} elseif (isset($_SESSION['login'])) {
    $user_level = $_SESSION['login']['level'];
    if ($user_level == 'kepala') {
        header('Location: kepala/dashboard2/index.php');
    } elseif ($user_level == 'pustakawan') {
        header('Location: dashboard/index.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; UIN WS</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>

<body id="bg-login">
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/LOGO GIS KOTA SEMARANG.png" alt="logo" width="350">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login Admin</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="login.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Mohon isi username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Mohon isi kata sandi
                    </div>
                  </div>

                  <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <?php
                  if(isset($_GET['error']) && $_GET['error'] == '1') {
                      echo "<p class='alert alert-danger mt-4'> password/user salah </p>";
                  }
                ?>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>
