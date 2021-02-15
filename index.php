<?php
session_start();
// check if the user is already logged in
if ($_SESSION) {
    if(strlen($_SESSION['id']) == 1){
        // redirect to the dashboard 
        header('location:admin/dashboard.php');
    }    
}
if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = md5($_POST['password']);
    // include modal file
    include 'model/modal.php';
    // instantiate the model class
    $model = new Model;
    $model->login($email,$password);
    $error = $model->login($email,$password);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenditure | Login</title>
    <link rel="stylesheet" href="vendors/css/style.css">
    <link rel="stylesheet" href="vendors/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/css/all.css">
</head>
<body class="bg-secondary">

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 shadow bg-white p-0 m-2 mt-5" style="border-radius:10px;top:30px;">
                <div class="">
                    <img class="card-img-top" src="images/image1.jpg" alt="signup image">
                      <div class="p-2"> 
                            <?php
                                if (isset($_POST['login'])) {
                                   if (!empty($error)) {
                                       echo $error['error'];
                                   }
                                } 
                                
                            ?>
                        <form action="" method="POST" class="form-group">
                            <label for="email">Email</label><br>
                            <input type="email" required class="form-control" name="email"><br>
                            <label for="password">Password</label><br>
                            <input type="password" required class="form-control" name="password"><br>
                                <div style="display:flex;">
                                    <button class="btn btn-danger mr-auto " name="login">Login</button><br>
                                    <a href="signup.php" class="btn btn-primary ml-auto">Sign Up</a><br>
                                </div>
                            <a href="#" class="text-danger ml-"type="button" data-toggle="modal" data-target="#f_pass">Forgotten Password?</a><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- page modal -->
        <?php include 'components/page_modal.php' ?>
    
    <script src="vendors/js/jquery.min.js"></script>
    <script src="vendors/js/popper.min.js"></script>
    <script src="vendors/js/bootstrap.min.js"></script>
</body>
</html>